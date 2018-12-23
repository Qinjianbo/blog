<template>
	<div>
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
			  :default-active="this.$router.path"
			  router
			  style="padding-top: 20px"
			>
				<el-menu-item
				  v-for="(item, i) in menus"
				  :key="i"
				  :index="item.url"
				>
					<i class="el-icon-menu"></i>
					<span slot="title">{{ item.title }}</span>
				</el-menu-item>
			</el-menu>
		</el-aside>
	</div>
</template>

<script type="text/javascript">
	export default {
		method() {
			console.log('aside component mounted.');
		},
		data() {
			return {
				menus: [
					{ url: "/dashboard", title: "面板"},
					{ url: "/users", title: "用户管理"},
					{ url: "/articles", title: "文章管理"},
					{ url: "/tags", title: "标签管理"},
					{ url: "/links", title: "友链管理"}
				]
			}
		}
	}
</script>