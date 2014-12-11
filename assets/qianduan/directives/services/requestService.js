/**
 * created by Harbon
 * date:2014-10-26
 */

AdministratorPlatform.factory('requestService', ['$http', '$rootScope', '$location', function ($http, $rootScope, $location) {
//   后台地址
    var domain = "http://www.flappyant.com/sybwj/index.php/";
    var form_id='';
// 对象
    /*var testforms={
      user_id:'',
      username:'',
      form_id:'',
      form:{
        form_name:'',
        type:'',
        ques :[{
            ques_name: '',
            opts: [ {content: '',is_answer:0  }, {content: '',is_answer:0 }]
        }]
    }
    };*/
//    登陆
 var login = function ($scope) {
        var userName = $scope.userName;
        var password = $scope.password;
        var state=$scope.vm.selection.state;
        var loginMessage = {
            userId:userName,
            password:password,
            state:state
        }
        var state_url="";
        if(state==0){
            state_url="stu_login";
        }else{
            state_url="boss_login";
        }
        $http({
            method:'POST',
            url:domain+'admin/welcome/'+state_url,
            data:loginMessage,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (successInfo) {
            console.log('success');
            $rootScope.navShouldShow = true;
            if(state==1)
            $location.path('/teacher');
            else
            $location.path('/student');
            console.log(successInfo);
        }).error(function (errorInfo) {
            console.log('error');
            console.log(errorInfo);
        });
    }

    //    身份验证
    var validate = function () {
        if (!$rootScope.administrator.userId) {
            $location.path('/login')
        }
    }
    //分页初始化
    var paginationInit = function (tab, $scope) {
        currentTab = $scope;
        var url = '';
        if (tab == 0) {
            url = 'bookSum/1/0';
        }else{
            url = 'bookSum/1/1';
        }
        $http({
            method:'GET',
            url:domain+url
        }).success(function (result) {
            $scope.paginationShouldShow = true
            $scope.book_number = result.sum;
            var totalPages = parseInt(result.sum) / 15 + 1;
            var pages = [];
            for (var i = 1; i <= totalPages; i++) {
                pages.push(i);
            }
            $scope.pages = pages;
            if (tab == 0) {
                booksListRequest(1, $scope);
            }else{
                bookInLendingRequest(1, $scope);
            }

        }).error(function (result) {
            console.log(result);
        })
    }
//获得用户资料
var getUserInfo=function($scope){
     $http({
            url:'http://www.flappyant.com/sybwj/index.php/admin/pannel_form/form_add',
            method:'get'
        }).success(function (data, status, headers, config) {
        console.log("success...");
        console.log(data);
        $scope.userInfo=data;
    }).error(function (data, status, headers, config) {
        console.log("error...");
    })
}
//新建测试
var newtest = function ($scope) {
        var testforms=$scope.testforms;
        $http({
            method:'post',
            url:'http://www.flappyant.com/sybwj/index.php/admin/pannel_form/form_add',
            data:testforms
        }).success(function (successInfo) {
            console.log('success')
            $rootScope.navShuldShow = true;
            alert("创建成功");
            $location.path('/teachertestpage');
            console.log(successInfo);
        }).error(function (errorInfo) {
            console.log('error');
            console.log(errorInfo);
        });
    }
    //修改测试
var edittest = function ($scope) {
        var testforms=$scope.testforms;
        $http({
            method:'post',
            url:'http://www.flappyant.com/sybwj/index.php/admin/pannel_form/form_edit',
            data:testforms
        }).success(function (successInfo) {
            console.log('success')
            $rootScope.navShuldShow = true;
            alert("删除成功");
            $location.path('/teacherlist');
            console.log(successInfo);
        }).error(function (errorInfo) {
            console.log('error');
            console.log(errorInfo);
        });
    }
//删除测试
var deletetest = function ($scope) {
        var testforms=$scope.testforms;
        $http({
            method:'get',
            url:'http://www.flappyant.com/sybwj/admin/pannel_form/form_delete/'+form_id,
            data:testforms
        }).success(function (successInfo) {
            console.log('success')
            $rootScope.navShuldShow = true;
            alert("修改成功");
            $location.path('/teacher2');
            console.log(successInfo);
        }).error(function (errorInfo) {
            console.log('error');
            console.log(errorInfo);
        });
    }
//详情预览
var findTest = function($scope){
        $http({
            url:'http://www.flappyant.com/sybwj/admin/pannel_form/form_info/'+form_id,
            method:'get',
        }).success(function (data, status, headers, config) {
        console.log("success...");
        console.log(data);
        $scope.testform=data;
    }).error(function (data, status, headers, config) {
        console.log("error...");
    })
}
//导入学生完成的测试
var findStudentTest = function($scope){
        $http({
            method:'GET',
            url:'w.json'//'http://www.flappyant.com/sybwj/index.php/admin/pannel_form/form_edit',
        }).success(function(data, status, headers, config) {
        console.log("success...");
        console.log(data);
        $scope.testform1=data;
    }).error(function(data, status, headers, config) {
        console.log("error...");
    });
}
//    全部列表请求
var findListTest=function($scope){
     $http({
            url:'e.json',//domain+page+"?",
            method:'GET'
        }).success(function (data, status, headers, config) {
            console.log("success...");
            $scope.tests=data;
        }).error(function (data, status, headers, config) {
            console.log("error...");
        })
}
//发送学生完成的测试
var postStudentTest = function($scope){
    var testform=$scope.testform;
    $http({
            method:'POST',
            url:domain+'admin/welcome/',
            data:testform,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (successInfo) {
            console.log('success');
            $rootScope.navShouldShow = true;
            console.log(successInfo);
        }).error(function (errorInfo) {
            console.log('error');
            console.log(errorInfo);
        });
}
//登出
    var logout = function ($scope) {
        $rootScope.administrator = null;
        $location.path('/')
    }
    return {
        form_id:form_id,
        paginationInit:paginationInit,
        findTest:findTest,
        newtest:newtest,
        findStudentTest:findStudentTest,
        findListTest:findListTest,
        login:login,
        validate:validate,
        paginationInit:paginationInit,
        postStudentTest:postStudentTest
    }   
}])