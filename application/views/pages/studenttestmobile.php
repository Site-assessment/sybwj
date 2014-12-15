
  <div id="welcome"  ng-controller="studentTestCtrl">
  	   <!-- <div>
                  <div class="testname">
                      <p>{{testform.form.form_name}}</p>
                  </div>
              </div> -->

<div class = "question" ng-repeat="que in testform.form.ques track by $index">
    <div ng-model="id" ng-init='id = $index'>
<p>题目:<span>{{que.ques_name}}</span></p>
<ul>
  <li class="test" ng-repeat="op in que.opt  track by $index">
<input type="radio"  ng-model="op.stu_answer"  name="{{que.ques_name}}" value=" {{$index+1}}"  ng-click="trueanswer(id,$index)">{{op.content}}</li>
</ul>
</div>
<div class="col-md-8 col-md-offset-2"> 
<input  class="btn btn-info" type="submit" ng-click="postStudentTestMobile()" value="提交">
</div>

</div>
</div>

</div>
<script type="text/javascript">
AdministratorPlatform.controller('studentTestCtrl', ['$location','$http','$rootScope', '$scope', 'requestService', function ($location,$http,$rootScope, $scope, requestService) { 
$scope.testform=<?=$test_content?>;
$scope.userinfo=<?=$userinfo?>;
console.log($scope.testform);
$scope.id=0;
$scope.grades={
                      user_id:$scope.userinfo.user_id,
                      username:$scope.userinfo.username,
                     form_id:$scope.testform.form_id,
                     grade :0,
                     answer:[{ques_id:0,opt_id:0,opt_content:''}]
          }    
for(var i=0;i<$scope.testform.form.ques.length-1;i++)
$scope.grades.answer.push({ques_id:0,opt_id:0,opt_content:''});
console.log($scope.grades);
 $scope.trueanswer=function(id,$index){
    console.log(id);
    console.log($index);
      $scope.grades.answer[id].ques_id=$scope.testform.form.ques[id].ques_id;
      $scope.grades.answer[id].opt_id= $scope.testform.form.ques[id].opt[$index].opt_id;
      $scope.grades.answer[id].opt_content= $scope.testform.form.ques[id].opt[$index].content;
  }
$scope.postStudentTestMobile = function () {
      var answer=0;
      var stu=0;
      $scope.grades.grade=100%($scope.testform.form.ques.length);
      console.log($scope.grades);
      $scope.mgrades=100/$scope.testform.form.ques.length;
      $scope.success=true;
      for(var i=0;i<$scope.testform.form.ques.length;i++)
      {
        answer=0;
        for(var j=0;j<$scope.testform.form.ques[i].opt.length;j++)
            {
                if($scope.testform.form.ques[i].opt[j].is_answer==1)
         answer=parseInt($scope.testform.form.ques[i].opt[j].opt_id);}
         stu=parseInt($scope.grades.answer[i].opt_id);
         console.log(stu);
        if(stu==0)
         $scope.success=false;
        if(stu!=0)
        {if(answer==stu)
          $scope.grades.grade=$scope.grades.grade+$scope.mgrades;
         }
      }
      if($scope.success==false)
         alert("有题目没答完");
      if($scope.success==true)
       { requestService.postStudentTestMobile($scope);
        alert("题目答完,分数为"+$scope.grades.grade);}
    };
}])
</script>