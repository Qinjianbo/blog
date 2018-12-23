<template>
	<div>
		<el-main>
			<el-table
			  style="width: 100%;"
			>
				<el-table-column
				  prop="date"
				  label="用户名"
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
	</div>
</template>

<script type="text/javascript">
	export default {
		method() {
			console.log('user component mounted.');
		}
	}
</script>