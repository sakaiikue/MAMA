<?php

$dsn = 'mysql:dbname=tt_363_99sv_coco_com;host=localhost';
$user = 'tt-363.99sv-coco';
$password = 'N8x9gPAR';
$pdo = new PDO($dsn,$user,$password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//スレッドを取得
$sql = "SELECT * FROM threads order by created_at desc";
$result = $pdo->query($sql);
?>


<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ホーム</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.html'; ?>
<p><a href="thread_new.php">スレッド作成</a></p>
<table>
<?php while($thread = $result->fetch()):?>
	<tr><td><a href="thread.php?id=<?php echo $thread['id'];?>"><?php echo $thread['title'];?></a></td><td><?php echo $thread['created_at'];?></td></tr>
<?php endwhile;?>
</table>
</body>
</html>