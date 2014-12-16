
<div ng-controller="teacherEditTest">
    <div   class="jumbotron">
        <div class="container">
          <h1>{{testform1.form.form_name}}</h1>
          <div ng-repeat="que in testforms.form.ques track by $index">
            <p>题目:<span>{{que.ques_name}}</span><button type="button" class="btn btn-sm" ng-click="edit($index)">修改题目</button></p>
            <label>选项：</label> <ol type="A" >
            <li ng-repeat="opt in que.opt  track by $index"><span>{{opt.content}}</span><span ng-if="opt.is_answer == 1">正确答案</span></li>
        </ol>
    </div>
</div>
</div>
<form role="form" ng-submit="editTest()" >
  <div >
      <div class="form-group" >
        <label >问题：</label>
        <input type="text" ng-model="testforms.form.ques[id].ques_name"  placeholder="Enter  question">
    </div> 
    <div class="form-group">
        <label>选项：</label>
        <div ng-repeat="opt in testforms.form.ques[id].opt"> 
          <input type="text" ng-model="opt.content" placeholder="Enter choice {{$index+1}} text">
          <input type="radio"  ng-model="opt.is_answer" name="{{testforms.form.ques[id]}}" value="1" ng-click="trueanswer($index)">正确答案
          <!-- {{opt.opt_id}}{{opt.is_answer}} -->
      </div>
  </div>   
  <div class="row">
    <div class="col-xs-12">
      <button type="button"  class="btn btn-sm" ng-click="addChoice()"> 添加选项</button>
      <button type="button" class="btn btn-sm"  ng-click="deleteChoice()"> 删除选项</button>
  </div>

</div> 
<div class="row">
    <div class="col-xs-12">
      <button type="button" class="btn btn-sm"  ng-click="addQuestion()" ><span ></span> 增加题目</button>
      <button type="button" class="btn btn-sm" ng-click="deleteQuestion()" ><span ></span> 删除题目</button>
  </div>
</div>
</div>
<p><hr></p>

<div class="row">
    <div class="col-xs-6">
    </div>
    <div class="col-xs-6">
      <button  type="submit" class="btn btn-sm submit" ng-submit="editTest()" >提交</button>
  </div>
</div>

<p>&nbsp;</p>
</form>
</div>
<script language="javascript">
    AdministratorPlatform.controller('teacherEditTest', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) { 

        $scope.testforms=<?=$form_info?>;
        console.log('xad');
          $scope.id=0;
          $scope.opt_id=2; 
          $scope.edid=0;   
          $scope.did=0;
        // $scope.id=0;
        // $scope.opts_id=2;   
$scope.trueanswer=function($index){
    for(var i=0;i<$scope.testforms.form.ques[$scope.id].opt.length;i++)
      $scope.testforms.form.ques[$scope.id].opt[i].is_answer=0;
    $scope.testforms.form.ques[$scope.id].opt[$index].is_answer=1;
  }
  $scope.edit = function($index) {
  $scope.id=$index;
  };
  $scope.addChoice = function() {
    $scope.testforms.form.ques[$scope.id].opt.push({content: '',is_answer:0 });
  };
  $scope.deleteQuestion = function() {
     $scope.did=$scope.id;
     $scope.testforms.form.ques.splice($scope.did,1);
  };
  $scope.deleteChoice = function() {
    $scope.edid=$scope.testforms.form.ques[$scope.id].opt.length-1;
    $scope.testforms.form.ques[$scope.id].opt.splice($scope.opts_id--,1);
  };
    $scope.addQuestion=function(){
      $scope.id++;
      $scope.edid=$scope.id;
      $scope.testforms.form.ques[$scope.id]={ ques_name: '',opt: [ {content: '' ,is_answer: 0 }, {content: '' ,is_answer: 0}]};
  };
  $scope.editQuestion=function(){
    $scope.id=$scope.edid;
  };
$scope.editTest=function(){
  requestService.editTest($scope);
};
  //       $scope.edit = function($index) {
  //         $scope.id=$index;
  //     };
  //     $scope.addChoice = function() {
  //       $scope.testform1.form.ques[$scope.id].opts.push({id:++$scope.opts_id,content: '' });
  //   };
  //   $scope.deleteChoice = function() {
  //       $scope.edid=$scope.testform1.form.ques[$scope.id].opts.length-1;
  //       $scope.testform1.form.ques[$scope.id].opts.splice({id:$scope.edid,content: '' },1);
  //   };
  //   $scope.editQuestion=function(){
  //   $scope.id=$scope.edid;
  //   };
  //   $scope.editTest=function(){
  //     requestService.editTest($scope);
  // };
}])
</script>