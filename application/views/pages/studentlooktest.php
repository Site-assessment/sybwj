
<div ng-controller="studentLookTestCtrl">
	<div class="row placeholders">
  <h1>{{testform2.form.form_name}}</h1>
  </div>
<div ng-repeat="que in testform2.form.ques track by $index">
	<div ng-model="id" ng-init="id=$index"></div>
	<h1 class="page-header"></h1>
<label>题目:<span>{{que.ques_name}}</span></label>
 <ol type="A">
  <li class="test" ng-repeat="op in que.opt  track by $index"><span ng-if="answered_info.answer[que.ques_id].opt_id!=op.opt_id||op.is_answer!=0" class="green{{op.is_answer}}">{{op.content}}</span><span ng-if="answered_info.answer[que.ques_id].opt_id==op.opt_id&&op.is_answer==0" class="red">{{op.content}}</span></li>
</ol>
</div>
<!--  <a href="/studnet1" >返回 &raquo;</button>
 --></div>
<script type="text/javascript">
AdministratorPlatform.controller('studentLookTestCtrl', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) {
$scope.testform2=<?=$test_content?>;
$scope.answered_info=<?=$answered_info?>;
console.log($scope.answered_info);
console.log($scope.testform2);
}])
</script>

