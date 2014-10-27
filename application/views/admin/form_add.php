
<style type="text/css">
	button.right {
         float: right;
	}
</style>

</head>
<body>
  <div class="content">
 	<div class="panel panel-info">
 		<div class="panel-heading">
 			<div class="panel-title">
 				新增问卷
 			</div>
 		</div>
 		<div class="panel-body">
 		        <form action="<?=site_url('admin/pannel_form/form_list')?>" class="form-horizontal" role="form">
					  <div class="form-group">
					    <label for="form_title" class="col-sm-2 control-label">标题：</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="form_title" placeholder="标题">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="quest_name" class="col-sm-2 control-label">问题一：</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="quest_name" placeholder="问题1">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="opt_1" class="col-sm-2 control-label">选项：</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="opt_1" placeholder="请输入选项内容">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="opt_2" class="col-sm-2 control-label">选项：</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="opt_2" placeholder="请输入选项内容">
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-default right">提交</button>
					    </div>
					  </div>
				</form>
				<div>
					<button type="button" class="btn btn-info">新增问题</button>
                    <button type="button" class="btn btn-info">新增选项</button>
				</div>
 			   
 		</div>

 	</div>
 </div>
  </body>
</html>