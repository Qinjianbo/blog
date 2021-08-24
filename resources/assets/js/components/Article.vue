<template>
	<div>
		<el-main>
			<el-form ref="form" label-width="80px">
				<el-form-item label="标题">
					<el-input v-model="blog.title"></el-input>
				</el-form-item>
				<el-form-item label="简介">
					<el-input v-model="blog.description"></el-input>
				</el-form-item>
				<el-form-item label="正文">
					<el-input type="textarea" :row="2" id="editor" v-model="blog.content"></el-input>
				</el-form-item>
				<el-form-item label="tag">
				    <el-input type="input" v-model="blog.tags"></el-input>
				</el-form-item>
				<el-form-item>
				    <el-checkbox v-model="blog.type">原创请勾我</el-checkbox>
				</el-form-item>
				<el-form-item>
				    <el-checkbox v-model="blog.is_url">原文是否为链接</el-checkbox>
				</el-form-item>
				<el-button @click="save">保存</el-button>
				<!--<router-link to="/articles"><el-button>取消</el-button></router-link>-->
			</el-form>
		</el-main>
	</div>
</template>
<script type="text/javascript">
	import {default as SimpleMDE} from 'simplemde/dist/simplemde.min';

	export default {
		method() {
			console.log('new article component mounted.');
		},
		created() {
			this.show(this.getQueryId());
		},
		data() {
			return {
				simplemde: "",
				blog: {
					title: "",
					description: "",
					content: "",
					tags: "",
					type: "",
                    is_url: "",
				}
			}
		},
		mounted() {
			this.simplemde = new SimpleMDE({
				element: document.getElementById('editor')
			})
		},
		methods: {
			save() {
				console.log('save article');
				let data = {
					user_id: this.$cookie.get('uid'),
					title: this.blog.title,
					description: this.blog.description,
					content: this.simplemde.value(),
					tags: this.blog.tags,
					type: Number(this.blog.type),
                    is_url: Number(this.blog.is_url),
					device: 'pc'
				};
				let id = this.getQueryId();
				if(id != undefined && id != 0) {
					this.putArticle(id,data);
				} else {
					this.postArticle(data);
				}
				
				
			},
			show(id) {
				if (id == 0 || id == undefined) {
					return;
				}
				let url = `/user/blog/${id}?user_id=${this.$cookie.get('uid')}&device=pc`;
				this.$http.get(url)
				.then(response => {
					console.log(response);
					if (response.data.code != 0) {
						this.$message.error(response.data.msg);
					} else {
						let blog = response.data.data;
						this.blog.title = blog.title;
						this.blog.tags = blog.tags;
						this.blog.type = Boolean(blog.type);
                        this.blog.is_url = Boolean(blog.is_url);
						this.blog.description = blog.description;
						this.simplemde.value(blog.content);
					}
				})
				.catch(error => {
					this.$message.error(error);
				});
			},
			postArticle(data) {
				console.log('postArticle');
				let url = 'user/blog';
				console.log(data);
				this.$http.post(url, data)
				.then(response => {
					console.log(response);
					if (response.data.code != 0) {
						this.$message.error(response.data.msg);
					} else {
						this.$message.success('文章新建成功');
						location.href="/admin#/articles";
					}
				})
				.catch(error => {
					console.log(error);
					this.$message.error('操作过程出现错误');
				});
			},
			putArticle(id, data) {
				console.log('putArticle');
				let url = `user/blog/${id}`;
				this.$http.put(url, data)
				.then(response => {
					console.log(response);
					if (response.data.code != 0) {
						this.$message.error(response.data.msg);
					} else {
						this.$message.success('文章编辑成功');
						location.href="/admin#/articles";
					}
				})
				.catch(error => {
					console.log(error);
					this.$message.error('操作过程出现错误');
				});
			},
			getQueryId() {
				let query = this.$route.query;
				let id = query.id;

				if (id == undefined || id == '') {
					return 0
				}

				return id;
			}
		}
	}
</script>

<style>
  @import '~simplemde/dist/simplemde.min.css';
</style>

