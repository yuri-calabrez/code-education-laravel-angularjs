angular.module('app.controllers')
    .controller('ProjectMemberListController', ['$scope', '$routeParams', 'ProjectMember',
        function ($scope, $routeParams, ProjectMember) {
            //$scope.projectMember = ProjectMember.get({id: $routeParams.id});
            $scope.project_id = $routeParams.id;
            $scope.loadMember = function () {
                $scope.projectMembers = ProjectMember.query({
                    id: $routeParams.id,
                    orderBy: 'id',
                    sortedBy: 'desc'
                });
            };

            $scope.loadMember();
        }]);
