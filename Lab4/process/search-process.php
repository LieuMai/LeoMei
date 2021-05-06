<?php
	// p_total: total no of pages; 
	// p_no: current page; 
	// p_start: index of the first 
	// record in the page; 
	// total: total number of records
	$record_ppage = 2;

	function compute_paging($keywds_str) {
		require "dbmusic.inc.php";
		global $record_ppage;
		$query = "SELECT count(*) FROM Reviews r1
				LEFT JOIN Reviewer r2 ON r1.ma_tgia=r2.ma_tgia
				LEFT JOIN Genres g ON r1.ma_tloai=g.ma_tloai
				WHERE MATCH (tieude,ten_bhat) AGAINST ('".$keywds_str."' )";

		$result = $conn->query($query);
		$row = $result->fetch_row();
		$p_total = ceil($row[0]/$record_ppage);
		$page = (isset($_REQUEST["page"]))? $_REQUEST["page"] : 1;
		$p_start = ($page - 1) * $record_ppage;
		$p_next = ($page > 1)? $page - 1 : 0;
		$p_pre = ($page < $p_total)? $page + 1 : 0;

		return array("p_total"=>$p_total, "p_no"=>$page,
					"p_start"=>$p_start, "p_prev"=>$p_next,
					"p_next"=>$p_pre, "total"=>$row[0]);
	}

	function search($keyword) {
		require "dbmusic.inc.php";
		global $record_ppage;
		$word = trim($keyword);
		$word = preg_replace('/\s+/', ' ', $word);
		$keywords = explode(" ", $word); // create array of keywords

		// here we build the string to require all keywords
		$keywds_str = "+" . implode(" +", $keywords);

		$paging = compute_paging($keywds_str);

		$query = "SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat
				FROM Reviews r1
				LEFT JOIN Reviewer r2 ON r1.ma_tgia=r2.ma_tgia
				LEFT JOIN Genres g ON r1.ma_tloai=g.ma_tloai
				WHERE MATCH (tieude,ten_bhat) AGAINST ('".$keywds_str."' )" 
				. "LIMIT $paging[p_start], $record_ppage";
		
		$result = $conn->query($query)
		or die ("Query failed: " . $conn->error);

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) 
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
						<div class="right col-7">'
						.	$row['ma_bviet'] . '<br>'
						.	$row['tieude'] . '<br>'
						.	$row['ten_tgia'] . '<br>'
						.	$row['ngayviet'] . '<br>'
						.	$row['ten_bhat'] . '<br>'
						.	$row['ten_tloai'] . '<br>'
						.	mb_substr($row['tomtat'], 0, 50, "UTF-8") . '...<br>
						</div>
					</div><hr>';
				}
		}
		else {
			echo "Không tìm thấy bài viết";
		}
		return $paging;
	}

	function page_nav_links($paging, $search_kw) {
		echo "Số trang $paging[p_no]/$paging[p_total]:&nbsp&nbsp&nbsp";

		if($paging['p_prev'] > 0){
			echo "<a href='search-form.php?search_kw=$search_kw" .
				"&page=" . $paging['p_prev'] . "'>Trước</a>&nbsp&nbsp&nbsp";
		}

		if ($paging['p_next'] > 0) {
			echo "<a href='search-form.php?search_kw=$search_kw " . 
				"&page=" .$paging['p_next'] . "'>Sau</a>";
		}
	}
?>