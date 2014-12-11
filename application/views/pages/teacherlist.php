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
                      <td>{{$index+1}}</td>
                      <td><a href="<?=site_url().'index.php/admin/pannel_form/form_info/'?>{{form.form_id}}" >{{form.form_name}}</td>
                      <td>{{form.username}}</td>
                      <td>{{form.ctime}}</td>
                      <td><button type="button" class="btn btn-primary"   ng-click="page($index)">详情 </button>
                        <button type="button" class="btn btn-primary"   ng-click="edit($index)">编辑 </button>
                        <button type="button" class="btn btn-primary"   ng-click="delete($index)">删除</button>
                      </td>
                      <td>
                      <button type="button" class="btn btn-primary" id="use"  ng-click="use()">启用 </button>
                      </td>
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
  $scope.use=function(){
    x = document.getElementById("use");
    if(x.innerHTML=="启用")
      {alert("启用成功");
      x.innerHTML="已启用";}
      else if(x.innerHTML=="已启用")
       {alert("结束启用成功");
      x.innerHTML="启用";}
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