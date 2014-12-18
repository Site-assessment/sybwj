
<div id="welcome" ng-controller="teacherTestPage">
<div class="row placeholders">
			<h1 class="1">{{testform1.form.form_name}}</h1>
		</div>
			<div ng-repeat="que in testform1.form.ques" >
				<div ng-model="id" ng-init='id = $index'></div>
					<h1 class="page-header"></h1>
				<label>问题{{$index+1}}：:<span>{{que.ques_name}}</span></label>
				<ol type="A" >
					<li  ng-repeat="c in que.opt  track by $index"><span class="green{{c.is_answer}}">{{c.content}}</span></li>
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
