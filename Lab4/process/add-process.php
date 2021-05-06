<?php

// Lay ma bai viet
function get_review_id() {
	require "dbmusic.inc.php";
	$sql = "SELECT MAX(ma_bviet) as max  FROM Reviews;";
	$result = $conn->query($sql)
			or die ("Query failed: " . $conn->error);
	$review_id = $result->fetch_assoc()['max'] + 1;

	echo $review_id;
}

function invalidReviewID($review_id) {
	if (!preg_match("/^[0-9]*$/", $review_id)) {
		echo "Mã bài viết phải là chữ số.";
	}
}

function invalidGenreID($genre_id) {
	if (!preg_match("/^[0-9]*$/", $genre_id)) {
		echo "Mã thể loại phải là chữ số.";
	}
}
 
// Them bai viet moi
function add_review() {
	// echo '<br> it works <br>';
	$id = $_POST['review_id'];
		$title = $_POST['title'];
		$reviewer = $_POST['reviewer'];
		$date = $_POST['date'];
		$song = $_POST['song'];
		$genre = $_POST['genre'];
		$summary = $_POST['summary'];

		invalidReviewID($id);
		invalidGenreID($genre);

		$query = "INSERT INTO Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) VALUES ('$id', '$title', '$song', '$genre','$summary', '$reviewer','$date');";

		require "dbmusic.inc.php";
		if (!$conn->query($query)) {
			echo "<h3>INSERT failed. " . $conn->error . "</h3>";
		} 

		displayReview();
		$conn->close();
}

// Hien thi danh sach bai viet
function displayReview() {
	$sql = "SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat
			FROM Reviews r1
			LEFT JOIN Reviewer r2 on r1.ma_tgia=r2.ma_tgia
			LEFT JOIN Genres g on r1.ma_tloai=g.ma_tloai";
	
	require "dbmusic.inc.php";
	$resultData = $conn->query($sql);

	if ($resultData->num_rows > 0) {
		while ($row = $resultData->fetch_assoc()) {
			echo '<hr><div class ="row">'
				.	$row['ma_bviet'] . '.&nbsp;<b>'
				.	$row['tieude'] . '</b>&nbsp;('
				.	$row['ten_bhat'] . ' -- '
				.	$row['ten_tloai'] . '). '
				.	$row['ten_tgia'] . ', '
				.	$row['ngayviet'] . '<br>							
			</div>';
		} 
	}
}

// Tao cac the option
function createSelect($select){
	switch($select)
    {
        case 1:
            $tbl = 'Reviewer';
            break;
        default:
            $tbl = 'Genres';
    }

	// nối kết CSDL, truy vấn dữ liệu
	require "dbmusic.inc.php";
	$sql = "SELECT * FROM $tbl";
	$result = $conn->query($sql)
			or die ("Query failed: " . $conn->error);

	if ($result->num_rows > 0) {
	// với mỗi mẩu tin, xuất ra 1 thẻ option tương ứng
		while ($row = $result->fetch_row()) {
			 echo "<option value='", $row['0'], "'>";
			 echo $row["1"], "</option>";
			}
		} 
}