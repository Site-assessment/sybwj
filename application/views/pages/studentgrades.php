
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" ng-controller="studentGradesCtrl">
  <table border="1"  class="table table-bordered table-hover">

  <tr>
    <th>测试名字</th>
    <th>测试人名字</th>
    <th>做题时间</th>
    <th>成绩</th>
  </tr>
  <tr ng-repeat="form in fm.formss">
    <td>{{form.form_name}}</td>
    <td>{{form.username}}</td>
    <td>{{form.ctime}}</td>
    <td>{{form.grades}}</td>
  </tr>
</table>
</div>
</div>
</div>
<script type="text/javascript">
AdministratorPlatform.controller('studentGradesCtrl', ['$http','$rootScope', '$scope', 'requestService', function ($http,$rootScope, $scope, requestService) {
       $rootScope.navShouldShow = false; 
    requestService.findListTest($scope);
    $scope.gettestid=function($index){
         requestService.form_id=$scope.tests[$index].form_id;
    };
}])
</script>
