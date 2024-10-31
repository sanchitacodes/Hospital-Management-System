<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Covid Patients</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            color: #337ab7;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            text-align: center;
        }
        h1 {
            color:#337ab7;
            font-family: Arial, Helvetica, sans-serif;
            font-size:30px;
            font-weight:0px;
        }
        th {
            background-color: #337ab7;
            color: white;
            font-size: 27px;
            text-align: center;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn {
            text-decoration: none;
            background-color: #71AEEF;
            margin: 3px 0px;
            color: #fff;
        }
        .btn:hover {
            background-color: #337ab7;
        }
    </style>
</head>
<body>
    <h1>List of Covid Patients</h1>
    <table border="1" cellspacing="15" cellpadding="0">
        <tr>
            <th>ID</th>
            <th>Room No.</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Discharge</th>
            <th>Phone Number</th>
            <th>Status</th>
        </tr>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'covid');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['id'])) {  
            $id = $_GET['id'];  

            $queryUpdateStatus = "UPDATE patients SET status='past' WHERE id='$id'";
            $conn->query($queryUpdateStatus);

            $queryAssigned = "DELETE FROM assigned WHERE pid='$id'";
            $conn->query($queryAssigned);
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
            $sqlUpdateRoom = "UPDATE patients SET roomNo='$roomNo' WHERE ID=$patientId";
            $conn->query($sqlUpdateRoom);
        }

        $sqlArrival = "SELECT pid, arrival FROM assigned";
        $resultArrival = $conn->query($sqlArrival);

        if ($resultArrival->num_rows > 0) {
            while ($rowArrival = $resultArrival->fetch_assoc()) {
                $patientId = $rowArrival['pid'];    
                $arrivalDate = $rowArrival['arrival'];

                $departureDate = date('Y-m-d', strtotime($arrivalDate . ' +7 days'));

                $sqlUpdate = "UPDATE patients SET Departure='$departureDate' WHERE ID=$patientId";
                $conn->query($sqlUpdate);
            }
        }

        $sql = "SELECT * FROM patients";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $patientId = $row["ID"];
                $roomNo = isset($roomNumbers[$patientId]) ? $roomNumbers[$patientId] : "N/A";
                echo "<tr>
                    <td>". $row["ID"] ."</td>
                    <td>". $roomNo ."</td>
                    <td>". $row["name"] ."</td>
                    <td>". $row["gender"] ."</td>
                    <td>". $row["Departure"] ."</td>
                    <td>". $row["number"] ."</td>
                    <td>". $row["status"] ."</td>
                </tr>";
            }       
        } else {
            echo "<tr><td colspan='9'>0 results</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
