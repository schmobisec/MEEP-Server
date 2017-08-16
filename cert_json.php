<?php
include_once '../google/connect.php';

//인증서 검색
$sql = "SELECT google_der_path FROM google_cert WHERE google_email='qwiny4962@gmail.com'";
$result = mysql_query($sql,$db);
if(!$result) {
 throw new Exception('유효하지 않는 쿼리입니다.');
}

$row = mysql_fetch_array($result);

if($row <= 0) {
 throw new Exception('인증서가 존재하지 않습니다.');
 echo  "<script>alert('인증서가 존재하지 않습니다.')</script>";
}

//인증서 파일 base64 인코딩
$data = file_get_contents('../' . $row[google_der_path]);

//인증서 파일 읽기 여부 확인
if($data !== false) {
 $base64 = 'data:application/octet-stream' . ';base64,' . base64_encode($data);
}
else {
 throw new Exception('인증서를 읽지 못했습니다.');
}

//json 파일 변환
$json = array("href" => $base64);
$json_output = json_encode($json);

echo urldecode($json_output);
?>
