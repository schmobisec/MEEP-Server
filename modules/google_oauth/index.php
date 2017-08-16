<?php
session_start();
// https://www.sanwebe.com/2012/11/login-with-google-api-php
require_once ('libraries/Google/autoload.php');

// https://console.developers.google.com/ 에서 client ID and secret 생성
$client_id = '';
$client_secret = '';
$redirect_uri = ''; // 본인 도메인으로 수정하세요

//incase of logout request, just unset the session var
if (isset($_GET['logout'])) {
  unset($_SESSION['access_token']);
}

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client(); // 객체 생성
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
$service = new Google_Service_Oauth2($client);

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
*/

// 구글에서 redirect_uri 로 code 를 보내준다.
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}


//Display user info or display login url as per the info we have.
echo '<div style="margin:20px">';
if (isset($authUrl)){
	//show login url
	echo '<div align="center">';
	echo '<h2>Google OAuth 2.0 Login</h2>';
	echo '<div>Google 아이콘 누르세요.</div>';
	echo '<a class="login" href="' . $authUrl . '"><img src="modules/google_oauth/images/google-login-button.png" /></a>';
	echo '</div>';
} else {
	$user = $service->userinfo->get(); // google 사용자 정보 가져오기

	include_once 'connect.php';
	// DB 테이블에 구글 ID가 존재하는지 검사
	$sql ="SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user->id";
	$result = mysql_query($sql,$db);
	if(!empty($result)) {
		$row = mysql_fetch_array($result);
		$user_count = $row[0];
	}
	// 구글에서 제공하는 프로필 이미지 보여주기
	echo '<img src="'.$user->picture.'" style="float: right;margin-top: 33px;" />';

	if($user_count){ // 이미 가입자 정보가 있으면 세션정보 생성
        echo '환영합니다 '.$user->name.'님! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
    }
	else {
        echo $user->name.'님, 등록 감사합니다! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
		$id = $user->id;
		$name = $user->name;
		$email = $user->email;
		$query ="INSERT INTO google_users (google_id, google_name, google_email) VALUES ('$id','$name','$email')";
		mysql_query($query);
    }
}
echo '</div>';
?>
