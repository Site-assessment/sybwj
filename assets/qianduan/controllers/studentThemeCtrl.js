AdministratorPlatform.controller('studentThemeCtrl', ['$http','$rootScope', '$scope', 'requestService', function ($http,$rootScope, $scope, requestService) {
       $rootScope.navShouldShow = false; 
    requestService.findListTest($scope);
    $scope.gettestid=function($index){
         requestService.form_id=$scope.tests[$index].form_id;
    };
}])