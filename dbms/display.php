<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document1</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        body{
            margin:5px;
        }
        table{
            border-collapse: collapse;
            width:100%;
            color:#337ab7;
            font-family: Arial, Helvetica, sans-serif;
            font-size:20px;
            text-align:center;
            top:50%;
        }
        h1{
            color:#3583e8;
        }
        th{
            background-color: #337ab7;
            color:white;
            font-size:27px;
            text-align:center;
        }
        tr:nth-child(even) {background-color: #f2f2f2};

        .btn{
            text-decoration:none;
        }
        .btn{
            text-decoration:none;     
            background-color:#71AEEF;
            margin:3px 0px;
            color:#fff;  
        }
        .btn:hover{
           background-color:#337ab7;
        }
        label{
            font-size:18px;
            color:#2c5ba2;
        }
        #arrival_date {
            width: 300px;
            height:30px; /* Adjust the width as needed */
            /* padding: 10px; Add some padding */
            font-size: 16px; /* Adjust the font size */
            border: 3px solid #83aff0; /* Add a border */
            border-radius: 5px; /* Rounded corners */
            margin-bottom: 10px; /* Space b*/
        }
    </style>
</head>
<body>
    <h1>List of covid patients</h1>

    <form method="GET" action="">
        <label for="arrival_date">Enter Arrival Date:</label>
        <input type="date" id="arrival_date" name="arrival_date" required>
        <input type="submit" value="Search">
    </form>

    <table border="1" cellspacing="15" cellpadding="0">
        <tr>
            <th>ID</th>
            <th>Room No.</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Departure</th>
            <th>Phone_Number</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        $conn =new mysqli('localhost', 'root', '', 'covid');
        

        if($conn->connect_error){
            die("Connection failed:" . $conn->connect_error);
    }

    $sqlRoom = "SELECT pid, room_no FROM assigned";
    $resultRoom = $conn->query($sqlRoom);

    $roomNumbers = []; 
    if ($resultRoom->num_rows > 0) {
        while ($rowRoom = $resultRoom->fetch_assoc()) {
            $roomNumbers[$rowRoom['pid']] = $rowRoom['room_no'];
        }
    }

    foreach ($roomNumbers as $patientId => $roomNo) {
        $sqlUpdateRoom = "UPDATE patients SET roomNo = '$roomNo' WHERE ID = $patientId";
        $conn->query($sqlUpdateRoom);
    }

    if (isset($_GET['id'])) {  
        $id = $_GET['id'];  

        $roomNo = isset($roomNumbers[$id]) ? $roomNumbers[$id] : null;
        if ($roomNo) {
            $sqlUpdateStatus = "UPDATE roomno SET occupancy = 'VACANT' WHERE room_number = $roomNo";
            $conn->query($sqlUpdateStatus);
        }


        $queryAssigned = "DELETE FROM `assigned` WHERE pid = '$id'";
        $runAssigned = mysqli_query($conn, $queryAssigned);

        $query = "UPDATE `patients` SET status = 'past' WHERE id = '$id'";  
        $run = mysqli_query($conn, $query);

    }

    $sqlArrival = "SELECT pid, arrival FROM assigned";
    $resultArrival = $conn->query($sqlArrival);
    
    if ($resultArrival->num_rows > 0) {
        while($rowArrival = $resultArrival->fetch_assoc()){
        $patientId = $rowArrival['pid'];    
        $arrivalDate = $rowArrival['arrival'];
    
        $departureDate = date('Y-m-d', strtotime($arrivalDate . ' +7 days'));
    
        $sqlUpdate = "UPDATE patients SET Departure = '$departureDate' WHERE ID = $patientId";
        if ($conn->query($sqlUpdate)) {
            echo "";
        } else {
            echo "Error updating departure date: " . $conn->error;
        }
    }
    } else {
        echo "Patient not found in the arrival table.";
    }

    if (isset($_GET['arrival_date'])) {
        $arrival_date = $_GET['arrival_date'];

        // Retrieve patient records based on the arrival date
        $sql = "SELECT p.ID, p.name, p.gender, p.Departure, p.number, p.roomNo
                FROM patients p
                JOIN assigned a ON p.ID = a.pid
                WHERE a.arrival = '$arrival_date' AND p.status = 'current'";  
    }
    else {
        // Retrieve all patient records by default
        $sql = "SELECT p.ID, p.name, p.gender, p.Departure, p.number, p.roomNo
                FROM patients p
                JOIN assigned a ON p.ID = a.pid
                WHERE p.status = 'current'";
    }
        // $sql = "SELECT * from patients  WHERE status = 'current'";
        $result = $conn->query($sql);
        if($result-> num_rows>0){
            while($row = $result-> fetch_assoc()){
                $patientId = $row["ID"];
                $roomNo = isset($roomNumbers[$patientId]) ? $roomNumbers[$patientId] : "N/A"; 
                echo "<tr>
        <td>". $row["ID"] ."</td>
        <td>". $roomNo ."</td>
        <td>". $row["name"] ."</td>
        <td>". $row["gender"] ."</td>
        <td>". $row["Departure"] ."</td>
        <td>". $row["number"] ."</td>
        <td>
        <a href='update.php?id=".$row['ID']."' class='btn'>Update</a>
        </td> 
        <td>
        <a href='display.php?id=".$row['ID']."' class='btn'>Delete</a>
        </td>  
        </tr>";
        }       
    }
   else{
    if (isset($_GET['arrival_date'])) {
        echo "<tr><td colspan='8'>No results found for the selected arrival date.</td></tr>";
    } else {
        echo "<tr><td colspan='8'>Please enter an arrival date to search.</td></tr>";
    }
}
   $conn->close();
?>

    </table>
</body>
</html>