<?php
//DB接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//スレッドIDを取得
$id = $_GET['id'];

//スレッドを取得
$sql_thread = "SELECT * FROM threads where id = " . $id;
$result_thread = $pdo->query($sql_thread);
$thread = $result_thread->fetch();

//レスを取得
$sql_res = "SELECT * FROM responses where thread_id = " . $id . " order by created_at desc";
$result_res = $pdo->query($sql_res);
?>


<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $thread['title'];?></title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.html'; ?>
<p>作成日時:<?php echo $thread['created_at'];?></p>
<p>タイトル:<?php echo $thread['title'];?></p>
<p><?php echo $thread['body'];?></p>

<p><a href="res_new_seikatsu.php?id=<?php echo $id;?>">書き込み</a></p>

<?php while($res = $result_res->fetch()):?>
	<hr />
	<p>名前:<?php echo $res['name'];?>
	      投稿日時:<?php echo $res['created_at'];?></p>
	<p><?php echo $res['body'];?></p>
<?php endwhile;?>
</body>
</html>

