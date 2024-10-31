
<?php
    $conn =new mysqli('localhost', 'root', '', 'covid');
        $id = $_GET['id'];
        // echo $id;
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
        $query = "SELECT * from patients where ID='$id'";
        $data=mysqli_query($conn, $query);
        $total=mysqli_num_rows($data);
        $result=mysqli_fetch_assoc($data);
    ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
<style>
.panel-primary{
    margin-top:10vh;
}
</style>
  </head>
  <body>
    
  <div class="container">
  <form action="#" method="POST">
      <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h1>Covid Centre</h1>
          </div>
          <div class="panel-body">
              <div class="form-group">
                <label for="firstName">Name</label>
                <input
                  value="<?php echo $result['name']; ?>"
                  type="text"
                  class="form-control"
                  id="firstName"
                  name="firstName"
                />
              </div>
              <div class="form-group">
                <label for="geeender">Gender</label>
                <div>
                  <label for="male" class="radio-inline"
                    ><input
                      type="radio"
                      
                      value="M"
                      id="male"
                      name="gender"
                    />Male</label
                  >
                  <label for="female" class="radio-inline"
                    ><input
                      type="radio"
                      value="F"
                      id="female"
                      name="gender"
                    />Female</label
                  >
                  <label for="others" class="radio-inline"
                    ><input
                      type="radio"
                      value="O"
                      id="others"
                      name="gender"
                    />Others</label
                  >
                </div>
              </div>
              <!-- <div class="form-group">
                <label for="email">Email</label>
                <input
                value="
                  type="text"
                  class="form-control"
                  id="email"
                  name="email"
                />
              </div> -->
              <div class="form-group">
                <label for="number">Phone Number</label>
                <input
                value="<?php echo $result['number']; ?>"
                  type="number"
                  class="form-control"
                  id="number"
                  name="number"
                />
              </div>
              <input type="submit" class="btn btn-primary" value="Update Details" name="update"/>
            </form>
          </div>
          
        </div>
      </div>
    </div>
    <?php
        if(isset($_POST['update'])){
        $fname = $_POST['firstName'];
        $gender = $_POST['gender'];
        // $email = $_POST['email'];
        $pnum = $_POST['number'];

        $query = "UPDATE patients set name='$fname', gender='$gender', number='$pnum' where ID='$id'";
        $data = mysqli_query($conn, $query);
        // Undefined array key "update" in C:\xampp\htdocs\dbms\update.php on line 84
    }
    ?>
     </body>
</html>


   