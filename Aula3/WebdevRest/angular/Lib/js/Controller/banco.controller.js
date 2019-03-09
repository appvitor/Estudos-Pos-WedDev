angular.module('ExemploApp')
        .controller('BancoListController', function ($scope, $http, $location) {
            $scope.bancos = [];

            $scope.init = function () {
                $scope.requestList();
            };

            $scope.remove = function (id) {
                if (confirm("Confirma a exclusão do Registro?"))
                    $scope.requestRemove(id);
            };

            $scope.edit = function (id) {
                $location.path("/Banco/edit/" + (id));
            };

            $scope.requestList = function () {
                $http.get("../slim/exemplo5/banco/").
                        success(function (data) {
                            $scope.bancos = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };

            $scope.requestRemove = function (id) {
                $http.delete("../slim/exemplo5/banco/" + id).
                        success(function (data) {
                            $scope.requestList();
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };
        })

        .controller('BancoFormController', function ($scope, $http, $location, $routeParams) {

            $scope.banco = {};

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
                    $http.put("../slim/exemplo5/banco/" + $routeParams.id, $scope.banco).
                            success(function (data) {
                                $location.path("/Banco/list");
                            }).
                            error(function (data, status) {
                                alert("Erro!");
                            });
                } else {
                    $http.post("../slim/exemplo5/banco/", $scope.banco).
                            success(function (data) {
                                $location.path("/Banco/list");
                            }).
                            error(function (data, status) {
                                alert("Erro!");
                            });
                }
            };

            $scope.requestEdit = function () {
                $http.get("../slim/exemplo5/banco/" + $routeParams.id).
                        success(function (data) {
                            $scope.banco = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };
        });

