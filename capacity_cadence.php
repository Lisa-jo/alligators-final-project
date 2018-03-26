<?php

  $nav_selected = "CAPACITY"; // set the current page; options: TRAINS, ORG, CAPACITY, TRAINING, REPORTS, SETUP, LOGIN, HELP, SEARCH
  $left_buttons = "YES"; // make the left menu buttons visible; options: YES, NO
  $left_selected = "CADENCE"; // set the left menu button selected; options: LIST, LISTS, GRID, TREE, HYBRID // IGNORE IF left_buttons==NO

  include("./nav.php"); ?>
  
  
  <div class="right-content">
   <div class="container">

       <h3 style = "color: #01B0F1;">Cadence:</h3>
        
        
        
        
    
        <table id="info" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered datatable-style"
              width="100%" style="width: 100px;">
              <thead>
                <tr id="table-first-row">
                  <th>Sequence</th>
                  <th>PRogram Increment</th>
                  <th>Iteration</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Duration</th>
                  <th>Notes</th>
                </tr>
              </thead>

              <tbody>
              
                <?php

                 $sql = "select sequence, program_increment, iteration, start_date, end_date, duration, notes
                         from cadence";
                 $result = run_sql($sql);

                 if($result -> num_rows > 0){
                   while($row = $result -> fetch_assoc()){

                     echo
                     "<tr>
                         <td >" . $row["sequence"] . "</td>
                         <td>" .$row["program_increment"] ."</td>
                         <td>" .$row["iteration"] . "</td>
                                      <td>" .$row["start_date"] ."</td>
                         <td>" .$row["end_date"] ."</td>
                                      <td>" .$row["duration"] ."</td>
                                      <td>" .$row["notes"] ."</td>
                                      
                     </tr>";
                   }

                 }
                  else {
                   echo "0 results";
                 }

                 $result->close();


                ?>




              </tbody>

               
        </table>
        
        
        
        
   
     
        <script type="text/javascript">

         $(document).ready(function () {

             $('#info').DataTable({

             });

         });

     </script>
  
  <?php include("./footer.php"); ?>
