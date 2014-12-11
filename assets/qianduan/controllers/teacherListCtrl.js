AdministratorPlatform.controller('teacherListCtrl', ['$rootScope', '$scope', 'requestService', function ($rootScope, $scope, requestService) {
    $rootScope.paginationShouldShow = true;
    requestService.findListTest($scope);
}])