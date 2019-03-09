angular.module('ExemploApp')
        .controller('ContaListController', function ($scope, $http, $location) {
            $scope.contas = [];

            $scope.init = function () {
                $scope.requestList();
            };

            $scope.remove = function (id) {
                if (confirm("Confirma a exclusão do Registro?"))
                    $scope.requestRemove(id);
            };

            $scope.edit = function (id) {
                $location.path("/Conta/edit/" + (id));
            };

            $scope.requestList = function () {
                $http.get("../slim/exemplo5/conta/").
                        success(function (data) {
                            $scope.contas = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };

            $scope.requestRemove = function (id) {
                $http.delete("../slim/exemplo5/conta/" + id).
                        success(function (data) {
                            $scope.requestList();
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };
        })

        .controller('ContaFormController', function ($scope, $http, $location, $routeParams) {

            $scope.conta = {};
            $scope.agencias = [];
            $scope.clientes = [];

            $scope.init = function () {
                $scope.requestClienteList();
                $scope.requestAgenciaList();

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

            $scope.requestClienteList = function () {
                $http.get("../slim/exemplo5/cliente/").
                        success(function (data) {
                            $scope.clientes = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };

            $scope.requestAgenciaList = function () {
                $http.get("../slim/exemplo5/agencia/").
                        success(function (data) {
                            $scope.agencias = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };

            $scope.requestSave = function () {

                if ($routeParams.id) {
                    $http.put("../slim/exemplo5/conta/" + $routeParams.id, $scope.conta).
                            success(function (data) {
                                $location.path("/Conta/list");
                            }).
                            error(function (data, status) {
                                alert("Erro!");
                            });
                } else {
                    $http.post("../slim/exemplo5/conta/", $scope.conta).
                            success(function (data) {
                                $location.path("/Conta/list");
                            }).
                            error(function (data, status) {
                                alert("Erro!");
                            });
                }
            };

            $scope.requestEdit = function () {
                $http.get("../slim/exemplo5/conta/" + $routeParams.id).
                        success(function (data) {
                            $scope.conta = data;
                            //problema com função de conversão do PHP que retorna string
                            $scope.conta.limite = parseFloat($scope.conta.limite); 
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };
        });

