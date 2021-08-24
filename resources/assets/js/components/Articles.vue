<template>
	<div>
		<el-header height="100" style="text-align:right;">
			<router-link to="/newArticle"><el-button type="success">新建</el-button></router-link>
		</el-header>
		<el-main>
			<el-table
			  :data="tableData"
			  style="width: 100%;"
			>
				<el-table-column
				  v-for="(item, i) in items"
				  :key="i"
				  :prop="item.prop"
				  :label="item.label"
				  :width="item.width"
				></el-table-column>
				<el-table-column
			      label="操作"
			    >
			      <template slot-scope="scope">
			        <el-button @click="showArticle(scope.row.id, scope.row.is_url, scope.row.content)" type="text" size="small">查看</el-button>
			        <router-link :to="{name: 'newArticle', query: {id: scope.row.id}}">
			        	<el-button type="text" size="small">编辑</el-button>
			        </router-link>
			      </template>
    			</el-table-column>
			</el-table>
		</el-main>
	</div>
</template>

<script type="text/javascript">
	export default {
		method() {
			console.log('article component mounted.');
		},
		created() {
			this.getArticleList();
		},
		methods: {
			showArticle(id, is_url, url) {
                if (is_url) {
				    window.open(url);
                } else {
				    window.open(`/blog/${id}`);
                }
			},
			getArticleList() {
				let url = 'user/blogs';
				let page = 1;
				let pageSize = 10;
				let user_id = this.$cookie.get('uid');
				url = `${url}?page=${page}&pageSize=${pageSize}&user_id=${user_id}&device=pc`;
				this.$http.get(url)
				.then(response => {
					console.log(response);
					if (response.data.code != 0) {
						this.$message.error(response.data.msg);
					} else {
						this.tableData = response.data.data.list;
					}
				})
				.catch(error => {
					this.$message.error(error);
				})
			}
		},
		data() {
			return {
				items: [
					{
						"prop": "id",
						"label": "ID",
						"width": ""
					},
					{
						"prop": "title",
						"label": "标题",
						"width": "360"
					},
					{
						"prop": "nickname",
						"label": "作者",
						"width": ""
					},
					{
						"prop": "reading",
						"label": "阅读量",
						"width": ""
					},
					{
						"prop": "tags",
						"label": "标签",
						"width": ""
					},
					{
						"prop": "created_at",
						"label": "创建时间",
						"width": ""
					}
				],
				tableData: []
			}
		}
	}
</script>
