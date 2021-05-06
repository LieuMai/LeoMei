<?php
	// Hàm tìm kiếm bài viết theo từ khóa
	function search($word) {
		// Submit khi không có từ khóa thì hiển thị tất cả bài viết
		if ($word == '') {
			echo "<h3>Danh sách bài viết</h3>";
			$query = "SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat, ten_hinh
							FROM Reviews r1
							left join Reviewer r2 on r1.ma_tgia=r2.ma_tgia
							left join Genres g on r1.ma_tloai=g.ma_tloai;";
		}

		// Submit với từ khóa thì sẽ tìm kiếm và hiển thị bài viết
		else {
			$word = trim($word);
			$word = preg_replace('/\s+/', ' ', $word);
			$keywords = explode(" ", $word); // create array of keywords

			// here we build the string to require all keywords
			$keywds_str = "+" . implode(" +", $keywords);

			$query = "SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat, ten_hinh
								FROM Reviews r1
								LEFT JOIN Reviewer r2 ON r1.ma_tgia=r2.ma_tgia
								LEFT JOIN Genres g ON r1.ma_tloai=g.ma_tloai
								WHERE MATCH (tieude,ten_bhat) AGAINST ('".$keywds_str."' IN BOOLEAN MODE)";
		} 		
		
		// Hiển thị các bài viết		
		displayReview($query);	
	}

	// Hàm hiển thị bài viết theo query
	function displayReview($query) {
		require "dbmusic.inc.php";

		$result = $conn->query($query)
			or die ("Query failed: " . $conn->error);

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) 
				{
					echo 
					'<form action="delete-form.php" method="POST">
						<div class="article">
							<h3><span class="date">'.	$row['ngayviet'] .'</span>&nbsp&nbsp'.	$row['tieude'] .'</h3>
							<div class="row">
								<p class="square"><img src="images/'.	$row['ten_hinh'] .'"/></p>
								<p class="summary">';
						summaryCut($row['tomtat'],160); 
						echo'</p>
							</div>
						</div>	

						<p class="spacer"></p>
					
						<input type="submit" class="row" value="Xóa bài viết" name="delete" onclick="return ask_confirm();">
						<input type="hidden" value="'. $row['ma_bviet'] .'" name="ma_bviet">
						<input type="hidden" value="'. $row['tieude'] .'" name="tieude">
					</form>';
				}
		}
		else {
			echo "Không tìm thấy bài viết";
		}
	}

	function summaryCut($tomtat,$num_words) {
		$line = $tomtat;
		$line= mb_substr($line, 0, $num_words);
		if (preg_match('/^.{1,260}\b/su', $line, $match) && strlen($line) >= $num_words)
		{
		    $line=$match[0].'…';
		}
		echo $line;
	}
?>

<script type="text/javascript">
	function ask_confirm() {
		let result = confirm('Bạn có chắc muốn xóa bài viết?');
		return result;
	}
</script>