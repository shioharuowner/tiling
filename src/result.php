<?php
$items = isset($_POST['items']) ? $_POST['items'] : '';

if($items === ''){
	header('Location: http://shioharu.minibird.jp/tiling/index.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="result.css">
		<title>画像タイル化(結果画面)</title>
	</head>
	<body>
		<article>
			<div class="flexbox">
				<?php
					foreach($items as $key => $value) { 
						echo'<div class="item"><img src="' . $value['link'] .'" /></div>';
					}
				?>
			</div>
			<a href="/tiling/index.php">戻る</a>
		</article>
	</body>
</html>