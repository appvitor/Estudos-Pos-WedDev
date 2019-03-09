angular.module('ExemploApp')
        .controller('AgenciaListController', function ($scope, $http, $location) {
            $scope.agencias = [];

            $scope.init = function () {
                $scope.requestList();
            };

            $scope.remove = function (id) {
                if (confirm("Confirma a exclusão do Registro?"))
                    $scope.requestRemove(id);
            };

            $scope.edit = function (id) {
                $location.path("/Agencia/edit/" + (id));
            };

            $scope.requestList = function () {
                $http.get("../slim/exemplo5/agencia/").
                        success(function (data) {
                            $scope.agencias = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };

            $scope.requestRemove = function (id) {
                $http.delete("../slim/exemplo5/agencia/" + id).
                        success(function (data) {
                            $scope.requestList();
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };
        })

        .controller('AgenciaFormController', function ($scope, $http, $location, $routeParams) {

            $scope.agencia = {};
            $scope.bancos = [];

            $scope.init = function () {
                $scope.requestBancoList();
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

            $scope.requestBancoList = function () {
                $http.get("../slim/exemplo5/banco/").
                        success(function (data) {
                            $scope.bancos = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };

            $scope.requestSave = function () {

                if ($routeParams.id) {
                    $http.put("../slim/exemplo5/agencia/" + $routeParams.id, $scope.agencia).
                            success(function (data) {
                                $location.path("/Agencia/list");
                            }).
                            error(function (data, status) {
                                alert("Erro!");
                            });
                } else {
                    $http.post("../slim/exemplo5/agencia/", $scope.agencia).
                            success(function (data) {
                                $location.path("/Agencia/list");
                            }).
                            error(function (data, status) {
                                alert("Erro!");
                            });
                }
            };

            $scope.requestEdit = function () {
                $http.get("../slim/exemplo5/agencia/" + $routeParams.id).
                        success(function (data) {
                            $scope.agencia = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };
        });

