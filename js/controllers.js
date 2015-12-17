define([], function () {

var xmabControllers = angular.module('xmabControllers', []);

xmabControllers.controller('PhoneListCtrl', ['$scope','$rootScope', '$http',
  function ($scope, $rootScope, $http) {
    $http.get('people.json').success(function(data) {
      $scope.contacts = data;
    });
    $rootScope.orderProp = 'name';
  }]);

});
