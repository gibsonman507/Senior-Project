<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
require_once '../../google-api-php-client/src/Google/Client.php';
require_once '../../google-api-php-client/src/Google/Service/Plus.php';
session_start();
unset($_SESSION);
$client = new Google_Client();
$client->setAccessType('online'); // default: offline
$client->setApplicationName('ScheduleIt');
$client->setClientId('191668664245-k6apjlo3hojik7rphq9aet58hiu4pc26.apps.googleusercontent.com');
$client->setClientSecret('t86-1-Msaw9C7wuPKZ-dvLYK');
$client->setRedirectUri('http://scheduleit.cs.unh.edu:8080/rbartos/98d1g5fg84nfg85dlk48fm92/');
$client->setDeveloperKey('AIzaSyDzsF1TFKgiX1YVx7oBdmorGrkwIiFah88'); // API key
$client->setScopes('https://www.googleapis.com/auth/calendar'); 
$plus = new Google_Service_Plus($client);
    echo "something1";
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}
if (isset($_REQUEST['code'])) {
  $client->authenticate($_REQUEST['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
    echo "something2";
  header('Location: http://scheduleit.cs.unh.edu:8080/rbartos/98d1g5fg84nfg85dlk48fm92/');
}
if (isset($_SESSION['access_token'])) {
  $client->setAccessToken($_SESSION['access_token']);
    echo "something3";
}
if ($client->getAccessToken()) {
    echo "something4";
 
  // The access token may have been updated lazily.
  $_SESSION['access_token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
}
?>
<!doctype html>
<html>
<head><link rel='stylesheet' href='style.css' /></head>
<body>
<div class="box">

</div>
</body>
</html>