
var AppName = angular.module('ExemploApp', ['ngRoute']);

var NAME_INDEX_STORAGE_TOKEN = "token";

AppName.factory('AuthInterceptor', function ($window, $q, $location, $rootScope) {
    return {
        request: function (config) {
            config.headers = config.headers || {};
            if ($window.sessionStorage.getItem(NAME_INDEX_STORAGE_TOKEN)) {
                config.headers.token = $window.sessionStorage.getItem(NAME_INDEX_STORAGE_TOKEN);
            }
            return config || $q.when(config);
        },
        response: function (response) {
            return response || $q.when(response);
        },
        responseError: function (rejection) {
            if (rejection.status === 403) {
                $location.path("/Entrar");
                $rootScope.loginRealizado = false;
            }
            return $q.reject(rejection);
        }
    };
});

AppName.config(function ($httpProvider) {
    $httpProvider.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8";
    $httpProvider.defaults.withCredentials = true;
    $httpProvider.interceptors.push('AuthInterceptor');
});