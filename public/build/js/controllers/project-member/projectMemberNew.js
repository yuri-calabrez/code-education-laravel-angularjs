angular.module('app.controllers')
    .controller('ProjectMemberNewController', ['$scope', '$location', '$routeParams', 'ProjectMember', 'User',
        function ($scope, $location, $routeParams, ProjectMember, User) {
            $scope.projectMember = new ProjectMember;

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.projectMember.$save({id: $routeParams.id}).then(function () {
                        $location.path('/project/'+$routeParams.id+'/members');
                    });
                }
            };

            $scope.formatName = function (model) {
                if(model){
                    return model.name
                }
                return '';
            };

            $scope.getUsers = function (name) {
                return User.query({
                    search: name,
                    searchFields: 'name:like'
                }).$promise;
            };

            $scope.selectUser = function(item) {
                $scope.projectMember.member_id = item.id;
            };
        }]);
