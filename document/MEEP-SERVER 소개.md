# 1. MEEP_SERVER 소개

MEEP-Server는 MEEP과 연결되는 서버에서 구동되는 back-end 어플리케이션입니다.  
MEEP-Server는 아래와 같은 기능을 수행합니다.

 - 구글 계정 연동
 - 사용자 인증서 발급(자체서명)
 - 사용자 인증서 관리
 - MEEP 연동

MEEP-Server는 리눅스 환경에서 구동할 수 있게 설계되었으며 테스트한 환경은 다음과 같습니다.

 - CentOS 7
 - apache 2.4.x
 - Mariadb 10.1.x
 - php 5.4.x
 - openssl 1.0.2

**※MEEP-Server가 안전하게 데이터를 처리하기 위해 ssl(https)로 구동해야 합니다!**