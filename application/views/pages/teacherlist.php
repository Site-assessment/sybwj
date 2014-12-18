    <link href="<?=DIR_AdminLTE?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABES SCRIPT -->
    <script src="<?=DIR_AdminLTE?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?=DIR_AdminLTE?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <style type="text/css">
/*        .box{
            border-top: 2px solid #00c0ef;
        }*/

        .fa{
            padding-left: 10px;
        }

        .error{
            color:red;
        }

        .ope .btn-sm{
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .display_info{
            height: 42px;
            line-height: 42px;
            float: right;
            padding-right: 15px;
        }

        .display_info a{
            color: #FF6600 !important;
        }
    </style>

<div class="panel-body" ng-controller="teacherListCtrl">
    <div class="box">
        <div class="box-body table-responsive">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <td>问卷ID</td>
                      <td>标题</td>
                      <td>出题人</td>
                      <td>出题时间</td>
                    <td>状态</td>
                     <td>操作</td>
                    </tr> 
                </thead>
                <tbody>
                    <tr   ng-repeat="form in formlist">
                      <td>{{form.form_id}}</td>
                      <td><a href="<?=site_url().'index.php/admin/pannel_form/form_info/'?>{{form.form_id}}" >{{form.form_name}}</a></td>
                      <td>{{form.username}}</td>
                      <td>{{form.cTime}}</td>
                      <td id="status_{{form.form_id}}">

                         <span ng-if="form.status==0">未启用</span>
                         <span ng-if="form.status==1">进行中</span>
                                    

                      </td>
                      <td><button type="button" class="btn btn-sm btn-link"   ng-click="page($index)">详情 </button>
                        <button type="button" class="btn btn-sm btn-link"   ng-click="edit($index)">编辑 </button>
                        <button type="button" class="btn btn-sm btn-link"   ng-click="delete($index)">删除</button>
                        <a href="<?=base_url()?>index.php/admin/pannel_form/form_display/{{form.form_id}}/start" class="btn btn-sm text-info">启用</a>
                        <a href="<?=base_url()?>index.php/admin/pannel_form/form_display/{{form.form_id}}/stop" class="btn btn-sm text-info">停止</a>                       
                       <!--  <button data-href="<?=base_url()?>admin/pannel_form/form_display/{{form.form_id}}/start" class="btn btn-sm btn-link btn-pass" data-id="{{form.form_id}}"> 启用</button>

                         <button data-href="<?=base_url()?>admin/pannel_form/form_display/{{form.form_id}}/stop" class="btn btn-sm btn-link reject" data-id="{{form.form_id}}"> 停止</button> -->
                      </td>


<!--                       <button type="button" class="btn btn-primary"   ng-click="use($index)" value="启用"><div id="use">启用</div> </button>
                      </td> -->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">

         /**
         * @abstract 绑定停止事件 
         */
         $('.reject').on('click',function(){
            _id = $(this).attr('data-id');
            _url = $(this).attr('data-href');

            $.get(_url,function(data){
                if(!data['errorcode']){
                    _display = '进行中';
                    $("#status_"+data['form_id']).html(_display);
                }
            },'json');

         });

        /**
         * @abstract 绑定启用事件 
         */
         $('.btn-pass').on('click',function(){
            _id = $(this).attr('data-id');
            _url = $(this).attr('data-href');

            $.get(_url,function(data){
                if(!data['errorcode']){
                    _display = '已启用';
                    $("#status_"+data['form_id']).html(_display);
                }
            },'json');

         });





AdministratorPlatform.controller('teacherListCtrl', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) {
  console.log('aa');
  $scope.formlist=<?=$formlist?>;
  $scope.form_id=0;
  console.log($scope.formlist);
  $scope.page=function($index){
     window.location.href="<?=site_url().'index.php/admin/pannel_form/form_info/'?>"+$scope.formlist[$index].form_id;
  }
$scope.use=function($index){
    console.log($index);
    console.log($scope.formlist[$index].form_id);
    var $content1 = "已启用";
    var $content2= "启用";
    if($("#use").text()==$content2)
     $("#use").html($content1);
   else 
    $("#use").html($content2);
  requestService.typeChange($scope,$index);
  }
$scope.edit=function($index){
  window.location.href="<?=site_url().'index.php/admin/pannel_form/form_edit/'?>"+$scope.formlist[$index].form_id;
}
$scope.delete=function($index){
  $scope.form_id=$scope.formlist[$index].form_id;

  requestService.deleteTest($scope);
}
}])
</script>
</script>
    <script type="text/javascript">
        $(function() {
            $('#example').dataTable({
                "oLanguage": {
                    "sProcessing": "正在加载中...",
                    "sLengthMenu": "每页显示 _MENU_ 条记录",
                    "sZeroRecords": "对不起，查询不到相关数据！",
                    "sEmptyTable": "表中无数据存在！",
                    "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
                    "sInfoFiltered": "数据表中共有 _MAX_ 条记录",
                    "sSearch": "搜索",
                    "oPaginate": {
                        "sFirst": "首页",
                        "sPrevious": "上一页",
                        "sNext": "下一页",
                        "sLast": "末页"
                    },
                    "sInfoEmpty": "条目为空",
                }
            });
        });
</script>
