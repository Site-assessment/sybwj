
    <div  class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" ng-cotroller="teacherGradesCtrl"> 
    <div id="welcome" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1 class="page-header"></h1>
      <div class="row placeholders" ng-repeat="test in tests">
        <div class="testname">
          <p><a href="/studenttest" ng-click="gettestid($index)">测试卷{{$index+1}}：{{test.form_name}}</a></p>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
<script type="text/javascript">
AdministratorPlatform.controller('teacherGradesCtrl', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) {
    $rootScope.paginationShouldShow = true;
    requestService.findStudentListTest($scope);
}])
</script>