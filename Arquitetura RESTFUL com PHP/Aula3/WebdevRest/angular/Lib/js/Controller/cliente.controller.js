angular.module('ExemploApp')
        .controller('ClienteListController', function ($scope, $http, $location) {
            $scope.clientes = [];

            $scope.init = function () {
                $scope.requestList();
            };

            $scope.remove = function (id) {
                if (confirm("Confirma a exclusão do Registro?"))
                    $scope.requestRemove(id);
            };

            $scope.edit = function (id) {
                $location.path("/Cliente/edit/" + (id));
            };

            $scope.requestList = function () {
                $http.get("../slim/aplicacao/cliente").
                        success(function (data) {
                            $scope.clientes = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };

            $scope.requestRemove = function (id) {
                $http.delete("../slim/aplicacao/cliente/" + id).
                        success(function (data) {
                            $scope.requestList();
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };
        })

        .controller('ClienteFormController', function ($scope, $http, $location, $routeParams) {

            $scope.cliente = {};

            $scope.init = function () {
                if ($routeParams.id)
                    $scope.requestEdit();
            };

            $scope.formValidate = function () {
                return $scope.form.$valid;
            };

            $scope.save = function () {
                $scope.submitted = true;
                if ($scope.formValidate())
                    $scope.requestSave();
            };

            $scope.requestSave = function () {
                if ($routeParams.id) {
                    $http.put("../slim/aplicacao/cliente/" + $routeParams.id, $scope.cliente).
                            success(function (data) {
                                $location.path("/Cliente/list");
                            }).
                            error(function (data, status) {
                                alert("Erro!");
                            });
                } else {
                    $http.post("../slim/aplicacao/cliente", $scope.cliente).
                            success(function (data) {
                                $location.path("/Cliente/list");
                            }).
                            error(function (data, status) {
                                alert("Erro!");
                            });
                }
            };

            $scope.requestEdit = function () {
                $http.get("../slim/aplicacao/cliente/" + $routeParams.id).
                        success(function (data) {
                            $scope.cliente = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };
        });

