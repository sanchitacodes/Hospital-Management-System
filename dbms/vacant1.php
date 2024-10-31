<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Occupancy Status</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        /* Add CSS rules to style the grid */
        .room-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 10px;
            font-family:Arial, Helvetica, sans-serif;
        }
        .room {
            background-color: #f0f0f0;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .OCCUPIED {
            text-transform: uppercase;
            background-color: #ff7474;
        }
        .VACANT {
            background-color: #5ced73;
        }
    </style>
</head>
<body>
    <h1>Room Occupancy Status:</h1>
    <div class="room-grid">
        <?php
        $conn = new mysqli('localhost', 'root', '', 'covid');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sqlRooms = "SELECT room_number, occupancy FROM roomno";
        $resultRooms = $conn->query($sqlRooms);

        if ($resultRooms->num_rows > 0) {
            while ($row = $resultRooms->fetch_assoc()) {
                $roomNumber = $row['room_number'];
                $occupancy = $row['occupancy'];
                $class = (strcasecmp($occupancy, 'occupied') === 0)? 'OCCUPIED' : 'VACANT';
                echo "<div class='room $class'>$roomNumber ($occupancy)</div>";
            }
        } else {
            echo "No rooms found.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>