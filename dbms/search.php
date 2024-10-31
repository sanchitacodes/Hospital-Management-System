<?php 
                                    $conn = mysqli_connect("localhost","root","","covid");

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM patients WHERE CONCAT(name) LIKE '%$filtervalues%' ";
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
                                          echo '<th colspan="2">Action</th>';
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
                                  }
                                  
                                ?>