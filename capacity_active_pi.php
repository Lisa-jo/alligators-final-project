<?php

  $nav_selected = "CAPACITY"; // set the current page; options: TRAINS, ORG, CAPACITY, TRAINING, REPORTS, SETUP, LOGIN, HELP, SEARCH
  $left_buttons = "YES"; // make the left menu buttons visible; options: YES, NO
  $left_selected = "ACTIVE_PI"; // set the left menu button selected; options: LIST, LISTS, GRID, TREE, HYBRID // IGNORE IF left_buttons==NO

  include("./nav.php"); 
  
  date_default_timezone_set('America/Chicago');
  
  ?>

 <div class="right-content">
    <div class="container">

		<table id="info" cellpadding="2px" cellspacing="0" border="0" class="capacity-table"
             width="100%" style="width: 100%; clear: both; font-size: 15px;">
			 
			<thead>

				<tr>

					<th style="text-align:center" colspan="2" id="capacity-table-td"><font color="DeepSkyBlue">Current Iteration Details</th>

				</tr>

			</thead>
		  
		  <tbody>
		  
			  <tr>
				<td id='capacity-table-td' style='font-weight:500;'>Today's Date</td>
				<?php
					echo "<td id='capacity-table-td' style='font-weight:500;'>" . date("Y-m-d") . "</td>";
				?>
			  </tr>
			  <tr>
				<td id='capacity-table-td' style='font-weight:500;'>Program Increment (PI)</td>
				<?php
					$sql = "SELECT *
					FROM `cadence`
					WHERE start_date <= '" . date("Y-m-d") . "'
					AND end_date >= '". date("Y-m-d") . "'";
					$result = run_sql($sql);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						echo "<td id='capacity-table-td' style='font-weight:500;'>" . $row["program_increment"] . "</td>";
					} else {
						echo "<td id='capacity-table-td' style='font-weight:500;'>In-between Program Increments</td>";
					}
					$result->close();
				?>
			  </tr>
			  <tr>
				<td id='capacity-table-td' style='font-weight:500;'>Iteration</td>
				<?php
					$sql = "SELECT *
					FROM `cadence`
					WHERE start_date <= '" . date("Y-m-d") . "'
					AND end_date >= '". date("Y-m-d") . "'";
					$result = run_sql($sql);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						echo "<td id='capacity-table-td' style='font-weight:500;'>" . $row["iteration"] . "</td>";
					} else {
						echo "<td id='capacity-table-td' style='font-weight:500;'>In-between Iterations</td>";
					}
					$result->close();
				?>
			  </tr>
			  <tr>
				<td id='capacity-table-td' style='font-weight:500;'>Current Iteration Ends On</td>
				<?php
					$sql = "SELECT *
					FROM `cadence`
					WHERE start_date <= '" . date("Y-m-d") . "'
					AND end_date >= '". date("Y-m-d") . "'";
					$result = run_sql($sql);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						echo "<td id='capacity-table-td' style='font-weight:500;'>" . $row["end_date"];
						$date1 = new DateTime(date("Y-m-d"));
						$date2 = new DateTime($row["end_date"]);
						$interval = $date1->diff($date2);
						echo " (In " . ($interval->days) . " days)";
					} else {
						echo "<td id='capacity-table-td' style='font-weight:500;'>In-between Iterations</td>";
					}
					$result->close();
				?>
			  </tr>
			  <tr>
				<td id='capacity-table-td' style='font-weight:500;'>Current Program Increment Ends On</td>
				<?php
					$sql = "SELECT *
						FROM
						(	SELECT MIN(start_date) as start_date, MAX(end_date) as end_date
							FROM cadence
							WHERE start_date <= '" . date("Y-m-d") . "'
							OR end_date >= '" . date("Y-m-d") . "'
							GROUP BY program_increment
						) as PI
						WHERE PI.start_date <= '" . date("Y-m-d") . "'
						AND PI.end_date >= '" . date("Y-m-d") . "'";
					$result = run_sql($sql);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						echo "<td id='capacity-table-td' style='font-weight:500;'>" . $row["end_date"];
						$date1 = new DateTime(date("Y-m-d"));
						$date2 = new DateTime($row["end_date"]);
						$interval = $date1->diff($date2);
						echo " (In " . ($interval->days + 1). " days)";
					} else {
						echo "<td id='capacity-table-td' style='font-weight:500;'>In-between Program Increments</td>";
					}
					$result->close();
				?>
			
			</tbody>
			<tfoot>
			</tfoot>
		</table>
    </div>
</div>

<?php include("./footer.php"); ?>
