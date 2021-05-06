<?php 
	include_once 'dbmusic.inc.php';
	include 'process/update-process.php';
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
	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="bg">
	<div class="container">

				<!-- Update Form -->
				<form id="update-form" method="POST">

			 	 	<div class="form-row">
			 	 		<label for="reviews">Chọn bài viết</label>

						<select name="reviews" id="reviews">
							<option value="">Chọn bài viết</option>
							<?php createSelect(); ?>
						</select>
			 	 	</div>
			 	 	
			 	 	<div id="responeContainer">
			 				
			 	 	</div>



					<div class="form-row" style="margin-left: 12.5em">
			 	 		<input type="submit" id="update" value="Cập nhật" style="width: 8em">
			 	 		<input type="reset" value="Hoàn tác" style="width: 8em">
			 	 	</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php
		include "components/footer.php";
	?>

	<script type="text/javascript">
		$(document).ready(function(){
			// Thêm tác giả mới á
			$(document).on('click', '#add-reviewer', function(e) {
				var id = $('#reviews').val();
				var name = $('#new-reviewer').val();
				$.ajax({
			    type: 'POST',
			    url: 'process/update-process.php',
			    data: {action : 'add-reviewer', id : id, name : name},
					dataType: "html",
		       success: function(data){
		       	$("#responeContainer").html(data);
			    }
				});
				e.preventDefault();
			});

			// Xem bài viết á
			$('#reviews').change( function(){
				var id = $('#reviews').val();
				$.ajax({
		       type: 'POST',
		       url: "process/update-process.php",
		       data: {action : 'display', id : id},
		       dataType: "html",
		       success: function(data){
		       	$("#responeContainer").html(data);
		       }
		    });
			});

			// Cập nhật bài viết á
			$(document).on('click', '#update', function(e) {
				var title = $('#title').val();
				var reviewer = $('#reviewer').val();
				var date = $('#date').val();
				var song = $('#song').val();
				var genre = $('#genre').val();
				var summary = $('#summary').val();
				var id = $('#reviews').val();
				$.ajax({
					url : 'process/update-process.php',
					type : 'POST',
					data : {action:'update' , id:id, title:title, reviewer:reviewer,
									date:date, song:song, genre:genre, summary:summary},
					success: function(data){
		       	$("#responeContainer").html(data);
					}
				});
				e.preventDefault();
			});
		});
	</script>

</body>

</html>
