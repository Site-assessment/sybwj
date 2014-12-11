
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" ng-controller="teacherTestPage">
	<div   class="jumbotron">
		<div class="container">
			<h1>{{testform1.form.form_name}}</h1>
			<div ng-repeat="que in testform1.form.ques">
				<label>问题{{$index+1}}：</label>:<span>{{que.ques_name}}</span></p> 
				<ol type="A" >
					<li  ng-repeat="c in que.opt  track by $index"><span>{{c.content}}</span><span  ng-hide="c.is_answer==0">(is answer)</span></li>
				</ol>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
AdministratorPlatform.controller('teacherTestPage', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) { 
	$scope.testform1=<?=$form_info?>;
	console.log($scope.testform1);
}])
</script>
