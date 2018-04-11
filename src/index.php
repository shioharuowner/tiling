<?php
$message = '';
$api_url = 'https://www.googleapis.com/customsearch/v1';
$params = array('key'        => '************',
				'cx'         => '************',
				'searchType' => 'image',
				'q'          => $q = isset($_POST['q']) ? $_POST['q'] : '',
				);

if($q !== ''){
	$json = file_get_contents($api_url . '?' . http_build_query($params));
	$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
	$arr = json_decode($json,true);
	if(isset($arr['searchInformation']['totalResults']) && (int)$arr['searchInformation']['totalResults'] > 0){
		send_items($arr['items']);
	}else{
		$message = '検索結果が0件、もしくは1日の検索回数上限です。';
	};
}

function send_items($items){
$url = 'http://shioharu.minibird.jp/tiling/result.php';

$data = array('items' => $items,);
$data = http_build_query($data);

$options = array('http' => array('method'  => 'POST',
								 'content' => $data,
				));

$options = stream_context_create($options);
$contents = file_get_contents($url, false, $options);
echo $contents;
exit;
}

?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="result.css">
		<title>画像タイル化</title>
	</head>
	<body>
		<article>
			<h1>画像タイル化</h1>
			<section>
				<form action="index.php" method="POST">
					<p>検索ワードを入力してください。</p>
					<input type="text" name="q" size="30" value="<?php echo $q; ?>" />
					<input type="submit" value="検索" />
					<p><font color="red"><?php if($message !== '') { echo $message; } ?></font></p>
				</form>
			</section>
		</article>
	</body>
</html>