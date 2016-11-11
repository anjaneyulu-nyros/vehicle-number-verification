<!DOCTYPE html>
<html lang="en-US" ng-app='myApp' ng-controller="regctrl" ng-cloak>
<head>
<title ng-bind="title">Vehicle Verification</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
<script src="js/ui-bootstrap-tpls-0.14.2.min.js"></script>
<style type="text/css">
       form , .loading{
        width: 500px;
        height: auto;
        margin: 50px auto;
       }
       h2{
        text-align: center;
       }
  
       #reg{
        text-transform: uppercase;
       }
       .col-sm-8{
        color: red;
       }
    </style>
</head>
<body>
 <nav class="navbar navbar-inverse navbar-static-top"><div style="padding-top:10px;color:#fff;text-align:center;"> Vehicle Verification </div></nav>
    <div ng-show="loading" class="loading">Loading data, Please wait... <br><img src="loading.gif"> </div>
  <div ng-show="loading1">
 <form name='myform'>
  <br>
  		<div class='row'>
    <label class='col-sm-4'>Registration NO</label>
    <input type='text' class='col-sm-5 form-field' id='reg'name='reg' ng-model='reg' required placeholder='Enter registration no'>
      <span class='col-sm-3' style='color: red;'>{{response}}</span>
      </div>
      <span class='col-sm-4'></span>
       <span ng-show="myform.reg.$dirty && myform.reg.$error.required" class='col-sm-8'>Please Enter Registration no</span>
      <br>
      <div class='row'>
      	<span class='col-sm-4'></span>
  <button ng-click='getdata()' class='btn btn-primary'>Get Data</button>
  <button class='btn btn-danger' ng-click='cleardata()'>Cancle</button>
    </div></form>
  <form ng-show='reguser'>
    
  <h4 ng-if="data" >Vehicle Details:</h4>
 <table ng-if="data" class="table table-striped">

  <tr>
    <td>Registered Number</td>
    <td>{{data.regno ? data.regno : '-'}}</td>
  </tr>
  <tr>
    <td>Fuel Type</td>
    <td>{{data.fueltype ? data.fueltype : '-'}}</td>
  </tr>
  <tr>
    <td>Owner Name</td>
    <td>{{data.ownername ? data.ownername : '-'}}</td>
  </tr>
  <tr>
    <td>Vehicle Class </td>
    <td>{{data.vehicleclass ? data.vehicleclass : '-'}}</td>
  </tr>
  <tr>
    <td>Manfacturing Date</td>
    <td>{{data.mfgdate ? data.mfgdate : '-'}}</td>
  </tr>
  <tr>
    <td>Maker Class</td>
    <td>{{data.makerclass ? data.makerclass : '-'}}</td>
  </tr>
  <tr>
    <td>Adhar</td>
    <td>{{data.aadhaar ? data.aadhaar : '-'}}</td>
  </tr>

 </table>
 </form> </div>
 <nav class="navbar navbar-inverse navbar-fixed-bottom">
 <div style="padding-top:10px;color:#fff;text-align:center;"> &copy;All rights reserved to Nyros Technologies</div>
</nav>
<script type="text/javascript">

var app=angular.module('myApp',[]);
app.controller('regctrl', function ($scope, $http) {
 
     $scope.loading1 = true;
     $scope.response = '';
    $scope.getdata = function () {
      $scope.response = '';
    	if(angular.isDefined($scope.reg))
      {
       $scope.loading = true;
       $scope.loading1 = false;
    	       var request = $http({
                method: 'post',
                url:'getdata.php',
                data: {
                    
                    reg:$scope.reg
               
                },
                headers: { 'Content-Type': 'application/json' }
            });
    
            request.success(function (data) {
              $scope.loading = false;
              $scope.loading1 = true;
               if(data.regno){
                $scope.data=data;
                console.log($scope.data)
                $scope.reguser='true';
              }
              else{
                 $scope.response='No data found' ;   
              }
            });
       }
    }
    $scope.cleardata = function()
    {
      $scope.data= '';
      $scope.reg='';
      $scope.response = '';
    }
});
</script>
</body>
</html>