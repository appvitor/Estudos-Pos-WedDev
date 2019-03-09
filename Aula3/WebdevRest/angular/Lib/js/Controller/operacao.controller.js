angular.module('ExemploApp')

        .controller('OperacaoFormController', function ($scope, $http, $location, $routeParams) {

            $scope.operacao = {tipo: $routeParams.operacao, conta: {id: $routeParams.id}};
            $scope.contas = [];

            $scope.init = function () {
                $scope.requesContatList();
            };

            $scope.formValidate = function () {
                return $scope.form.$valid;
            };

            $scope.save = function () {
                $scope.submitted = true;
                if ($scope.formValidate())
                    $scope.requestSave();
            };

            $scope.requesContatList = function () {
                $http.get("../slim/exemplo5/conta/").
                        success(function (data) {
                            $scope.contas = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };

            $scope.requestSave = function () {
                $http.post("../slim/exemplo5/operacao/", $scope.operacao).
                        success(function (data) {
                            $location.path("/Conta/list");
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });

            };
        });

