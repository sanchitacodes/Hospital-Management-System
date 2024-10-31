
<!DOCTYPE html>
<html>
  <head>
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <div class="container">
      <div class="row col-md-6 col-md-offset-3">
        
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h1>Covid Centre</h1>
          </div>
          <div class="panel-body">
            <form action="connect1.php" method="post">
              <div class="form-group">
                <label for="pid">Patient's ID</label>
                <input
                  type="text"
                  class="form-control"
                  id="pid"
                  name="pid"
                />
              </div>
              <div class="form-group">
                <label for="roomID">Room No</label>
                
                    <input
                    type="text"
                    class="form-control"
                    id="roomID"
                    name="roomID"
                  />
               
              </div>
              <div class="form-group">
                <label for="duration">Duration</label>
                <input
                  type="text"
                  class="form-control"
                  id="duration"
                  name="duration"
                />
              </div>
              
             <div class="form-group">
                <label for="arrival">Arrival Date</label>
                <input
                  type="date"
                  class="form-control"
                  id="arrival"
                  name="arrival"
                />
              </div>
              
              <input type="submit" name="submit" class="btn btn-primary" />
            </form>
          </div>
          
        </div>
      </div>
    </div>
     </body>
</html>