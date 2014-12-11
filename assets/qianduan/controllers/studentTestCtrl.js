AdministratorPlatform.controller('studentTestCtrl', ['$location','$http','$rootScope', '$scope', 'requestService', function ($location,$http,$rootScope, $scope, requestService) { 
requestService.findTest($scope);
$scope.postStudentTest = function () {
      $scope.score=100;
      $scope.mscore=100/$scope.testform.form.ques.length;
      console.log($scope.testform);
      for(var i=0;i<$scope.testform.form.ques.length;i++){
        console.log($scope.testform.form.ques.length);
        console.log($scope.mscore);
        var answer=parseInt($scope.testform.form.ques[i].is_answer);
        var stu=parseInt($scope.testform.form.ques[i].stu_answer);
        if(answer!=stu)
          $scope.score=100-$scope.mscore;
      }
        console.log($scope.score);
        requestService.postStudentTest($scope);
    };
}])