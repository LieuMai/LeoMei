<?php 
	include_once 'dbmusic.inc.php';
	include_once 'process/add-process.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" type="text/css" href="style/datepicker.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Jquery -->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
	<!-- Date picker -->
	<script>
	  $(function() {
	     $("#ngayviet").datepicker({dateFormat:'yy/mm/dd'});
	   });
  </script>
</head>
<body>

	<div class="wrapper">
		<h1>Thêm bài viết</h1>
	<hr>
		<!-- Add Review Form -->
 	 <form action="add-form.php" method="POST">
 	 	
 	 	<div class="form-row">
 	 		<label for="review_id">Mã bài viết</label> 		
 	 		<input type="text" size="40" name="review_id"
 	 		value="<?php get_review_id(); ?>">
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
</body>
</html>