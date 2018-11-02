
<?php
$type = (isset($_POST['type']))? $_POST['type'] : null;

if($type=='create') {
	//DB接続
	$dsn = 'mysql:dbname=tt_363_99sv_coco_com;host=localhost';
	$user = 'tt-363.99sv-coco';
	$password = 'N8x9gPAR';
	$pdo = new PDO($dsn,$user,$password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	//書き込み
     $stmt = $pdo->prepare("INSERT INTO threads (title, body, created_at) VALUES (:title, :body, :created_at)");
	 $stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
	 $stmt->bindParam(':body', $_POST['body'], PDO::PARAM_STR);
	 $stmt->bindParam(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
	 $stmt->execute();
		
	//スレッド画面に遷移
 	header("Location: index2.php"); 
}
?>


<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>スレッド作成画面</title>
     <link rel="stylesheet" href="css/reset.css">
     <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.html'; ?>
<form method="post" action="thread_new.php">
<table>
	<tr>
		<th>タイトル</th>
		<td><input type="text" name="title" /></td>
	</tr>
	<tr>
		<th>内容</th>
		<td><textarea name="body"></textarea></td>
	</tr>
	<tr>
		<td><input type="hidden" name="type" value="create" /></td>
		<td><input type="submit" name="submit" value="作成" /></td>
	</tr>
</table>
</form>
</body>
</html>

