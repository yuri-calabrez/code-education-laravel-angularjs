angular.module('app.controllers')
    .controller('ClientShowController', ['$scope', '$routeParams', 'Client', function($scope, $routeParams, Client){
        $scope.client = Client.get({id: $routeParams.id});
    }]);