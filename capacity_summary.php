<?php

  $nav_selected = "CAPACITY"; // set the current page; options: TRAINS, ORG, CAPACITY, TRAINING, REPORTS, SETUP, LOGIN, HELP, SEARCH
  $left_buttons = "YES"; // make the left menu buttons visible; options: YES, NO
  $left_selected = "SUMMARY";//let the left menu button selected; options: LIST, LISTS, GRID, TREE, HYBRID // IGNORE IF left_buttons==NO

  include("./nav.php"); ?>
  
  <div class="right-content">
    <div class="container">

        <h3 style = "color: #01B0F1;">Capacity Roll Up</h3>
		<p><b>For The Entire Program Increment PI-200 = 5500 Story Points</b></p>
		
		<table id="info" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered datatable-style"
               width="100%" style="width: 100px;">
               <thead>
                 <tr id="table-first-row">
                   <th>Type</th>
                   <th>ID</th>
                   <th>Name</th>
                   <th>Scrum Master / RTE / STE</th>
                   <th>PI200-1</th>
                   <th>PI200-2</th>
                   <th>PI200-3</th>
                   <th>PI200-4</th>
                   <th>PI200-5</th>
                   <th>PI200-6</th>
                   <th>Total</th>
                 </tr>
               </thead>

               <tbody>
			   
				<?php

                  $sql = "SELECT a.team_id, type, name, CONCAT(first_name, ' ', last_name) AS sm_name, iteration_1, iteration_2, iteration_3, iteration_4, iteration_5, iteration_6, total FROM
							(
								SELECT `trains_and_teams`.team_id, type, name, iteration_1, iteration_2, iteration_3, iteration_4, iteration_5, iteration_6, total from `trains_and_teams` LEFT JOIN 
									(
										SELECT * FROM `capacity` where program_increment='pi-100'
									) AS b
								ON `trains_and_teams`.`team_id` = b.`team_id` 
							) AS a
						JOIN `membership` WHERE `membership`.role='Scrum Master (SM)' GROUP BY team_id";
                  $result = run_sql($sql);

                  if($result -> num_rows > 0){
                    while($row = $result -> fetch_assoc()){
						if ($row["iteration_1"] == "null"){
							$parent = "--";
						} else {
							$parent = $row["iteration_1"];
						}
						if ($row["iteration_2"] == "null"){
							$parent = "--";
						} else {
							$parent = $row["iteration_2"];
						}
						if ($row["iteration_3"] == "null"){
							$parent = "--";
						} else {
							$parent = $row["iteration_3"];
						}
						if ($row["iteration_4"] == "null"){
							$parent = "--";
						} else {
							$parent = $row["iteration_4"];
						}
						if ($row["iteration_5"] == "null"){
							$parent = "--";
						} else {
							$parent = $row["iteration_5"];
						}
						if ($row["iteration_6"] == "null"){
							$parent = "--";
						} else {
							$parent = $row["iteration_6"];
						}
						if ($row["total"] == "null"){
							$parent = "--";
						} else {
							$parent = $row["total"];
						}
                      echo
                      "<tr>
                        <td >" . $row["type"] . "</td>
                        <td>" .$row["team_id"] ."</td>
                        <td>" .$row["name"] . "</td>
						<td>" .$row["sm_name"] ."</td>
                        <td>" .$row["iteration_1"] ."</td>
						<td>" .$row["iteration_2"] ."</td>
						<td>" .$row["iteration_3"] ."</td>
						<td>" .$row["iteration_4"] ."</td>
						<td>" .$row["iteration_5"] ."</td>
						<td>" .$row["iteration_6"] ."</td>
						<td>" .$row["total"] ."</td>
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
		<input type = "submit" id="capacity-button-blue" value = "Show Previous PI">
		<input type = "submit" id="capacity-button-blue" value = "Show Next PI">
		
    <script type="text/javascript">

         $(document).ready(function () {

             $('#info').DataTable({

             });

         });

     </script>
  
<?php include("./footer.php"); ?>
