<?php 
	$firstName = $_POST['pid'];
	$gender = $_POST['roomID'];
	$email = date('Y-m-d', strtotime($_POST['arrival']));
	$password = $_POST['duration'];
	// $number = $_POST['number'];

	//Database connection
	$conn = new mysqli('localhost','root','','covid');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into assigned(pid, room_no, duration, arrival) values(?, ?, ?, ?)");
		$stmt->bind_param("iiis", $firstName, $gender, $password, $email);
		$execval = $stmt->execute();
		echo $execval;
		echo "Details inserted successfully...";
		$stmt->close();
		$conn->close();
	}


    // session_start();
    // $conn = new mysqli('localhost','root','','covid');

    // if(isset($_POST['submit'])){
    //     $firstName = $_POST['pid'];
    //     $gender = $_POST['roomID'];
    //     $email = date('Y-m-d', strtotime($_POST['arrival']));

    //     $query = "INSERT INTO assigned(p_id, room_no, arrival), VALUES (?, ?, ?)";
    //     $query_run = mysqli_query($conn, $query);

    //     if($query_run){
    //         $_SESSION['status'] = "Data inserted";
    //         header("Location:assigned.php");
    //     }
    //     else{
    //         $_SESSION['status'] = "Data failed";
    //         header("Location:assigned.php");
    //     }
    // }
?>

