
    <div class="panel-body" ng-controller="studentThemeCtrl">
            <!-- 问卷列表 -->
          <table class="table table-striped">
                    <tr class="success">
                      <td>序号</td>
                      <td>标题</td>
                      <td>出题人</td>
                      <td>出题时间</td>
                      <td>操作</td>
                    </tr> 
                    <tr   ng-repeat="form in tests">
                      <td>{{$index+1}}</td>
                      <td><a href="<?=site_url().'index.php/user/answer/answer_in/'?>{{form.form_id}}" >{{form.form_name}}</td>
                      <td>{{form.username}}</td>
                      <td>{{form.cTime}}</td>
                      <td><button type="button" class="btn btn-primary"   ng-click="page($index)">详情 </button>
                      </td>
                    </tr>
                </table>
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
