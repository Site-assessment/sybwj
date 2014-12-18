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
    <div class="panel-body" ng-controller="studentThemeCtrl">
            <!-- 问卷列表 -->
        <div class="box">
                    
            <div class="box-body table-responsive">
               <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <td>问卷ID</td>
                          <td>标题</td>
                          <td>出题人</td>
                          <td>出题时间</td>
                          <td>操作</td>
                        </tr> 
                    </thead>
                    <tbody>
                        <tr   ng-repeat="form in tests">
                          <td>{{form.form_id}}</td>
                          <!-- <a href="<?=site_url().'index.php/user/answer/answer_in/'?>{{form.form_id}}" > -->
                          <td>{{form.form_name}}</td>
                          <td>{{form.username}}</td>
                          <td>{{form.cTime}}</td>
                          <td><button type="button" class="btn btn-sm btn-link"   ng-click="page($index)">答题 </button>
                          </td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
</div>
<script type="text/javascript">
AdministratorPlatform.controller('studentThemeCtrl', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) {
  $scope.tests=<?=$test_list?>;
  console.log($scope.tests);
  $scope.page=function($index){
     window.location.href="<?=site_url().'index.php/user/answer/answer_in/'?>"+$scope.tests[$index].form_id;
  }
}])
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
