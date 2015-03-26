<?php     
    require_once './utilities/load_calendar.php';
    require_once './utilities/signup.php'
?>
<!DOCTYPE HTML>
<html ng-app="ScheduleIt">
<head>
    <title>ScheduleIt Home</title>
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/app.js"></script>
</head>
<body>
    <form name="SignUpStudent">
        <input id="cal" type="hidden" value="<?=$g_calid?>"/>
        <div ng-controller="ScheduleController as schedule">
            <div ng-repeat="event in schedule.segments">
                 Event ID: <strong>{{event.id}}</strong>
                <div ng-repeat="segment in event.segments | orderBy : '-start'" >
                    <input type="radio" name="timeslot_id" ng-attr-value="{{segment.start}}" />
                    {{segment.start*1000 | date : 'MMMM d h:mm a'}} &ndash; {{segment.end*1000 | date : 'h:mm a'}}
                </div>
                <br/><br/>
            </div>
        </div>
   
    Name: <input id="SignUpName" type="text" name="fullname" /><br/>
    Email: <input id="SignUpEmail" type="text" name="email" /><br/>
    <input id="SignUpSubmit" type="submit" value="Sign Up!" />
  </form>
</body>
</html>
