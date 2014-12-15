<link rel=" stylesheet" type="text/css" href="<?php echo base_url();?>assets/qianduan/components/signin.css">
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- <div class="container">
      <a class="navbar-brand" href="#">Question System</a>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Register</a></li>
        <li><a href="#">Log in</a></li>
      </ul>
      
        </div> -->
  </div>
    <div class="container" ng-controller="loginCtrl">
      <form class="form-signin" role="form" ng-submit = "login()">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="username" class="form-control" placeholder="Username" ng-model = "userName" required autofocus  >
        <input type="password" class="form-control" placeholder="Password"  ng-model = "password" required > 
        <a href="#">forget the password</a>
        <div class = "state1" ng-repeat="value in vm.values"><input type="radio" name="state" ng-model="vm.selection" ng-value="value"  ng-checked="vm.selection.state == value.state"/>{{value.statetext}}</div>
        </br>
       <p ng-show = "loginError">用户名或密码错误</p>
        <button class="btn btn-lg btn-primary btn-block" type="submit"  >Sign in</button>
      </form>
    </div> <!-- /container -->
  <script language="JavaScript">
    AdministratorPlatform.controller('loginCtrl', ['$http','$rootScope', '$scope', 'requestService', function ($http,$rootScope, $scope, requestService) {
    $rootScope.navShouldShow = false;
    console.log("aa");
    var vm = $scope.vm = {};
  vm.values = [
    {state: 0,statetext:'student'},
    {state: 1,statetext:'teacher'},
  ];
    //管理员登陆
    $scope.login = function () {
        requestService.login($scope);
    };
}])
</script>