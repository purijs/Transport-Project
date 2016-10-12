<?php header('Access-Control-Allow-Origin: *'); ?>
<html ng-app="planner">
<head>
    <title>Public Transportation</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/master.css" type="text/css">
</head>
<body ng-controller="MainController" ng-cloak>
    <div class="container">
        <div class="row row-centered planner-block">
            <div class="col-md-12">
                <div class="col-md-6 col-centered form-area">
                    <div class="row row-centered">
						<div class="col-md-11 col-centered form-planner-inner" ng-show="fsVal">
					        <span class="form-text">Plan Your Journey</span>
					        <hr class="seperator"/>
					        <form name="signup" ng-submit="validate(userInfo);" onsubmit="return false;">
					            <div class="form-group">
                                    <select ng-change="onChangeF()" autofocus aria-label="Departure City" name="depCity" class="form-control" ng-model="userInfo.depCity" id="Destination City" ng-required="true">
                                        <option value="">--Choose Departure City--</option>
                                        <option ng-repeat="city in cities" value="{{ city }}">{{ city }}</option>
                                    </select>
                                </div>
					            <div class="form-group">
								    <select ng-change="onChangeT()" aria-label="Destination City" name="desCity" class="form-control" ng-model="userInfo.desCity" id="Destination City" ng-required="true">
                                        <option value="">--Choose Departure City--</option>
                                        <option ng-hide="userInfo.depCity=='{{ city1 }}'" ng-repeat="city1 in cities1" value="{{ city1 }}">{{ city1 }}</option>
                                    </select>
					            </div>
					            <div class="form-group">
					                <input aria-label="submit" type="submit" name="submit" value="Let's Plan Your Journey!" class="form-control btn btn-primary" ng-show="signup.$valid" id="su-submit"/>
					            </div>
					        </form>
					    </div>
					    <div class="col-md-11 col-centered form-planner-inner" ng-show="evVal">
					        <span class="form-text">Your Journey Details</span>
					        <hr class="seperator"/>
                            <p class="eventNew" align="center" ng-click="redo()"><u>Search Again</u></p>
                            <div ng-show="{{ offline }}">{{ status }}</div>
							<div ng-if="evVal == true" ng-init="callFocus()"></div>
                            <center>{{from}} - {{ toC }} list of trains</center>
                            <table class="eventActive">
                                <tr>
                                    <th>Name</th>
                                    <th>Dep. Time</th>
                                    <th>Arr. Time</th>
                                    <th>Travel Time</th>
                                </tr>
                                <tr ng-repeat="x in trains" ng-show="from=='{{ x.frCity }}' && toC=='{{ x.toCity }}'">
                                    <td>
                                        {{ x.Name }}
                                    </td>
                                    <td>
                                        {{ x.dep }}
                                    </td>
                                    <td>
                                        {{ x.arr }}
                                    </td>
                                    <td>
                                        {{ x.duration }}
                                    </td>
                                </tr>
                            </table>
					    </div>
                        <div class="col-md-11 col-centered form-planner-inner offVal" id="offVal">
                            <p>You're in offline mode :(</p>
                            <p>You can still continue your search :)</p>
                        </div>
						<div class="col-md-11 col-centered form-planner-inner" id="defVal">
							<p>
                                <b>Trains schedule for</b> &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" ng-model="curCity" value="Chandigarh" ng-change="onChangeD(curCity)"> Chandigarh&nbsp;
                                <input type="radio" ng-model="curCity" value="Delhi" ng-change="onChangeD(curCity)"> Delhi&nbsp;
                                <input type="radio" ng-model="curCity" value="Bombay" ng-change="onChangeD(curCity)"> Bombay
                            </p>
                            <table class="eventActive" ng-show="defSch">
                                <tr>
                                    <th>Name</th>
                                    <th>Dep. Time</th>
                                    <th>Arr. Time</th>
                                    <th>Travel Time</th>
                                </tr>
                                <tr ng-repeat="newx in trains" ng-show="current=='{{ newx.frCity }}'">
                                    <td>
                                        {{ newx.Name }}
                                    </td>
                                    <td>
                                        {{ newx.dep }}
                                    </td>
                                    <td>
                                        {{ newx.arr }}
                                    </td>
                                    <td>
                                        {{ newx.duration }}
                                    </td>
                                </tr>
                            </table>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
<script src="js/master.js"></script>
<script type="text/javascript">
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('./service-worker.js').then(function() {
    }, function() {
        console.log('CLIENT: service worker registration failure.');
    });
} else {
    console.log('CLIENT: service worker is not supported.');
}
</script>
</body>
</html>