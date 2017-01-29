angular.module('app.controllers')
    .controller('ProjectNewController', ['$scope', '$cookies', '$location', 'Project', 'Client',
        function ($scope, $cookies, $location, Project, Client) {
            $scope.project = new Project;

            $scope.status = [
                {value: 1, label: 'Não Inicializado'},
                {value: 2, label: 'Em progresso'},
                {value: 3, label: 'Finalizado'}
            ];
            $scope.clients = Client.query();

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.owner_id = $cookies.getObject('user').id;
                    var dateFormat = $scope.project.due_date.split('/');
                    $scope.project.due_date = dateFormat[2]+'-'+dateFormat[1]+'-'+dateFormat[0];
                    $scope.project.$save().then(function () {
                        $location.path('/projects');
                    });
                }
            }
        }]);
