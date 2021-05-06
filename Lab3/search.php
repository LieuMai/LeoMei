<?php
	function search($keyword) {
		require "dbmusic.inc.php";
		$word = trim($keyword);
		$word = preg_replace('/\s+/', ' ', $word);
		$keywords = explode(" ", $word); // create array of keywords

		// here we build the string to require all keywords
		$keywds_str = "+" . implode(" +", $keywords);
		$query = "SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat
				FROM Reviews r1
				LEFT JOIN Reviewer r2 ON r1.ma_tgia=r2.ma_tgia
				LEFT JOIN Genres g ON r1.ma_tloai=g.ma_tloai
				WHERE MATCH (tieude,ten_bhat) AGAINST ('".$keywds_str."' )";

							// WHERE MATCH (tieude,ten_bhat) AGAINST ('". $new_kw ."' IN  BOOLEAN MODE )";

		$result = $conn->query($query)
			or die ("Query failed: " . $conn->error);

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_row()) 
				{
					echo '<div class ="review row">
						<div class="left col-3">
							<p>
								Mã bài viết:<br>
								Tiêu đề:<br>
								Tác giả:<br>
								Ngày viết:<br>
								Bài hát:<br>
								Thể loại:<br>
								Tóm tắt:<br>
							</p>
						</div>
						<div class="right col-6">'
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
			echo "Không tìm thấy bài viết";
		}
	}
?>