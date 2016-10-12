/**
 * Created by JaskaranSingh on 27-09-2016.
 */
var app=angular.module("planner",[]);
app.controller("MainController",function ($scope,$http) {
    $scope.fsVal=true;
    $scope.evVal=false;
    $scope.offline=false
    $scope.cities=["Chandigarh","Bombay","Delhi"]
    $scope.cities1=["Noida","Chandigarh","Bombay","Delhi"]
    $scope.citiesD=["Chandigarh","Bombay","Delhi"]
    $scope.defSch=false;
    $scope.onChangeF = function()
    {
        $scope.from=$scope.userInfo.depCity
    }
    $scope.onChangeD = function()
    {
        $scope.current=$scope.curCity
        $scope.defSch=true;
    }
    $scope.onChangeT = function()
    {
        $scope.toC=$scope.userInfo.desCity
    }
    $scope.validate=function(userInfo){
        if($scope.signup.$valid) {
            $scope.fsVal=false;
            $scope.evVal=true
            angular.element(document.querySelector("#defVal")).addClass("offVal");
        }
        else {
            $scope.fsVal=true;
            $scope.evVal=false
        }
    };
    $scope.redo=function () {
        $scope.fsVal=true
        $scope.evVal=false
    }
    $http.get("http://campusmillstore.com/ud_test/schedule.php").then(function(response) {
        $scope.trains = response.data.records;
    },function(response){
        $http.get("./trains.php").then(function(response) {
            $scope.trains = response.data.records;
        });
        angular.element(document.querySelector("#offVal")).removeClass("offVal");
    });
});