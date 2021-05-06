<?php 
	include_once 'dbmusic.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pagination Search Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="wrapper">
		<h1>Tìm kiếm bài viết</h1>
		<hr>

		<form action="search-form.php" method="GET">
			<input type="text" size="40" name="search_kw"
				value="<?php empty($_REQUEST['search_kw']) ||
					print $_REQUEST['search_kw'];?>"/>
			<input type="submit" value="Tìm bài viết">
		</form>

		<br>
		<h3>Kết quả tìm kiếm</h3>

		<?php 
			if (isset($_REQUEST['search_kw'])) {
				include 'process/search-process.php';
				$paging = search($_REQUEST['search_kw']);
				echo "<br><hr>";
				page_nav_links($paging, $_REQUEST['search_kw']);
			}
		?>
	</div>
</body>
</html>