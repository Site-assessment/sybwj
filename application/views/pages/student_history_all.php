<div class="panel-body" ng-controller="studentHistoryCtrl">
            <!-- 问卷列表 -->
          <table class="table table-striped">
                    <tr class="success">
                      <td>测试ID</td>
                      <td>标题</td>
                      <td>做题人</td>
                      <td>做题时间</td>
                      <td>得分</td>
                      <td>操作</td>
                      
                    </tr> 
                    <tr   ng-repeat="form in tests">
                      <td>{{form.answer_group_id}}</td>
                      <!-- <a href="<?=site_url().'index.php/user/answer/answer_in/'?>{{form.form_id}}" > -->
                      <td>{{form.form_name}}</td>
                      <td>{{form.realname}}</td>
                      <td>{{form.cTime}}</td>
                      <td>{{form.grade}}</td>
                      <td><button type="button" class="btn btn-sm"   ng-click="page($index)">详情 </button>
                      </td>
                    </tr>
                </table>
</div>
<script language="JavaScript">
AdministratorPlatform.controller('studentHistoryCtrl', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) { 
   $scope.tests=<?=$answered_list?>;
   console.log($scope.tests);
   $scope.page=function($index){
     window.location.href="<?=site_url().'index.php/user/answer/answered_info/'?>"+$scope.tests[$index].answer_group_id+'/'+$scope.tests[$index].form_id+'/'+$scope.tests[$index].user_id;
  }
  }])
</script>