<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('blog.title') }} - admin </title>
	<script type="text/javascript">
		window.Laravel = {
			csrfToken: "{{ csrf_token() }}"
		}
	</script>
</head>
<body>
	<div id="app">
		<el-container style="height: 500px;">
			<aside-component></aside-component>
			<el-container>
				<el-header>
					<i class="el-icon-menu"></i>
				</el-header>
				<router-view></router-view>
			</el-container>
		</el-container>
	</div>
	<script type="text/javascript" src="/js/app.js"></script>
	<script type="text/javascript">
		
	</script>
</body>
</html>