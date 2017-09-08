# 2. MEEP-Server 파일/디렉토리 정보

MEEP-Server 파일과 디렉토리 정보는 아래와 같습니다.

| 파일/디렉토리명 | 파일/디렉토리 정보 |
| :------ | ------: |
| `├── document` |   `MEEP-Server 문서 디렉토리` |
| `├── index.php` | `MEEP-Server 메인 페이지` |
| `├── modules` | `MEEP-Server php 모듈` |
| `│   ├── certificate` | `사용자 인증서 생성/폐기 기능` |
| `│   ├── google_oauth` | `Google 소셜 로그인 기능` |
| `│   │   ├── connect.php` | `dbinfo.php를 이용한 DB 연결` |
| `│   │   ├── dbinfo.php` | `DB 접속 정보`  |
| `│   │   ├── images`
| `│   │   ├── index.php` | `Google 로그인 페이지`  |
| `│   │   ├── libraries` | `Google Oauth 라이브러리`  |
| `│   └── json` | `MEEP 인증서 연동 기능`  |
| `│       └── cert_json.php` | `쿼리 결과를 json 변환 후 MEEP로 보내는 기능`|
| `├── pki` | `인증서, 인증서 설정파일 보관 디렉토리` |
| `│   └── etc` |
| `│       ├── email-ca.conf` | `email-ca 인증서 설정파일`|
| `│       ├── email.conf` | `사용자 인증서 설정파일` |
| `│       └── root-ca.conf` | `root-ca 인증서 설정파일` |