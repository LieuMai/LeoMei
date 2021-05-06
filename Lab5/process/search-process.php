<?php
	// p_total: total no of pages; 
	// p_no: current page; 
	// p_start: index of the first 
	// record in the page; 
	// total: total number of records
	$record_ppage = 5;


	function compute_paging($keywds_str) {
		require "dbmusic.inc.php";
		global $record_ppage;
		global $total;
		$query = "SELECT count(*) FROM Reviews r1
				LEFT JOIN Reviewer r2 ON r1.ma_tgia=r2.ma_tgia
				LEFT JOIN Genres g ON r1.ma_tloai=g.ma_tloai
				WHERE MATCH (tieude,ten_bhat) AGAINST ('".$keywds_str."' )";

		$result = $conn->query($query);	
		$row = $result->fetch_row();
		$total = $row[0];
		$p_total = ceil($row[0]/$record_ppage);
		$page = (isset($_REQUEST["page"]))? $_REQUEST["page"] : 1;
		$p_start = ($page - 1) * $record_ppage;
		$p_next = ($page > 1)? $page - 1 : 0;
		$p_pre = ($page < $p_total)? $page + 1 : 0;

		return array("p_total"=>$p_total, "p_no"=>$page,
					"p_start"=>$p_start, "p_prev"=>$p_next,
					"p_next"=>$p_pre, "total"=>$total);
	}

	function search($keyword) {
		require "dbmusic.inc.php";
		global $record_ppage;
		global $total;
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
			echo "<p>Kết quả tìm được: ". $total ." bài viết</p>";
			while ($row = $result->fetch_assoc()) 
				{
					echo 
					'<div class="s-entry">
						<div class="s-title">'. $row['tieude']. '</div>
						<div class="s-subtitle">'. $row['ngayviet'] . '&nbsp&nbsp' . $row['ten_tgia'] . '</div>
						<div class="s-tomtat">
							<span class="bhat-tloai">' . $row['ten_bhat'] . '&nbsp(' . $row['ten_tloai'] . ')&nbsp</span>';
							summaryCut($row['tomtat'],100);
						echo'</div>	
					</div>';
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

