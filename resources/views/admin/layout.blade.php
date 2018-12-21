<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('blog.title') }} - admin </title>
</head>
<body>
	<div id="app">
		<el-container style="height: 500px;">
			<el-aside
			  width="200px"
			>
				<el-card :body-style="{padding: '0px'}" style="text-align: center;">
					<img src="/images/favicon.ico" style="margin: 10px;width: 100px;height: 100px;border-radius: 50%">
					<div style="padding: 10px 10px">
						<span>boboidea</span>
					</div>
				</el-card>
				<el-menu
				  default-active="1"
				  style="padding-top: 20px"
				>
					<el-menu-item index="1">
						<i class="el-icon-menu"></i>
						<span slot="title">面板</span>
					</el-menu-item>
					<el-menu-item index="2">
						<i class="el-icon-menu"></i>
						<span slot="title">用户管理</span>
					</el-menu-item>
					<el-menu-item index="3">
						<i class="el-icon-menu"></i>
						<span slot="title">文章管理</span>
					</el-menu-item>
					<el-menu-item index="4">
						<i class="el-icon-menu"></i>
						<span slot="title">标签管理</span>
					</el-menu-item>
					<el-menu-item index="5">
						<i class="el-icon-menu"></i>
						<span slot="title">友链管理</span>
					</el-menu-item>
				</el-menu>
			</el-aside>
			<el-container>
				<el-header>
					<i class="el-icon-menu"></i>
				</el-header>
				<el-main>
					<el-table
					  style="width: 100%;"
					>
						<el-table-column
						  prop="date"
						  label="日期"
						  width="180"
						></el-table-column>
						<el-table-column
						  prop="name"
						  label="姓名"
						  width="180"
						></el-table-column>
						<el-table-column
						  prop="address"
						  label="地址"
						></el-table-column>
					</el-table>
				</el-main>
			</el-container>
		</el-container>
	</div>
	<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>