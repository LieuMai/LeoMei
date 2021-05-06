<?php 
	include_once 'dbmusic.inc.php';
	include_once 'process/add-process.php';
?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Music is my life</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="style/music-layout.css" />
	<link rel="stylesheet" type="text/css" href="style/music-style.css" />
	<link rel="stylesheet" type="text/css" href="style/style.css" />
	<link rel="stylesheet" type="text/css" href="style/datepicker.css" />
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
				<h1>Thêm bài viết</h1>
				<hr>
					<!-- Add Review Form -->
			 	 <form action="add-form.php" method="POST">
			 	 	
			 	 	<div class="form-row">
			 	 		<label for="review_id">Mã bài viết</label> 		
			 	 		<input type="text" size="40" name="review_id"
			 	 		value="<?php get_review_id();?>">
			 	 	</div>
			 	 	
			 	 	<div class="form-row">
			 	 		<label for="title">Tiêu đề</label>
						<input type="text" name="title">
			 	 	</div>

			 	 	<div class="form-row">
			 	 		<label for="reviewer">Tác giả</label>
						<select name="reviewer">
							<?php
								createSelect(1);
							?>
						</select>
			 	 	</div>

			 	 	<div class="form-row">
			 	 		<label for="date">Ngày viết</label>
						<input type="text" name="date" id="ngayviet" 
						value="<?php echo date("Y/m/d"); ?>">
			 	 	</div>

			 	 	<div class="form-row">
			 	 		<label for="song">Bài hát</label>
						<input type="text" name="song">
			 	 	</div>

			 	 	<div class="form-row">
			 	 		<label for=" genre">Thể loại</label>
						<select name="genre"> 
							<?php
								createSelect(2);
							?>
					</select>
			 	 	</div>

			 	 	<div class="form-row">
			 	 		<label for="summary">Tóm tắt</label>
						<textarea type="text" name="summary"></textarea>
			 	 	</div>

			 	 	<div class="form-row">
			 	 		<input type="submit" name="submit" value="Thêm bài viết">
			 	 	</div>

					</form>

				<?php 
					if (!empty($_POST['title'])) {
						add_review();
					} else {
						displayReview();
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
