<template>
	<div>
		<el-container>
			<el-main>
			<el-row>
				<el-col :span="8">
					<el-card>
						<div>
							<i class="el-icon-star-on"></i>
							<span>用户总数</span>
						</div>
						
					</el-card>
				</el-col>
				<el-col :span="8">
					<el-card>
						<div>
							<i class="el-icon-tickets"></i>
							<span>文章总数</span>
						</div>
						
					</el-card>
				</el-col>
				<el-col :span="8">
					<el-card>
						<div>
							<i class="el-icon-view"></i>
							<span>阅读总数</span>
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