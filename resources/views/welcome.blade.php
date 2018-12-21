<html>
    <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  .el-row {
    margin-bottom: 20px;
    &:last-child {
      margin-bottom: 0;
    }
  }
  .el-col {
    border-radius: 4px;
  }
  .bg-purple-dark {
    background: #99a9bf;
  }
  .bg-purple {
    background: #d3dce6;
  }
  .bg-purple-light {
    background: #e5e9f2;
  }
  .grid-content {
    border-radius: 4px;
    min-height: 36px;
  }
  .row-bg {
    padding: 10px 0;
    background-color: #f9fafc;
  }
</style>
    </head>
    <body>
	<div id="app">
        <example></example>
        <element-ui-example></element-ui-example>
  </div>
        <script src="/js/app.js"></script>
    </body>
</html>
