var routerApp = angular.module('restApp', ['ui.router']);

routerApp.config(function($stateProvider, $urlRouterProvider) {
    
    $urlRouterProvider.otherwise('/posts');
    
    $stateProvider
        
        .state('posts', {
            url: '/posts',
            templateUrl: restApiPostPluginLocalize.template_url + 'posts.html',
			controller: function($scope, $http){
				$http({
					method : "GET",
					url : restApiPostPluginLocalize.root + "wp/v2/posts"
				}).then(function (response) {
					$scope.posts = response.data;
				});
			}
        })
        
        .state('post', {
            url: '/posts/:id',
            templateUrl: restApiPostPluginLocalize.template_url + 'post.html',
			controller: function($scope, $http, $stateParams){
				$http({
					method : "GET",
					url : restApiPostPluginLocalize.root + "wp/v2/posts/" + $stateParams['id']
				}).then(function (response) {
					$scope.post = response.data;
				});
			}
        })
		
		.state('form', {
            url: '/form',
            templateUrl: restApiPostPluginLocalize.template_url + 'form.html',
			controller: function($scope, $http){
				$scope.title = "";
				$scope.content = "";
				
				$scope.sendForm = function() {
					$http({
						"method" : "POST",
						"url" : restApiPostPluginLocalize.root + "wp/v2/posts/",
						"data" : {
							title : $scope.title,
							content : $scope.content
						},
						"headers" : {
							'X-WP-Nonce' : restApiPostPluginLocalize.wprest_nonce
						}
					}).then(function successCallback(response) {
						alert("เพิ่มบทความสำเร็จ ไปดูที่หลังบ้าน WordPress ได้");
					}, function errorCallback(response) {
						alert("เออร์เรอร์...ลองเช็คที่ console log");
					});
				};
			}
        });
		
		
});