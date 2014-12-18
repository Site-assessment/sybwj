/**
 * created by Harbon
 * date:2014-10-26
 */

AdministratorPlatform.factory('requestService', ['$http', '$rootScope', '$location', function ($http, $rootScope, $location) {
//   后台地址
    var domain = "http://www.flappyant.com/sybwj/";
    var form_id='';
// 对象
    var testforms={
      user_id:'',
      username:'',
      form:{  
        form_name:'',
        ques :[{
            ques_name: '',
            opt: [ {content: '',is_answer:0  }, {content: '',is_answer:0 }]
        }]
    }
    };
//    登陆
 var login = function ($scope) {
        // var state = '';
        var userName = $scope.userName;
        var password = $scope.password;
        if ($scope.vm.selection.state == null) {
            $scope.vm.selection.state == '';
        };
        var state=$scope.vm.selection.state;
        var loginMessage = {
            username:userName,
            password:password,
            state:state
        }
        $http({
            method:'POST',
            url:domain+'admin/welcome/boss_login',
            data:loginMessage
            //headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (successInfo) {
            console.log('success');
            if(successInfo.errorcode==0)
            {
                if(state==1)
                window.location.href=domain+'admin/welcome'; 
                else
                window.location.href=domain+'user/answer/index'; 
            }else if (successInfo.errorcode==1){

                alert("请正确选择身份!");

            }else if(successInfo.errorcode==2){
                alert("用户名或密码错误!");

            }else if(successInfo.errorcode==3){
                alert("您还未选择身份!");

            }
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

//新建测试
var newtest = function ($scope) {
        var testform=$scope.testforms;
        console.log(testform);
        $http({
            method:'post',
            url:domain+'admin/pannel_form/form_add',
            data:testform
        }).success(function (successInfo) {
            console.log(successInfo);
            if(successInfo.errorcode==0)
           {alert("创建成功");
            window.location.href=domain+'admin/pannel_form/form_list'; }
            else
            alert("创建失败");
        }).error(function (errorInfo) {
            console.log('error');
            console.log(errorInfo);
        });
    }
    //修改测试
var editTest = function ($scope) {
        var testform1=$scope.testforms;
        console.log(testform1);
        $http({
            method:'post',
            url:domain+'admin/pannel_form/form_edit',
            data:testform1
        }).success(function (successInfo) {
             if(successInfo.errorcode==0)
           {alert("修改成功");
            window.location.href=domain+'admin/pannel_form/form_list'; }
            else
            alert("修改失败");
            console.log(successInfo);
        }).error(function (errorInfo) {
            console.log('error');
            console.log(errorInfo);
        });
    }
//删除测试
var deleteTest = function ($scope) {
        $http({
            method:'get',
            url:domain+'admin/pannel_form/form_delete/'+$scope.form_id,
            data:testforms
        }).success(function (successInfo) {
             if(successInfo.errorcode==0)
           {
            alert("删除成功");
            window.location.href=domain+'admin/pannel_form/form_list';
             }
            else
            {
                alert("删除失败");
            }
            // window.location.href=domain+'admin/pannel_form/form_list'; }
            console.log(successInfo);
        }).error(function (errorInfo) {
            console.log('error');
            console.log(errorInfo);
        });
    }

//发送学生完成的测试
var postStudentTest = function($scope){
    var grades=$scope.grades;
    $http({
            method:'POST',
            url:domain+'user/answer/answer_in/'+$scope.testform.form_id,
            data:grades
        }).success(function (successInfo) {
             if(successInfo.errorcode==0)
            window.location.href=domain+'user/answer/answered_list'; 
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

    var typeChange = function($scope,$index){
    $http({
        method:'get',
        url:domain+'admin/pannel_form/form_display/'+$scope.formlist[$index].form_id,
        }).success(function (successInfo) {
             if(successInfo.errorcode==0)
            window.location.href=domain+'admin/pannel_form/form_list'; 
        }).error(function (errorInfo) {
            console.log('error');
            console.log(errorInfo);
        });
    }

    return {
        editTest:editTest,
        form_id:form_id,
        paginationInit:paginationInit,
        newtest:newtest,
        login:login,
        validate:validate,
        paginationInit:paginationInit,
        postStudentTest:postStudentTest,
        testforms:testforms,
        deleteTest:deleteTest
    }   
}])