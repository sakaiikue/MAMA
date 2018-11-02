<?php
$id = (isset($_GET['id']))? $_GET['id'] : null;
$type = (isset($_POST['type']))? $_POST['type'] : null;

if($type=='create') {
	$id = $_POST['id'];
	//DB接続
	$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn,$user,$password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//書き込み
	$stmt = $pdo->prepare("INSERT INTO responses (thread_id, name, body, created_at) VALUES (:thread_id, :name, :body, :created_at)");
	$stmt->bindParam(':thread_id', $id, PDO::PARAM_STR);
	$stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
	$stmt->bindParam(':body', $_POST['body'], PDO::PARAM_STR);
	$stmt->bindParam(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
	$stmt->execute();

	//スレッド画面に遷移
	header("Location: thread.php?id=" . $id);
}
?>


<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>レス投稿画面</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.html'; ?>
<form method="post" action="res_new.php">
<table>
	<tr>
		<th>名前</th>
		<td><input type="text" name="name" /></td>
	</tr>
	<tr>
		<th>内容</th>
		<td><textarea name="body"></textarea></td>
	</tr>
	<tr>
		<td>
			<input type="hidden" name="id" value="<?php echo $id;?>" />
			<input type="hidden" name="type" value="create" />
		</td>
		<td><input type="submit" name="submit" value="投稿" /></td>
	</tr>
</table>
</form>
</body>
</html>
