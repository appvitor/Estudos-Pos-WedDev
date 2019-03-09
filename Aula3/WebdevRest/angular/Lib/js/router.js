
angular.module('ExemploApp')

        .config(function ($routeProvider, $locationProvider) {
            $routeProvider

                    .when('/', {
                        templateUrl: 'View/Home.html'
                    })
                    .when('/Entrar', {
                        templateUrl: 'View/LoginForm.html',
                        controller: 'LoginController'
                    })
                    .when('/Sair', {
                        templateUrl: 'View/LoginForm.html',
                        controller: 'LoginController'
                    })

                    //==================================================================
                    //BANCO
                    .when('/Banco/list', {
                        templateUrl: 'View/BancoList.html',
                        controller: 'BancoListController'
                    })
                    .when('/Banco/create', {
                        templateUrl: 'View/BancoForm.html',
                        controller: 'BancoFormController'
                    })
                    .when('/Banco/edit/:id', {
                        templateUrl: 'View/BancoForm.html',
                        controller: 'BancoFormController'
                    })
                    
                    //==================================================================
                    //USUÁRIO
                    .when('/Usuario/list', {
                        templateUrl: 'View/UsuarioList.html',
                        controller: 'UsuarioListController'
                    })
                    .when('/Usuario/create', {
                        templateUrl: 'View/UsuarioForm.html',
                        controller: 'UsuarioFormController'
                    })
                    .when('/Usuario/edit/:id', {
                        templateUrl: 'View/UsuarioForm.html',
                        controller: 'UsuarioFormController'
                    })

                    //==================================================================
                    //CLIENTE
                    .when('/Cliente/list', {
                        templateUrl: 'View/ClienteList.html',
                        controller: 'ClienteListController'
                    })
                    .when('/Cliente/create', {
                        templateUrl: 'View/ClienteForm.html',
                        controller: 'ClienteFormController'
                    })
                    .when('/Cliente/edit/:id', {
                        templateUrl: 'View/ClienteForm.html',
                        controller: 'ClienteFormController'
                    })

                    //==================================================================
                    //AGÊNCIA
                    .when('/Agencia/list', {
                        templateUrl: 'View/AgenciaList.html',
                        controller: 'AgenciaListController'
                    })
                    .when('/Agencia/create', {
                        templateUrl: 'View/AgenciaForm.html',
                        controller: 'AgenciaFormController'
                    })
                    .when('/Agencia/edit/:id', {
                        templateUrl: 'View/AgenciaForm.html',
                        controller: 'AgenciaFormController'
                    })

                    //==================================================================
                    //CONTA
                    .when('/Conta/list', {
                        templateUrl: 'View/ContaList.html',
                        controller: 'ContaListController'
                    })
                    .when('/Conta/create', {
                        templateUrl: 'View/ContaForm.html',
                        controller: 'ContaFormController'
                    })
                    .when('/Conta/edit/:id', {
                        templateUrl: 'View/ContaForm.html',
                        controller: 'ContaFormController'
                    })

                    //==================================================================
                    //OPERAÇÕES
                    .when('/Operacao/:operacao/:id', {
                        templateUrl: 'View/ContaOperacaoForm.html',
                        controller: 'OperacaoFormController'
                    })




            // configure html5 to get links working on jsfiddle
            $locationProvider.html5Mode(false);
        });