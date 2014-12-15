<link rel=" stylesheet" type="text/css" href="<?php echo base_url();?>assets/qianduan/components/signin.css">
<style type="text/css">
  
  body {
  padding-top: 100px;
    }

</style>

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">实验班出题系统</a>

              <!-- <p class="navbar-text">功能-></p> -->
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav">
            </ul>


            <ul class="nav navbar-nav navbar-right">
              <li><a href="#" ><i class="glyphicon glyphicon-user"><span>请先登录</span></i></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">设置 <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">注销</a></li>
                  <li><a href="#">修改资料</a></li>
                  <!-- <li><a href="#">Something else here</a></li> -->
                  <li class="divider"></li>
                  <li><a href="#">关于出题系统</a></li>
                </ul>
              </li>
          </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav><!--top bar end-->
    <div  ng-controller="loginCtrl">
      <form   class="form-signin" role="form" ng-submit = "login()">
            <div class="col-md-2 col-md-offset-5">
              <h4>login</h4>
            </div>
            <input type="username" class="form-control" placeholder="Username" ng-model = "userName" required autofocus  >
            <input type="password" class="form-control" placeholder="Password"  ng-model = "password" required > 
            <!-- <a href="#">forget the password</a> -->
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