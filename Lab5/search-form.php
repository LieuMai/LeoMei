<?php 
	include_once 'dbmusic.inc.php';
	include 'process/search-process.php';
?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Music is my life</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="style/music-layout.css" />
	<link rel="stylesheet" type="text/css" href="style/music-style.css" />
	<!-- Bootstrap -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	<!-- Others Function -->
</head>

<body class="bg">
	<div class="container">
		<?php
			require "components/header.php";
			require "components/bar.php";
		?>
		<div class="main-content">
			<?php
			require "components/menu.php";
			?>
			<div id="showform">
				<!-- Search Form -->
				<div class="search-form">
				<br>	
				<h1>Tìm kiếm bài viết</h1>

					<form action="search-form.php" method="GET">
						<input type="text" size="40" name="search_kw"
							value="<?php empty($_REQUEST['search_kw']) || print $_REQUEST['search_kw'];?>"/>
						<input type="submit" value="Tìm bài viết">
					</form>
					<br>
					<?php 
						if (isset($_REQUEST['search_kw'])) {
							$paging = search($_REQUEST['search_kw']);
							echo "<br><hr><br>";
							page_nav_links($paging, $_REQUEST['search_kw']);
						}
					?>
					<br><br>			
				</div>
			</div>			
		</div>
	</div>

	<!-- Footer -->
	<?php
		include "components/footer.php";
	?>

</body>

</html>
