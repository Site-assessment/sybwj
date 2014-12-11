/**
 * created by Harbon
 * date :2014-10-26
 */

AdministratorPlatform.config(['$routeProvider','$locationProvider', function ($routeProvider, $locationProvider) {
//    $locationProvider.html5Mode(true);
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });
   $routeProvider.when('/', {
        templateUrl:'/pages/login.html',
        controller:'loginCtrl'
    }).when('/login', {
        templateUrl:'/pages/login.html',
        controller:'loginCtrl'
    }).when('/teacher', {
        templateUrl:'/pages/teacher.html'
    }).when('/teachergivetest', {
        templateUrl:'/pages/teachergivetest.html',
        controller:'inputDataCtrl'
    }).when('/teacherlist', {
        templateUrl:'/pages/teacherlist.html',
        controller:'LoadDataCtrl2'
    }).when('/teacherscore', {
        templateUrl:'/pages/teacherscore.html',
        controller:'LoadDataCtrl3'
    }).when('/teachertestpage', {
        templateUrl:'/pages/teachertestpage.html',
        controller:'LoadDataCtrl4'
    }).when('/teacheredittest', {
        templateUrl:'/pages/teacheredittest.html',
        controller:'loadDataCtrl5'
    }).when('/student', {
        templateUrl:'/pages/student.html'
    }).when('/studentlooktheme', {
        templateUrl:'/pages/sutdentlooktheme.html',
        controller:'LoadStudentCtrl'
    }).when('/studenttest', {
        templateUrl:'/pages/studenttest.html',
        controller:'LoadStudentCtrl2'
    }).when('/studentlookscore', {
        templateUrl:'/pages/studentlookscroe.html',
        controller:'LoadStudentCtrl2'  
     }).when('/studentlookhistory', {
        templateUrl:'/pages/studentlookhistory.html',
        controller:'LoadStudentCtrl3'  
    }).when('e.json', {
        templateUrl:'e.json',
        controller:''
        }).when('q.json', {
        templateUrl:'q.json',
        controller:''
        }).when('w.json', {
        templateUrl:'w.json',
        controller:''
    }).otherwise({
        redirectTo:'/'
    })
}])