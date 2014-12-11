 
AdministratorPlatform.controller('teacherGiveTestCtrl', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) { 
    $scope.testforms={
      user_id:'',
      username:'',
      form_id:'',
      form:{
      form_name:'',
      type:0,
    ques :[{
    ques_name: '',
    opts: [ {content: '' ,is_answer: 0 }, {content: '',is_answer: 0 }]
  }]
}
};
  $scope.id=0;
$scope.opts_id=1;
 $scope.testforms.type=0;
  $scope.edid=0;   
   console.log($scope.edid);
  $scope.trueanswer=function($index){
    for(var i=0;i<$scope.testforms.form.ques[$scope.id].opts.length;i++)
      $scope.testforms.form.ques[$scope.id].opts[i].is_answer=0;
    $scope.testforms.form.ques[$scope.id].opts[$index].is_answer=1;
  }
  $scope.edit = function($index) {
  $scope.id=$index;
  };
  $scope.addChoice = function() {
    $scope.testforms.form.ques[$scope.id].opts.push({content: '' ,is_answer: 0 });
    $scope.opts_id++;
  };
 $scope.deleteChoice = function() {
    $scope.edid=$scope.testforms.form.ques[$scope.id].opts.length-1;
    $scope.testforms.form.ques[$scope.id].opts.splice($scope.opts_id--,1);
  };
  $scope.addQuestion=function(){
      $scope.id++;
      $scope.edid=$scope.id;
      $scope.testforms.form.ques[$scope.id]={ ques_name: '',opts: [ {content: '' ,is_answer: 0 }, {content: '' ,is_answer: 0}]};
  };
  $scope.editQuestion=function(){
    $scope.id=$scope.edid;
      $scope.testforms.form.ques[$scope.id]={ ques_name: '',opts: [ {content: '' ,is_answer: 0 }, {content: '' ,is_answer: 0}]};
  };
   $scope.newtest = function () {
      requestService.newtest($scope);
    };
}])