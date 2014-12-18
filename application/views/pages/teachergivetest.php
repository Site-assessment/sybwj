
<div  ng-controller="teacherGiveTestCtrl" >
 <div class="container"  >
  <form role="form" ng-submit="newtest()" >
   <div class="input-group">
    <h2 >试卷名字:<span id="testname1" ng-init="testforms.form.form_name='测试'">{{testforms.form.form_name}}</span>
      <input id="testname2" class="form-control"  style="display:none" type="text" ng-model="testforms.form.form_name" placeholder="Enter  name"></h2>
    </div>
    <div  ng-repeat="que in testforms.form.ques track by $index" >
      <div ng-init="id=$index" ng-model="id"></div>
      <div class="input-group">
      <label >问题{{id+1}}：</label>
      <label ng-init="que.ques_name='问题'" id="ques{{id}}">{{que.ques_name}}</label>
      <input id="quesinput{{id}}" style="display:none" type="text" class="form-control" ng-model="que.ques_name"  placeholder="Enter  question">
      <button id="ts" type="button" class="btn btn-xs" ng-click="deleteQuestion($index,id)"><i class="glyphicon glyphicon-remove"></i></button>
      </div>
    <div ng-repeat="op in que.opt">
    <div class="input-group"> 
     <input type="radio"   name="{{id}}" value="1" id="{{$index+1}}" ng-click="trueanswer($index,id)">
       <label id="opt{{id}}{{$index}}" ng-init="op.content='选项'" class="green{{op.is_answer}}" >{{op.content}}</label>
       <input id="optinput{{id}}{{$index}}" style="display:none"  type="text"  class="form-control" ng-model="op.content" placeholder="Enter choice {{$index+1}} text"> </input>        
       <button id="ts" type="button"  class="btn btn-group-xs" ng-click="deleteChoice($index,id)"><i class="glyphicon glyphicon-minus"></i></button>
       </div>
   </div>
   <button type="button" id="ts" class="btn btn-group-xs" ng-click="addChoice(id)"> <i class="glyphicon glyphicon-plus"></i></button>
   </div>
    <button type="button" class="btn btn-primary" ng-click="addQuestion(id)"><i class="glyphicon glyphicon-plus"></i>添加问题</button>  
  <div class="row">
    <div class="col-xs-6">
    </div>
    <div class="col-xs-6">
      <div class="submit"><button  type="submit" class="btn btn-primary submit" ng-submit="newtest()" ><i class="glyphicon glyphicon-ok"></i>提交</button></div>
    </div>
  </div>
      
</form>
</div>
</div>
<script type="text/javascript">

AdministratorPlatform.controller('teacherGiveTestCtrl', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) {     
    $scope.testforms=requestService.testforms;
    $scope.userinfo=<?=$userinfo?>;
    console.log($scope.userinfo);
    console.log($scope.testforms);
    $scope.testforms.user_id=$scope.userinfo.user_id;
    $scope.testforms.username=$scope.userinfo.realname;
$scope.opt_id=1;
  $scope.edid=1;   
     //判断:当前元素是否是被筛选元素的子元素 
jQuery.fn.isChildOf = function(b){ return (this.parents(b).length > 0); }; 
//判断:当前元素是否是被筛选元素的子元素或者本身 
jQuery.fn.isChildAndSelfOf = function(b){ return (this.closest(b).length > 0); }; 
$(document).click(function(event){
 if($(event.target).isChildAndSelfOf("#testname1")==true)
  {$("#testname1").hide();
$("#testname2").show();
$("#testname2").focus();}
else if($(event.target).isChildAndSelfOf("#testname2")==false)
 { $("#testname2").hide();
$("#testname1").show();}
for (var i=0;i<$scope.testforms.form.ques.length;i++)
  {if($(event.target).isChildAndSelfOf("#ques"+i)==true)  
  {
    $("#ques"+i).hide();
    $("#quesinput"+i).show();
    $("#quesinput"+i).focus();}
    else if($(event.target).isChildAndSelfOf("#quesinput"+i)==false)
     { $("#quesinput"+i).hide();
   $("#ques"+i).show();}
   for (var j=0;j<$scope.testforms.form.ques[i].opt.length;j++)
    if($(event.target).isChildAndSelfOf("#opt"+i+j)==true)  
     {
   $("#opt"+i+j).hide();
   $("#optinput"+i+j).show();
   $("#optinput"+i+j).focus();}
   else if($(event.target).isChildAndSelfOf("#optinput"+i+j)==false)
     { $("#optinput"+i+j).hide();
   $("#opt"+i+j).show();}
 }
 });
  $scope.trueanswer=function($index,id){
    for(var i=0;i<$scope.testforms.form.ques[id].opt.length;i++)
      $scope.testforms.form.ques[id].opt[i].is_answer=0;
    $scope.testforms.form.ques[id].opt[$index].is_answer=1;
  }
  $scope.addChoice = function(id) {
    console.log($scope.testforms.form.ques[id].opt);
    $scope.testforms.form.ques[id].opt.push({content: '' ,is_answer: 0 });
  };
 $scope.deleteChoice = function($index,id) {
    $scope.testforms.form.ques[id].opt.splice($index,1);

  };
  $scope.addQuestion=function(id){
      $scope.testforms.form.ques.push({ ques_name: '',opt: [ {content: '' ,is_answer: 0 }, {content: '' ,is_answer: 0}]});
  };
  $scope.deleteQuestion=function(id){
     $scope.testforms.form.ques.splice(id,1);
  };
   $scope.newtest = function () {
    requestService.newtest($scope);
    };
}])
  </script>
 </body>
</html>