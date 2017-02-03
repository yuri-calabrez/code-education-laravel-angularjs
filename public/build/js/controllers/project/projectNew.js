angular.module('app.controllers')
    .controller('ProjectNewController', ['$scope', '$cookies', '$location', 'Project', 'Client', 'appConfig',
        function ($scope, $cookies, $location, Project, Client, appConfig) {
            $scope.project = new Project;

            $scope.status = appConfig.project.status;
            $scope.clients = Client.query();

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.owner_id = $cookies.getObject('user').id;
                    $scope.project.$save().then(function () {
                        $location.path('/projects');
                    });
                }
            }
        }]);
