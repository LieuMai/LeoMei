<?php 
	include_once 'dbmusic.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Danh sách bài viết</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="wrapper">
		<h1>Danh sách bài viết</h1>
	<hr>
  	<?php

		$sql = "SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat
			FROM Reviews r1
			left join Reviewer r2 on r1.ma_tgia=r2.ma_tgia
			left join Genres g on r1.ma_tloai=g.ma_tloai;";

		$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				while ($row = $result->fetch_row()) 
				{
					echo '<div class ="review row">
						<div class="left col-3">
							<p>
								Mã bài viết<br>
								Tiêu đề<br>
								Tác giả<br>
								Ngày viết<br>
								Bài hát<br>
								Thể loại<br>
								Tóm tắt<br>
							</p>
						</div>
						<div class="right col-7">'
								.	$row["0"] . '<br>'
								.	$row["1"] . '<br>'
								.	$row["2"] . '<br>'
								.	$row["3"] . '<br>'
								.	$row["4"] . '<br>'
								.	$row["5"] . '<br>'
								.	mb_substr($row["6"], 0, 50, "UTF-8") . '...<br>
						</div>
					</div><hr>';
				}
			} 
			else {
				echo "Khong tim thay thong tin bai viet!!";
			}
	?>
	</div>
</body>
</html>