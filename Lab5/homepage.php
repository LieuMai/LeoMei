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
	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
				<!-- Reviews List -->
				<?php
				$sql = "SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat, ten_hinh
								FROM Reviews r1
								LEFT JOIN Reviewer r2 ON r1.ma_tgia=r2.ma_tgia
								LEFT JOIN Genres g ON r1.ma_tloai=g.ma_tloai
								ORDER	BY ngayviet DESC 
								LIMIT	 5;";

				$result = $conn->query($sql);
					if ($result->num_rows > 0) 
					{
						while ($row = $result->fetch_assoc()) 
							{	
								echo '<div class="article">
									<h3><span class="date">'.	$row['ngayviet'] .'</span>&nbsp&nbsp'.	$row['tieude'] .'</h3>
									<div class="row">
										<p class="square"><img src="images/'.	$row['ten_hinh'] .'"/></p>
										<p class="summary">';
										summaryCut($row['tomtat'],160); 
								echo'</p>
									</div>
								</div>	
								<p class="spacer"></p>';
							}
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