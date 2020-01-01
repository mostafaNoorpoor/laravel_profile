var app = angular.module('chatApp', ['firebase']);

app.controller('ChatController', function($scope, $firebaseArray) {
     var ref = firebase.database().ref("chat-8ca93").child('messages');
     $scope.messages = $firebaseArray(ref);

    $scope.send = function() {
        $scope.messages.$add({
            name:$scope.Name,
            message: $scope.messageText,
            date: Date.now()
        });
        $scope.Name = "";
        $scope.messageText = "";
    };

});
    