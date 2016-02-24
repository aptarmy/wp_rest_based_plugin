<!-- apply our angular app to our site -->
<div ng-app="restApp" class="armrest">
	<!-- NAVIGATION -->
	<nav class="navbar navbar-inverse" role="navigation">
		<ul class="nav navbar-nav">
			<li><a ui-sref="posts">บทความทั้งหมด</a></li>
			<li><a ui-sref="form">เพิ่มบทความใหม่</a></li>
		</ul>
	</nav>
	<!-- MAIN CONTENT -->
	<div class="container">
		<!-- THIS IS WHERE WE WILL INJECT OUR CONTENT ============================== -->
		<div ui-view></div>
	</div>
</div>