<?php 
	$firstName = $_POST['firstName'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$number = $_POST['number'];

	// Database connection
	$conn = new mysqli('localhost','root','','covid');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		// $stmt = $conn->prepare("insert into patients(name, gender,email,password,number) values(?, ?, ?, ?, ?)");
		$stmt = $conn->prepare("insert into patients(name,gender,email,password,number) values(?, ?, ?,?, ?)");
		
		// $stmt->bind_param("ssssi", $firstName, $gender,$email, $password, $number);
		$stmt->bind_param("ssssi", $firstName, $gender, $email, $password, $number);


		$execval = $stmt->execute();
		echo $execval;
		echo "Details inserted successfully...";
		$stmt->close();
		$conn->close();
	}
?>

