AdministratorPlatform.controller('studentHistoryCtrl', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) { 
	console.log("a");
   $rootScope.navShouldShow = false; 
    requestService.findListTest($scope);
    $scope.gettestid=function($index){
         requestService.form_id=$scope.tests[$index].form_id;
    };
	}])