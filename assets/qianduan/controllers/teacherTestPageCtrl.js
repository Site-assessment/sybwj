AdministratorPlatform.controller('teacherTestPage', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) { 
    requestService.findTest($scope) ;
}])