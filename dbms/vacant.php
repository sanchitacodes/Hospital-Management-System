<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document1</title>
    <style>
        /* Add a CSS rule to increase font size */
        .room{
            font-size: 25px; /* Adjust the desired font size */
        }
    </style>
</head>
<body>
<h1>List of vacant rooms:</h1>
<?php
$conn = new mysqli('localhost', 'root', '', 'covid');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 1: Retrieve assigned rooms
$sqlAssignedRooms = "SELECT room_no FROM assigned";
$resultAssignedRooms = $conn->query($sqlAssignedRooms);

if ($resultAssignedRooms->num_rows > 0) {
    while ($row = $resultAssignedRooms->fetch_assoc()) {
        $assignedRoomNo = $row['room_no'];

        // Step 2: Update room status to "Occupied"
        $sqlUpdateStatus = "UPDATE roomno SET occupancy = 'Occupied' WHERE room_number = $assignedRoomNo";
        $conn->query($sqlUpdateStatus);
    }
}

// Step 3: Display updated room list
// $sqlRooms = "SELECT room_number, occupancy FROM roomno";
// $resultRooms = $conn->query($sqlRooms);

// if ($resultRooms->num_rows > 0) {
//     echo "<table>";
//     echo "<tr><th>Room No.</th><th>Occupancy</th></tr>";
//     while ($row = $resultRooms->fetch_assoc()) {
//         echo "<tr>";
//         echo "<td>" . $row['room_number'] . "</td>";
//         echo "<td>" . $row['occupancy'] . "</td>";
//         // echo "<td>" . $row['status'] . "</td>";
//         echo "</tr>";
//     }
//     echo "</table>";
// } else {
//     echo "No rooms found.";
// }


$sqlVacantRooms = "SELECT room_number FROM roomno WHERE occupancy = 'Vacant'";
$resultVacantRooms = $conn->query($sqlVacantRooms);

if ($resultVacantRooms->num_rows > 0) {
    echo "<p class='room'>";
    // echo "<tr><th>Room No.</th></tr>";
    while ($row = $resultVacantRooms->fetch_assoc()) {
        
        echo $row['room_number'] . ", ";
        
    }
    echo "</p>";
} else {
    echo "No vacant rooms found.";
}

$conn->close();
?>



</body>
</html>    