<?php
include_once '../google_oauth/connect.php';

//인증서 검색
$sql = "SELECT google_crt_path FROM google_cert WHERE google_email='qwiny4962@gmail.com'";
$result = mysql_query($sql,$db);
if(!$result) {
 throw new Exception('Invalid DB query');
}

$row = mysql_fetch_array($result);

if($row <= 0) {
 throw new Exception('The certificate does not exist');
 echo  "<script>alert('인증서가 존재하지 않습니다.')</script>";
}

//인증서 파일 base64 인코딩
$data = file_get_contents('../../' . $row[google_crt_path]);

//인증서 파일 읽기 여부 확인
if($data !== false) {
 $base64 = 'data:application/octet-stream' . ';base64,' . base64_encode($data);
}
else {
 throw new Exception('Could not read certificate');
}

//json 파일 변환
$json = array("href" => $base64);
$json_output = json_encode($json);

echo urldecode($json_output);
?>
