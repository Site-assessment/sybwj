
<div ng-controller="teacherEditTest">
  <h1>{{testform1.form.form_name}}</h1>
<div ng-repeat="que in testform1.form.ques track by $index">
<p>题目:<span>{{que.ques_name}}</span><button type="button" ng-click="edit($index)">修改题目</button></p>
 <label>选项：</label> <ol type="A" >
  <li ng-repeat="opt in que.opts  track by $index"><span>{{opt.content}}</span><span ng-if="opt.id==que.is_answer">正确答案</span></li>
</ol>
</div>
<form role="form"  >
  <div >
  <div class="form-group" >
    <label >问题：</label>
    <input type="text" ng-model="testform1.form.ques[id].ques_name"  placeholder="Enter  question">
  </div> 
  <div class="form-group">
    <label>选项：</label>
     <div ng-repeat="opt in testform1.form.ques[id].opts"> 
      <input type="text" ng-model="opt.content" placeholder="Enter choice {{$index+1}} text">
      <input type="radio"  ng-model="testform1.form.ques[id].is_answer"name="{{testform1.form.ques[id]}}" value=" {{opt.id}}">答案
      {{testform1.form.ques[id].is_answer}}{{opt.id}}
        </div>
    </div>   
  <div class="row">
    <div class="col-xs-12">
      <button type="button"  ng-click="addChoice()"> 添加选项</button>
      <button type="button"  ng-click="deleteChoice()"> 删除选项</button>
    </div>

    </div> 
  <div class="row">
    <div class="col-xs-12">
      <button type="button"  ng-click="editQuestion()" ><span ></span> 修改题目</button>
      <button type="button"  ng-click="deleteQuestion()" ><span ></span> 修改题目</button>
    </div>
  </div>
   </div>
  <p><hr></p>
  
  <div class="row">
    <div class="col-xs-6">
    </div>
    <div class="col-xs-6">
      <button  type="submit" ng-submit="edittest()" >提交</button>
    </div>
  </div>
  
  <p>&nbsp;</p>
</form>
</div>
<script language="javascript">
AdministratorPlatform.controller('teacherEditTest', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) { 
  
$scope.testform1=<?=$form_info?>;
console.log('xad');
  $scope.id=0;
  $scope.opts_id=2;   
  $scope.edit = function($index) {
  $scope.id=$index;
  };
  $scope.addChoice = function() {
    $scope.testform1.form.ques[$scope.id].opts.push({id:++$scope.opts_id,content: '' });
  };
  $scope.deleteChoice = function() {
    $scope.edid=$scope.testform1.form.ques[$scope.id].opts.length-1;
    $scope.testform1.form.ques[$scope.id].opts.splice({id:$scope.edid,content: '' },1);
  };
  $scope.editQuestion=function(){
    $scope.id=0;
  };
$scope.editTest=function(){
  requestService.editTest($scope);
};
}])
</script>