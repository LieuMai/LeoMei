<?php 
	include_once 'dbmusic.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="wrapper">
		<h3>Tìm kiếm bài viết</h3>
		
		<!-- Xử lý Xóa bài viết -->
		<?php
			if (isset($_POST['delete'])) {			
				$id=$_POST['ma_bviet'];
				$title=$_POST['tieude'];
				$query="DELETE FROM Reviews WHERE ma_bviet=". $id .";";
				if($conn->query($query)){
					echo '<p id="message"></p>';
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
	
</body>
</html>