
<div ng-controller="studentLookTestCtrl">
  <h1>{{testform2.form.form_name}}</h1>
<div ng-repeat="que in testform2.form.ques track by $index">
	<div ng-model="id" ng-init="id=$index"></div>
<p>题目:<span>{{que.ques_name}}</span></p>
 <label>选项：</label> <ol type="A">
  <li class="test" ng-repeat="op in que.opt  track by $index"><span>{{op.content}}</span><span ng-if="answered_info.answer[que.ques_id].opt_id==op.opt_id">你选择的答案</span>&nbsp <span ng-if="op.is_answer==1">正确答案</span>{{que.stu_answer}}</li>
</ol>
</div>
 <a href="/studnet1" >返回 &raquo;</button>
</div>
<script type="text/javascript">
AdministratorPlatform.controller('studentLookTestCtrl', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) {
$scope.testform2=<?=$test_content?>;
$scope.answered_info=<?=$answered_info?>;
console.log($scope.answered_info);
console.log($scope.testform2);
}])
</script>

