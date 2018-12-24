<template>
	<div>
		<el-main>
			<el-form ref="form" label-width="80px">
				<el-form-item label="标题">
					<el-input></el-input>
				</el-form-item>
				<el-form-item label="简介">
					<el-input></el-input>
				</el-form-item>
				<el-form-item label="正文">
					<el-input type="textarea" :row="2" id="editor"></el-input>
				</el-form-item>
				<el-form-item label="tag">
				    <el-input type="input"></el-input>
				</el-form-item>
				<el-form-item>
				    <el-checkbox>原创请勾我</el-checkbox>
				</el-form-item>
				<el-button>保存</el-button>
				<!--<router-link to="/articles"><el-button>取消</el-button></router-link>-->
			</el-form>
		</el-main>
	</div>
</template>
<script type="text/javascript">
	import {default as SimpleMDE} from 'simplemde/dist/simplemde.min';
	import ElButton from "../../../../public/js/app";

	export default {
		components: {ElButton},
		method() {
			console.log('new article component mounted.');
		},
		data() {
			return {
				simplemde: ""
			}
		},
		mounted() {
			this.simplemde = new SimpleMDE({
				element: document.getElementById('editor')
			})
		}
	}
</script>

<style>
    @import '~simplemde/dist/simplemde.min.css';
</style>