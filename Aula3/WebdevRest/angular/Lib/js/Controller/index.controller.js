angular.module('ExemploApp').controller('IndexController', function ($scope, $http, $rootScope, $window) {
    $scope.init = function () {
        if ($window.sessionStorage.getItem(NAME_INDEX_STORAGE_TOKEN)) {
            $rootScope.loginRealizado = true;
        }
    };
});

