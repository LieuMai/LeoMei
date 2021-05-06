<?php 
	include_once 'dbmusic.inc.php';
?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Music is my life</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="style/music-layout.css" />
	<link rel="stylesheet" type="text/css" href="style/music-style.css" />
	<link rel="stylesheet" type="text/css" href="style/style.css">
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
				<!-- Xử lý Xóa bài viết -->
				<?php
					if (isset($_POST['delete'])) {			
						$id=$_POST['ma_bviet'];
						$title=$_POST['tieude'];
						$query="DELETE FROM Reviews WHERE ma_bviet=". $id .";";
						if($conn->query($query)){
							echo '<h3 id="message"></h3>';
						}
						else{
							echo "Query failed: " . $conn->error;
						} 			
					}
				?>

				<script>
					document.getElementById("message").innerHTML = "Xóa thành công bài viết <?php echo "$title" ?>";
				</script>

				<!-- Form lọc bài viết -->
				<h2>Tìm kiếm bài viết</h2>
				<form action="delete-form.php" method="POST">
					<input type="text" size="40" name="search_kw"
						value="<?php if (!empty($_POST['search_kw']))
							echo $_POST['search_kw'];?>"/>
					<input type="submit" value="Search review">
				</form>
				<br>

				<!-- Xử lý Tìm kiếm bài viết -->
				<?php
					if (isset($_POST['search_kw'])) {
						include 'process/delete-process.php';				
						search($_POST['search_kw']); 
					}
				?>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php
		include "components/footer.php";
	?>

</body>

</html>

