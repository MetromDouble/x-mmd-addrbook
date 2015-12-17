define([], function () {

var xmabControllers = angular.module('xmabControllers', []);

xmabControllers.controller('PhoneListCtrl', ['$scope', '$http',
  function ($scope, $http) {
    $http.get('people.json').success(function(data) {
      $scope.contacts = data;
    });
    $scope.orderProp = 'name';
  }]);

});
