<?php 
	include_once 'dbmusic.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Music Review</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="wrapper">
		<h1>Tìm bài viết</h1>
		<hr>

		<form action="reviews-search.php" method="POST">
			<input type="text" size="40" name="search_kw"
				value="<?php if (!empty($_POST['search_kw']))
					echo $_POST['search_kw'];?>"/>
			<input type="submit" value="Search review">
		</form>

		<h3>Kết quả tìm kiếm</h3>

		<?php 
			if (isset($_POST['search_kw'])) {
				include 'search.php';
				search($_POST['search_kw']); 
			}
		?>



	</div>
</body>
</html>