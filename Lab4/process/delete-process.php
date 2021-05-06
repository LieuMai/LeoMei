<?php
	// Hàm tìm kiếm bài viết theo từ khóa
	function search($word) {
		
		// Submit khi không có từ khóa thì hiển thị tất cả bài viết
		if ($word == '') {
			echo "<h3>Danh sách bài viết</h3>";
			$query = "SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat
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

			$query = "SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat
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
						<div class="review row">
							<p class="left col-3">
								Mã bài viết<br>
								Tiêu đề<br>
								Tác giả<br>
								Ngày viết<br>
								Bài hát<br>
								Thể loại<br>
								Tóm tắt<br>
							</p>
						
							<div class="right col-7">'
									.	$row['ma_bviet'] . '<br>'
									.	$row['tieude'] . '<br>'
									.	$row['ten_tgia'] . '<br>'
									.	$row['ngayviet'] . '<br>'
									.	$row['ten_bhat'] . '<br>'
									.	$row['ten_tloai'] . '<br>'
									.	mb_substr($row['tomtat'], 0, 50, "UTF-8") . '...<br>
							</div>
						</div>
						<input type="submit" class="row" value="Xóa bài viết" name="delete" onclick="return ask_confirm();">
						<input type="hidden" value="'. $row['ma_bviet'] .'" name="ma_bviet">
						<input type="hidden" value="'. $row['tieude'] .'" name="tieude">
						</form>
					<hr>';
				}
		}
		else {
			echo "Không tìm thấy bài viết";
		}
	}
?>

<script type="text/javascript">
	function ask_confirm() {
		let result = confirm('Bạn có chắc muốn xóa bài viết?');
		return result;
	}
</script>