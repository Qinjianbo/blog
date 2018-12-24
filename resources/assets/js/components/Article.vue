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