<?php 

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    $id = $_POST['id'];
   
    switch($action) {
        case 'update' : 
      		$title = $_POST['title'];
					$reviewer = $_POST['reviewer'];
					$date = $_POST['date'];
					$song = $_POST['song'];
					$genre = $_POST['genre'];
					$summary = $_POST['summary'];
        	updateData($id, $title, $reviewer, $date, $song, $genre, $summary);
        	displayData($id);
        	break;
      	
      	case 'add-reviewer' :
      		$name = $_POST['name'];
      		addReviewer($id, $name);
      		displayData($id);
      	  break;
      	
      	default : displayData($id);
    }
}

// Thêm tác giả mới khi nhấn nút Thêm tác giả
function addReviewer($id, $name) {
	require "dbmusic.inc.php";
	// echo "<script type='text/javascript'>alert('function');</script>";
	// Lay ma tac gia
	$sql = "SELECT MAX(ma_tgia) as max  FROM Reviewer;";
	$result = $conn->query($sql) or die ("Query failed: " . $conn->error);
	$reviewer_id = $result->fetch_assoc()['max'] + 1;

	// Them tac gia
	$sql = "INSERT INTO Reviewer(ma_tgia,ten_tgia) VALUES('$reviewer_id','$name')";
	$result = $conn->query($sql) or die ("Query failed: " . $conn->error);
	echo "<script type='text/javascript'>alert('insert: $result');</script>";

	// Cap nhat lai du lieu trong bang Reviews
	$sql = "UPDATE Reviews SET ma_tgia='$reviewer_id' WHERE ma_bviet='$id'";
	$result = $conn->query($sql) or die ("Query failed: " . $conn->error);
	echo "<script type='text/javascript'>alert('update: $result');</script>";
	
	$conn->close();
}

// Hàm cập nhật bài viết 
function updateData($id, $title, $reviewer, $date, $song, $genre, $summary) {
	// echo "<script type='text/javascript'>alert('update');</script>";

	require "dbmusic.inc.php";

	$sql = "UPDATE Reviews SET tieude='$title' , ma_tgia='$reviewer' , ngayviet='$date' , ten_bhat='$song' , ma_tloai='$genre', tomtat='$summary' WHERE ma_bviet = '$id'";

	$conn->query($sql) or die ("Query failed: " . $conn->error);
	$conn->close();
}

// Hàm tạo các thẻ option và select thẻ option theo bài viết
function chooseSelect($select, $name){
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
		while ($row = $result->fetch_row()) {
			$output = "<option value='".$row['0']."'";
            if($name == $row['1']){
                $output .= " selected='selected'";
            }
            $output .= ">".$row['1']."</option>";
            echo $output;          
		}
	} 
	$conn->close();
}

// Hàm tạo thẻ option cho Chọn bài viết
function createSelect(){
	require "dbmusic.inc.php";
	$sql = "SELECT * FROM Reviews";
	$result = $conn->query($sql)
			or die ("Query failed: " . $conn->error);

	if ($result->num_rows > 0) {
	
		while ($row = $result->fetch_row()) {
			 echo "<option value='", $row['0'], "'>";
			 echo $row['1'], "</option>";
		}
	}
	$conn->close();
}

function displayData($id) {

	$sql = "SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat
					FROM Reviews r1
					LEFT JOIN Reviewer r2 on r1.ma_tgia=r2.ma_tgia
					LEFT JOIN Genres g on r1.ma_tloai=g.ma_tloai
					WHERE ma_bviet = ?";

	require "dbmusic.inc.php";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($ma_bviet, $tieude, $ten_tgia, $ngayviet, $ten_bhat, $ten_tloai, $tomtat);
	$stmt->fetch();
	$stmt->close();
	// $resultData = $conn->query($sql);

	// if ($resultData->num_rows > 0) {
	// 	while ($row = $resultData->fetch_assoc()) {
		
		echo 
		'<div class="form-row">
 	 		<label for="review_id">Mã bài viết</label> 		
 	 		<input type="text" name="review_id" id="review_id" value="', $ma_bviet,'">
 	 	</div>
 	 	
 	 	<div class="form-row">
 	 		<label for="title">Tiêu đề</label>
			<input type="text" name="title" id="title" value="', $tieude,'">
 	 	</div>

 	 	<div class="form-row">
 	 		<label for="reviewer">Tác giả</label>
			<select name="reviewer" id="reviewer">';
				
			chooseSelect(1,$ten_tgia); // tạo option để chọn tác giả
			
		echo'</select>
			<input type="text" name="new-reviewer" id="new-reviewer" style="width:8rem">
			<input type="submit" name="add-reviewer" id="add-reviewer" value="Thêm tác giả" style=" width:5.4rem">
 	 	</div>

 	 	<div class="form-row">
 	 		<label for="date">Ngày viết</label>
			<input type="text" name="date" id="date" value="', $ngayviet,'">
 	 	</div>

 	 	<div class="form-row">
 	 		<label for="song">Bài hát</label>
			<input type="text" name="song" id="song" value="', $ten_bhat,'">
 	 	</div>

 	 	<div class="form-row">
 	 		<label for=" genre">Thể loại</label>
			<select name="genre" id="genre">';
			
			chooseSelect(2,$ten_tloai); // tạo option để chọn thể loại
		
		echo'</select>
 	 	</div>

 	 	<div class="form-row">
 	 		<label for="summary">Tóm tắt</label>
			<textarea type="text" name="summary" id="summary">', $tomtat, '</textarea>
 	 	</div>';			
}
