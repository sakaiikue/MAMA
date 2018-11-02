<?php
function db_connect(){
	$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';
try{
		$pdo = new PDO($dsn,$user,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;

			$sql="CREATE TABLE IF NOT EXISTS threads"
			."("
			."id int unsigned not null auto_increment ,"
			."title varchar(255) not null,"
			."body TEXT not null,"
			."created_at datetime not null,"
			."primary key (id)"
			.");"
			
			
			
			."CREATE TABLE IF NOT EXISTS responses"
			."("
			."id int unsigned not null auto_increment ,"
			."thread_id int not null,"
			."body TEXT not null,"
			."name varchar(64) not null,"
			."created_at datetime not null,"
			."password TEXT,"
			."primary key (id)"
			.");"
			
			."CREATE TABLE pre_member"
			."("
			."id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,"
			."urltoken VARCHAR(128) NOT NULL,"
			."mail VARCHAR(50) NOT NULL,"
			."date DATETIME NOT NULL,"
			."flag TINYINT(1) NOT NULL DEFAULT 0"
			.")"
			."ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;"
			
			."CREATE TABLE member"
			."("
			."id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,"
			."account VARCHAR(50) NOT NULL,"
			."mail VARCHAR(50) NOT NULL,"
			."password VARCHAR(128) NOT NULL,"
			."flag TINYINT(1) NOT NULL DEFAULT 1"
			.")"
			."ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;";
			
			
			$stmt = $pdo->query($sql);


	}catch (PDOException $e){
	    	print('Error:'.$e->getMessage());
	    	die();
	}
}




?>
