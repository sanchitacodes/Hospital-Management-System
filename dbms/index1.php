<?php
// Include your database connection
$conn = mysqli_connect("localhost", "root", "", "covid");

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet"/>
    <script>
function openWin() {
  window.open("insert.html");
}
function openWinn3() {
  window.open("assigned.php");
}
function openWinn(){
  window.open("display.php");
}
function openWinn2(){
  window.open("vacant.php");
}
function openWinn4(){
  window.open("quarantined.php");
}
function openWinn6(){
  window.open("vacant1.php");
}
const searchInput = document.querySelector('.search input[type="text"]');
    const searchForm = document.querySelector('.search form');

    searchInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            searchForm.submit();
        }
    });

    const sidebar = document.querySelector(".sidebar");
    const sidebarClose = document.querySelector("#sidebar-close");

    sidebarClose.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    });
</script>

</head>

<body>
<!-- <input type="checkbox" name="MenuToggle" id="MenuToggle"> -->

   <nav  class="sidebar">
    <h1>Covid Center</h1>
   <div class=container>
  <input type="button" value="INSERT" onclick="openWin()">
  <input type="button" value="SEARCH BY DATE" onclick="openWinn()">
  <input type="button" value="VACANT ROOMS" onclick="openWinn2()">
  <input type="button" value="ROOM ALLOCATION" onclick="openWinn3()">
  <a href=""><i class="fa fa-power-off"></i> Log-out</a>
</div>
  
   </nav>
  
   
   <nav class="navbar">
    <div class="menu">
   <i class="fa-solid fa-bars"></i>
  </div>
  <div class="menu1">
   <input type="button" value="QUARANTINE RECORDS" onclick="openWinn4()">
   <input type="button" value="REPORTS" onclick="openWinn5()">
   <input type="button" value="ROOM MANAGEMENT" onclick="openWinn6()">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="search">
    
    <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search with name">
    <i class="fa fa-search"></i>
    <!-- <button type="submit" class="btn btn-primary">Search</button> -->

  </form>
  <i class="fa fa-user"></i>


  <!-- <input type="button" value="Login" onclick="openWinn4()"> -->
  </div>
  </nav>

   
<!-- <form>
    <div class=container>
  <input type="button" value="INSERT" onclick="openWin()">
  <input type="button" value="DISPLAY" onclick="openWinn()">
  <input type="button" value="VACANT ROOMS" onclick="openWinn2()">
  <input type="button" value="ROOM ALLOCATION" onclick="openWinn3()">
</div>
  <div class="search">
    <input type="text" name="search" required value="class="form-control" placeholder="Search with name">
    <button type="submit" class="btn btn-primary">Search</button>
</div>

</form> -->
<main class="main">
<!-- <table border="1" cellspacing="15" cellpadding="0"> -->
        <!-- <tr>
            <th>ID</th>
            <th>Room No.</th> -->
            <!-- <th>Name</th>
            <th>Gender</th>s
            <th>Departure</th>
            <th>Phone_Number</th>
            <th colspan="2">Action</th> -->
        <!-- </tr>  -->
       
  <div class="card-container">
    <div class="card">
      <h2>Available Cases</h2>
      <p>
      <?php
                $query = "SELECT COUNT(*) as count FROM patients WHERE status = 'current'";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    echo $row['count'];
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                ?>
      </p>
    </div>
    <div class="card">
      <h2>Recovered Cases</h2>
      <p>
      <?php
                $query = "SELECT COUNT(*) as count FROM patients WHERE status = 'past'";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    echo $row['count'];
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                ?>
      </p>
    </div>
    <div class="card">
      <h2>Total Cases</h2>
      <p>
      <?php
                $query = "SELECT COUNT(*) as count FROM patients";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    echo $row['count'];
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                ?>
                </p>
    </div>
  </div>

        <!-- <div class="container1"> -->
                        <?php
        if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM patients WHERE CONCAT(name) LIKE '%$filtervalues%' ";
                                    }
                                    else{
                                      $query = "SELECT * FROM patients WHERE status = 'current'";
                                    }
                                        $query_run = mysqli_query($conn, $query);
                                       
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                          echo '<table border="1" cellspacing="15" cellpadding="0">';
                                          echo '<tr>';
                                          echo '<th>ID</th>';
                                          echo '<th>Room No.</th>';
                                          echo '<th>Name</th>';
                                          echo '<th>Gender</th>';
                                          echo '<th>Departure</th>';
                                          echo '<th>Phone Number</th>';
                                          // echo '<th colspan="2">Action</th>';
                                          echo '</tr>';

                                            foreach($query_run as $items)
                                            {
                                              echo '<tr>';
                                              echo '<td>' . $items['ID'] . '</td>';
                                              echo '<td>' . $items['roomNo'] . '</td>';
                                              echo '<td>' . $items['name'] . '</td>';
                                              echo '<td>' . $items['gender'] . '</td>';
                                              echo '<td>' . $items['Departure'] . '</td>';
                                              echo '<td>' . $items['number'] . '</td>';
                                              echo '</tr>';
                                            }
                                            echo '</table>';
                                        }
                                        else
                                        {
                                          echo '<p>No Record Found</p>';
                                      }
                                ?>
                                <!-- </table> -->
                                    <!-- </div> -->
  </main>
                           
                                
</body>
</html>