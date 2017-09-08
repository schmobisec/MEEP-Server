# 3. MEEP-Server 초기 설정
MEEP-Server 초기 설정은 아래와 같이 설정해야 합니다.  
* DB 생성
* 자체 서명된 root-ca, email-ca 인증서 생성
* php-db 연동
* google oauth 연동

## 3.1. DB 생성
Mariadb에 접속하셔서 아래와 같이 쿼리를 실행하십시오.

~~~
CREATE DATABASE meep CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `meep`.`google_users` (
	`google_id` DECIMAL(21, 0) NOT NULL, 
	`google_name` VARCHAR(60) NOT NULL, 
	`google_email` VARCHAR(60) NOT NULL, 
	PRIMARY KEY (`google_email`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `meep`.`google_cert` (
	`google_sequence` BIGINT NOT NULL AUTO_INCREMENT, 
	`google_email` VARCHAR(60) NOT NULL, 
	`google_crt_path` VARCHAR(250) NOT NULL, 
	`google_p12_path` VARCHAR(250) NOT NULL, 
	`google_start_date` DATE NOT NULL, 
	`google_expire_date` DATE NOT NULL, 
	PRIMARY KEY (`google_sequence`),
	FOREIGN KEY (`google_email`) REFERENCES `meep`.`google_users` (`google_email`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
~~~