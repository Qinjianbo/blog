<template>
	<div>
		<el-container>
			<el-main>
			<el-row>
				<el-col :span="8">
					<el-card
					  shadow="hover"
					>
						<div>
							<i class="el-icon-star-on"></i>
							<span>用户总数:</span>
							<span>111</span>
						</div>
					</el-card>
				</el-col>
				<el-col :span="8">
					<el-card
					  shadow="hover"
					>
						<div>
							<i class="el-icon-tickets"></i>
							<span>文章总数:</span>
							<span>222</span>
						</div>
					</el-card>
				</el-col>
				<el-col :span="8">
					<el-card
					  shadow="hover"
					>
						<div>
							<i class="el-icon-view"></i>
							<span>阅读总数:</span>
							<span>888</span>
						</div>
					</el-card>
				</el-col>
			</el-row>
			</el-main>
		</el-container>
	</div>
</template>
<script type="text/javascript">
	export default {
		method() {
			console.log('dashboard component mounted.');
		}
	}
</script>