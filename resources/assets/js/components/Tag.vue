<template>
    <div>
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
                    <el-button @click="handleClick(scope.row)" type="text" size="small">查看</el-button>
                    <el-button type="text" size="small">编辑</el-button>
                    <el-button type="text" size="small">删除</el-button>
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
                        "label": "标签名称",
                        "width": "360"
                    },
                    {
                        "prop": "createTime",
                        "label": "创建时间",
                        "width": ""
                    }
                ],
                tableData: [
                    {
                        id: 1,
                        title: "testTitle",
                        createTime: "2018-12-29"
                    }
                ]
            }
        }
    }
</script>