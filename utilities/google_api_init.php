<?php
     $prod = 1;
     $sp = $prod==0?"Senior-Project/":"";     
     
//Google Libraries
require_once $_SERVER['DOCUMENT_ROOT']."/{$sp}google-api-php-client/src/Google/Client.php";
require_once $_SERVER['DOCUMENT_ROOT']."/{$sp}google-api-php-client/src/Google/Service/Calendar.php";
require_once $_SERVER['DOCUMENT_ROOT']."/{$sp}utilities/google_event_manager.php";

const CLIENT_ID = '191668664245-h1t5dbipvmglh09mc27bo3ckdfjjojqk.apps.googleusercontent.com';
const SERVICE_ACCOUNT_NAME = '191668664245-h1t5dbipvmglh09mc27bo3ckdfjjojqk@developer.gserviceaccount.com';
define('CALID','55uc08fhn2j6fq9bcj3v9c44ps@group.calendar.google.com');
$KEY_FILE = $_SERVER['DOCUMENT_ROOT']."/{$sp}ScheduleIt-2b0035283339.p12";


//SERVICE SET UP
$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setApplicationName("ScheduleIt");
$client->setAccessType('offline');
$client->setRedirectUri('http://localhost/Senior-Project/');
$client->setScopes('https://www.googleapis.com/auth/calendar');

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

$key = file_get_contents($KEY_FILE);

if (isset($_SESSION['token'])){
    $client->setAccessToken($_SESSION['token']);
    //echo $_SESSION['token']; 
} else {
    $client->setAssertionCredentials(new Google_Auth_AssertionCredentials(
        SERVICE_ACCOUNT_NAME,
        array('https://www.googleapis.com/auth/calendar'),
        $key,
        'notasecret',
        'http://oauth.net/grant_type/jwt/1.0/bearer')
    );  
}

//EXECUTION
$service = new Google_Service_Calendar($client);
$calendarListEntry = $service->calendarList->get(CALID);
$events = $service->events->listEvents(CALID);  //This cannot be hardcoded

//Event Manager Set Up
$manager = new Google_Event_Manager($service);


?>