<div class="panel-body" ng-controller="teacherListCtrl">
            <!-- 问卷列表 -->
          <table class="table table-striped">
                    <tr class="success">
                      <td>序号</td>
                      <td>标题</td>
                      <td>出题人</td>
                      <td>出题时间</td>
                      <td>操作</td>
                      <td>状态</td>
                    </tr> 
                    <tr   ng-repeat="form in formlist">
                      <td>{{form.form_id}}</td>
                      <td><a href="<?=site_url().'index.php/admin/pannel_form/form_info/'?>{{form.form_id}}" >{{form.form_name}}</td>
                      <td>{{form.username}}</td>
                      <td>{{form.cTime}}</td>
                      <td><button type="button" class="btn btn-sm btn-link"   ng-click="page($index)">详情 </button>
                        <button type="button" class="btn btn-sm btn-link"   ng-click="edit($index)">编辑 </button>
                        <button type="button" class="btn btn-sm btn-link"   ng-click="delete($index)">删除</button>
                        <button data-href="#" class="btn btn-sm btn-link btn-pass" data-id="form.form_id"> 启用</button>

                         <button data-href="#" class="btn btn-sm btn-link reject" data-id="form.form_id"> 停止</button>
                      </td>
                      <td>

                      <td id="status_{{form.form_id}}">

                         <span ng-if="form.status==0">未启用</span>
                         <span ng-if="form.status==1">进行中</span>
                                    

                      </td>
<!--                       <button type="button" class="btn btn-primary"   ng-click="use($index)" value="启用"><div id="use">启用</div> </button>
                      </td> -->
                    </tr>
                </table>
</div>
<script type="text/javascript">
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