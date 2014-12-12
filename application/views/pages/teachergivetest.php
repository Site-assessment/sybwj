    
</head>
  <body ng-app="AdministratorPlatform">
  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" ng-controller="teacherGiveTestCtrl">
    <div   class="jumbotron">
       <div class="container">
          <form role="form" ng-submit="newtest()" >
             <div class="input-group"><h2>创建试卷名字:{{testforms.form.form_name}}</h2><input class="form-control" type="text" ng-model="testforms.form.form_name" placeholder="Enter  name"></div>
             <div ng-repeat="que in testforms.form.ques track by $index">
                <label>题目:</label><span>{{que. ques_name}}</span><button type="button" ng-click="edit($index)"  class="btn btn-sm">修改题目</button>
                <br /><label>选项：</label> 
                <ol type="A" >
                  <li ng-repeat="op in que.opt  track by $index"><span>{{op.content}}</span><span ng-if="op.is_answer==1">正确答案</span></li>
              </ol>
          </div>
          <div >
            <div class="form-group" >
              <label >问题：</label>
              <input type="text" class="form-control" ng-model="testforms.form.ques[id].ques_name"  placeholder="Enter  question">
          </div> 
          <div class="form-group">
              <label>选项：</label>
              <div ng-repeat="op in testforms.form.ques[id].opt"> 
                <input type="text" class="form-control" ng-model="op.content" placeholder="Enter choice {{$index+1}} text">
                <input type="radio"   name="{{testforms.form.ques[id]}}" value="1" ng-click="trueanswer($index)">答案
            </div>
        </div>   
        <div class="row">
          <div class="col-xs-12">
            <button type="button"  class="btn btn-sm" ng-click="addChoice()"> 添加选项</button>
            <button type="button"  class="btn btn-sm" ng-click="deleteChoice()"> 删除选项</button>
        </div>
    </div> 
    <div class="row">
      <div class="col-xs-12">
        <button type="button" class="btn btn-sm" ng-click="addQuestion()"  ng-show="id==edid"    ><span ></span> 添加题目</button>
        <button type="button" class="btn btn-sm" ng-click="editQuestion()" ng-show="id!=edid"    ><span ></span> 修改题目</button>
        <button type="button" class="btn btn-sm" ng-click="deleteQuestion()"><span ></span> 删除题目</button>
    </div>
</div> 
<div class="row">
  <div class="col-xs-6">
    <div class="submit"><button  type="submit" class="btn btn-primary submit" ng-submit="newtest()" >提交 &raquo;</button></div>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
AdministratorPlatform.controller('teacherGiveTestCtrl', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) {      console.log($scope.userinfo);
    $scope.testforms=requestService.testforms;
    $scope.userinfo=<?=$userinfo?>;
    console.log($scope.userinfo);
    console.log($scope.testforms);
    $scope.testforms.user_id=$scope.userinfo.user_id;
    $scope.testforms.username=$scope.userinfo.realname;
  $scope.id=0;
$scope.opt_id=1;
  $scope.edid=0;   
   console.log($scope.edid);
  $scope.trueanswer=function($index){
    for(var i=0;i<$scope.testforms.form.ques[$scope.id].opt.length;i++)
      $scope.testforms.form.ques[$scope.id].opt[i].is_answer=0;
    $scope.testforms.form.ques[$scope.id].opt[$index].is_answer=1;
  }
  $scope.edit = function($index) {
  $scope.id=$index;
  };
  $scope.addChoice = function() {
    $scope.testforms.form.ques[$scope.id].opt.push({content: '' ,is_answer: 0 });
    $scope.opts_id++;
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
      // $scope.testforms.form.ques[$scope.id]={ ques_name: '',opt: [ {content: '' ,is_answer: 0 }, {content: '' ,is_answer: 0}]};
  };
  $scope.deleteQuestion=function(){
    $scope.did=$scope.id;
     $scope.testforms.form.ques.splice($scope.did,1);
     // $scope.testforms.form.ques.splice($scope.id,1);
  };
   $scope.newtest = function () {
      requestService.newtest($scope);
    };
}])
  </script>
 </body>
</html>