<template>
	<div>
		<el-main>
			<el-form ref="form" label-width="80px">
				<el-form-item label="标题" :id="title">
					<el-input v-model="title"></el-input>
				</el-form-item>
				<el-form-item label="简介">
					<el-input v-model="description"></el-input>
				</el-form-item>
				<el-form-item label="正文">
					<el-input type="textarea" :row="2" id="editor" v-model="content"></el-input>
				</el-form-item>
				<el-form-item label="tag">
				    <el-input type="input" v-model="tags"></el-input>
				</el-form-item>
				<el-form-item>
				    <el-checkbox v-model="type">原创请勾我</el-checkbox>
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
		data() {
			return {
				simplemde: "",
				title: "",
				description: "",
				content: "",
				tags: "",
				type: "",
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
				console.log(this.title);
				let url = 'user/blog';
				let data = {
					user_id: this.$cookie.get('uid'),
					title: this.title,
					description: this.description,
					content: this.simplemde.value(),
					tags: this.tags,
					type: Number(this.type),
					device: 'pc'
				};
				console.log(data);
				this.$http.post(url, data)
				.then(response => {
					console.log(response);
					if (response.data.code != 0) {
						this.$message.error(response.data.msg);
					} else {
						this.$message.success('文章创建成功');
					}
				})
				.catch(error => {
					console.log(error);
					this.$message.error('创建过程出现错误');
				});
				
			},
		}
	}
</script>

<style>
  @import '~simplemde/dist/simplemde.min.css';
</style>

