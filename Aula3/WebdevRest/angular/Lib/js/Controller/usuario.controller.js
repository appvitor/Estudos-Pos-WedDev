angular.module('ExemploApp')
        .controller('UsuarioListController', function ($scope, $http, $location) {
            $scope.usuarios = [];

            $scope.init = function () {
                $scope.requestList();
            };

            $scope.remove = function (id) {
                if (confirm("Confirma a exclusão do Registro?"))
                    $scope.requestRemove(id);
            };

            $scope.edit = function (id) {
                $location.path("/Usuario/edit/" + (id));
            };

            $scope.requestList = function () {
                $http.get("../slim/aplicacao/usuario").
                        success(function (data) {
                            $scope.usuarios = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };

            $scope.requestRemove = function (id) {
                $http.delete("../slim/aplicacao/usuario/" + id).
                        success(function (data) {
                            $scope.requestList();
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };
        })

        .controller('UsuarioFormController', function ($scope, $http, $location, $routeParams) {

            $scope.usuario = {};
            $scope.permissoes = [];

            $scope.init = function () {
                if ($routeParams.id)
                    $scope.requestEdit();
                
                $scope.requestListPermissao();
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
                    $http.put("../slim/aplicacao/usuario/" + $routeParams.id, $scope.usuario).
                            success(function (data) {
                                $location.path("/Usuario/list");
                            }).
                            error(function (data, status) {
                                alert("Erro!");
                            });
                } else {
                    $http.post("../slim/aplicacao/usuario", $scope.usuario).
                            success(function (data) {
                                $location.path("/Usuario/list");
                            }).
                            error(function (data, status) {
                                alert("Erro!");
                            });
                }
            };

            $scope.requestEdit = function () {
                $http.get("../slim/aplicacao/usuario/" + $routeParams.id).
                        success(function (data) {
                            $scope.usuario = data;
                            $scope.usuario.senha = "";
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };

            $scope.requestListPermissao = function () {
                $http.get("../slim/aplicacao/permissao").
                        success(function (data) {
                            $scope.permissoes = data;
                        }).
                        error(function (data, status) {
                            alert("Erro!");
                        });
            };

        });

