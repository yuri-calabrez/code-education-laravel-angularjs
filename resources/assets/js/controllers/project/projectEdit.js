angular.module('app.controllers')
    .controller('ProjectEditController', ['$scope', '$cookies', '$routeParams', '$location', 'Project', 'Client',
        function ($scope, $cookies, $routeParams, $location, Project, Client) {
            $scope.project = Project.get({id: $routeParams.id});

            $scope.status = [
                {value: 1, label: 'Não Inicializado'},
                {value: 2, label: 'Em progresso'},
                {value: 3, label: 'Finalizado'}
            ];
            $scope.clients = Client.query();

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.owner_id = $cookies.getObject('user').id;
                    Project.update({id: $scope.project.project_id}, $scope.project, function () {
                        $location.path('/projects');
                    });
                }
            }
        }]);
