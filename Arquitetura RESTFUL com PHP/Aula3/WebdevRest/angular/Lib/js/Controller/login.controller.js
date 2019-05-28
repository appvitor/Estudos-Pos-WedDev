angular.module('ExemploApp')
        .controller('LoginController', function ($scope, $http, $location, $rootScope, $window) {

            $scope.init = function () {
                $rootScope.loginRealizado = false;
                $window.sessionStorage.setItem(NAME_INDEX_STORAGE_TOKEN, "");
            };

            $scope.login = function () {
                $scope.submitted = true;

                if (!$scope.formValidate())
                    return;

                $scope.requestLogin();
            };

            $scope.formValidate = function () {
                return $scope.form.$valid;
            };

            $scope.requestLogin = function () {

                $http.post("../slim/aplicacao/login", $scope.usuario).
                        success(function (data) {
                            $window.sessionStorage.setItem(NAME_INDEX_STORAGE_TOKEN, data.token);
                            $location.path("/");
                            $rootScope.loginRealizado = true;
                        }).
                        error(function (data, status) {
                            alert("Atenção: Usuário ou senha inválido!");
                        });

            };

        });

