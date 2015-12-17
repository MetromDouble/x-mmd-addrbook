var xmabServices = angular.module('xmabServices', []);

xmabServices.factory('contactSync', ['$http', function($http) {
  return {
    refresh: function (scope) {
      $http.post('sync.php').success(function(response) {
        scope.contacts = response;
      });
    },
    addContact: function (scope, data) {
      $http.post('sync.php', data).success(function(response) {
        scope.contacts = response;
      });
    },
    deleteContact: function (scope, data) {
      var tmp = {
        delete: true,
        id_user: data
      };
      $http.post('sync.php', tmp).success(function(response) {
        scope.contacts = response;
      });
    }
  };
}]);
