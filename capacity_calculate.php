<?php

  $nav_selected = "CAPACITY"; // set the current page; options: TRAINS, ORG, CAPACITY, TRAINING, REPORTS, SETUP, LOGIN, HELP, SEARCH
  $left_buttons = "YES"; // make the left menu buttons visible; options: YES, NO
  $left_selected = "CALCULATE"; // set the left menu button selected; options: LIST, LISTS, GRID, TREE, HYBRID // IGNORE IF left_buttons==NO

  include("./nav.php");

  date_default_timezone_set('America/Chicago');

  $sql = "SELECT program_increment, iteration, sequence
          FROM `cadence`
          WHERE start_date <= '" . date("Y-m-d") . "'
          AND end_date >= '". date("Y-m-d") . "';";
  $result = run_sql($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $program_increment = $row["program_increment"];
    $iteration = $row["iteration"];
    $sequence = $row["sequence"];
    $result->close();
  } else {
    //echo "In-between Iterations";
    $result->close();

    $sql = "SELECT *
        FROM
        (	SELECT MIN(start_date) as start_date, MAX(end_date) as end_date
          FROM cadence
          WHERE start_date <= '" . date("Y-m-d") . "'
          OR end_date >= '" . date("Y-m-d") . "'
          GROUP BY program_increment
        ) as PI
        WHERE PI.start_date <= '" . date("Y-m-d") . "'
        AND PI.end_date >= '" . date("Y-m-d") . "';";
    $result = run_sql($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $start_date = $row["start_date"];
      $end_date = $row["end_date"];
    } else {
      //echo "In-between Program Increments";
    }
    $result->close();
  }

  if (isset($_POST['current-sequence'])) {
    $sequence = $_POST['current-sequence'];

  }

  if (isset($_POST['showNext'])) {
    $sequence++;
    $sql = "SELECT program_increment, iteration, sequence
            FROM `cadence`
            WHERE sequence='".$sequence."';";
    $result = run_sql($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $program_increment = $row["program_increment"];
      $iteration = $row["iteration"];
      $sequence = $row["sequence"];
      $result->close();
    }
  }

  $sql5 = "SELECT * FROM `cadence` WHERE program_increment='".$program_increment."';";
  $result5 = run_sql($sql5);
  if ($result5->num_rows > 0) {
      $row5 = $result5->fetch_assoc();
      $duration = $row5["duration"];
  }
  $sql6 = "SELECT * FROM `preferences` WHERE name='OVERHEAD_PERCENTAGE';";
  $result6 = run_sql($sql6);
  if ($result6->num_rows > 0) {
      $row6 = $result6->fetch_assoc();
      $overhead_percentage = $row6["value"];
  }

  if (isset($_POST['select-team'])) {
    $selected_team = $_POST['select-team'];
  } else {
    $sql = "SELECT team_id FROM `capacity` where program_increment='".$program_increment."' LIMIT 1;";
    $result = run_sql($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $selected_team = $row["team_id"];
    }
  }

  if (isset($_POST['current-team-selected'])) {
    $selected_team = $_POST['current-team-selected'];

  }

  if (isset($_POST['submit'])) {
    $iterationcapacity = 0;
    for ($x=0; $x < count($_POST['rownum']); $x++){
      $teamcapacity[$x] = round(($duration-$_POST['daysoff'][$x])*((100-$overhead_percentage)/100)*($_POST['velocity'][$x]/100));
      $iterationcapacity += $teamcapacity[$x];
      $daysoff[$_POST['rownum'][$x]] = $_POST['daysoff'][$x];
    }
    $sqliter = "UPDATE `capacity` SET iteration_".substr($iteration, -1)."='".$iterationcapacity."' WHERE program_increment='".$program_increment."' AND team_id='".$selected_team."';";
    $result_iter = run_sql($sqliter);
    $sqlinc = "SELECT (iteration_1 + iteration_2 + iteration_3 + iteration_4 + iteration_5 + iteration_6) as new_total FROM `capacity` WHERE program_increment='".$program_increment."' AND team_id='".$selected_team."';";
    $result_inc = run_sql($sqlinc);
    if ($result_inc->num_rows > 0) {
        $rowinc = $result_inc->fetch_assoc();
        $pi_capacity = $rowinc["new_total"];
      }
    $sqlup = "UPDATE `capacity` SET total='$pi_capacity' WHERE program_increment='".$program_increment."' AND team_id='".$selected_team."';";
    $result_up = run_sql($sqlup);
  }

  if (isset($_POST['rownum']) && isset($_POST['rownum'])) {
    $iterationcapacity = 0;
    for ($x=0; $x < count($_POST['rownum']); $x++){
      $teamcapacity[$x] = round(($duration-$_POST['daysoff'][$x])*((100-$overhead_percentage)/100)*($_POST['velocity'][$x]/100));
      $iterationcapacity += $teamcapacity[$x];
      $daysoff[$_POST['rownum'][$x]] = $_POST['daysoff'][$x];
    }
    $sqliter = "UPDATE `capacity` SET iteration_".substr($iteration, -1)."='".$iterationcapacity."' WHERE program_increment='".$program_increment."' AND team_id='".$selected_team."';";
    $result_iter = run_sql($sqliter);
    $sqlinc = "SELECT (iteration_1 + iteration_2 + iteration_3 + iteration_4 + iteration_5 + iteration_6) as new_total FROM `capacity` WHERE program_increment='".$program_increment."' AND team_id='".$selected_team."';";
    $result_inc = run_sql($sqlinc);
    if ($result_inc->num_rows > 0) {
        $rowinc = $result_inc->fetch_assoc();
        $pi_capacity = $rowinc["new_total"];
      }
    $sqlup = "UPDATE `capacity` SET total='$pi_capacity' WHERE program_increment='".$program_increment."' AND team_id='".$selected_team."';";
    $result_up = run_sql($sqlup);
  }

  ?>

<div class="right-content">
    <div class="container">

      <h3 style=" color: #01B0F1; font-weight: bold;">Capacity Calculations for the Agile Team</h3>

      <table width="95%">
        <tr>
          <td width="25%" style="vertical-align: top; font-weight: bold; color: #01B0F1; line-height: 130%; font-size: 18px;">
            <form method="post" action="#">
            Team: &emsp; <br/>
            Program Increment (PI): &emsp; <br/>
            Iteration (I): &emsp; <br/>
            No. of Days in the Iteration: &emsp; <br/>
            Overhead Percentage: &emsp; <br/>
          </td>
          <td  style="vertical-align: top; font-weight: bold; line-height: 130%;  font-size: 18px;" width="25%">
            <select name="select-team" onchange="this.form.submit()" style="border: 0; text-align: left;">
              <?php
              $sql = "SELECT team_id, team_name FROM `capacity` where program_increment='".$program_increment."';";
              $result = run_sql($sql);

              if ($result->num_rows > 0) {

                  while ($row = $result->fetch_assoc()) {

                    if ($selected_team == $row["team_id"]) {
                      echo '<option value="'.$row["team_id"].'" selected>('.$row["team_id"].': '.$row["team_name"].')</option>';
                    }else{
                      echo '<option value="'.$row["team_id"].'">('.$row["team_id"].': '.$row["team_name"].')</option>';
                    }

                  }
              }
              ?>
            </select>
          </form><br/>
          <?php
            echo "&nbsp;".$program_increment."<br/>";
            echo "&nbsp;".$iteration."<br/>";
            echo "&nbsp;".$duration."<br/>";
            echo "&nbsp;".$overhead_percentage."%<br/>";
          ?>
          </td>
          <td width="50%"  style="font-weight: bold;">
            <?php
            $sql = "SELECT * FROM `capacity` WHERE program_increment='".$program_increment."' AND team_id='".$selected_team."'";

            $result = run_sql($sql);


            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $icapacity = $row["iteration_".substr($iteration, -1)];
                $totalcapacity = $row["total"];
            }
             ?>
             <div style="float: right; margin-right: 10px; text-align: center; font-size: 12px;">
               <div id="capacity-calc-bignum"><?php echo $totalcapacity ?></div>
               Total Capacity for the Program Increment
             </div>
            <div style="float: right; margin-right: 10px; text-align: center; font-size: 12px;">
              <div id="capacity-calc-bignum"><?php echo $icapacity ?></div>
              Total Capacity for this Iteration
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="3">

        <form method="post" action="#">
      <table id="info" cellpadding="2px" cellspacing="0" border="0" class="capacity-table"
             width="100%" style="width: 100px; clear: both; font-size: 15px;">

          <thead>

          <tr id="capacity-table-first-row">

              <th id="capacity-table-td">Last Name</th>
              <th id="capacity-table-td">First Name</th>
              <th id="capacity-table-td">Role</th>
              <th id="capacity-table-td">% Velocity Available</th>
              <th id="capacity-table-td">Days Off <br/><p style="font-size: 9px;">(Vacation / Holidays / Sick Days)</p></th>
              <th id="capacity-table-td">Story Points</th>

          </tr>

          </thead>

          <tbody>


          <?php

          $sql = "SELECT last_name, first_name, role FROM `membership`
                  NATURAL JOIN `employees`
                  WHERE team_id='".$selected_team."';";

          $result = run_sql($sql);


          if ($result->num_rows > 0) {

              // output data of each
              $rownum = 0;
              while ($row = $result->fetch_assoc()) {

                if ($row["role"] == "Scrum Master (SM)") {
                  $velocityType = "SCRUM_MASTER_ALLOCATION";
                } else if ($row["role"] == "Product Owner (PO)") {
                  $velocityType = "PRODUCT_OWNER_ALLOCATION";
                } else  {
                  $velocityType = "AGILE_TEAM_MEMBER_ALLOCATION";
                }

                $sql2 = "SELECT * FROM `preferences` WHERE name='".$velocityType."';";
                $result2 = run_sql($sql2);

                if ($result2->num_rows > 0) {

                    $row2 = $result2->fetch_assoc();

                }
                if (isset($teamcapacity[$rownum])){
                  $storypts = $teamcapacity[$rownum];
                }else{
                  $storypts = round(($duration-0)*((100-$overhead_percentage)/100)*($row2["value"]/100));
                }
                if (isset($daysoff[$rownum])){
                  $doff = $daysoff[$rownum];
                } else {
                  $doff = 0;
                }

                  echo
                  "<tr>
                      <td id='capacity-table-td' style='font-weight:500;'>" . $row["last_name"] . "</td>
                      <td id='capacity-table-td' style='font-weight:500;'>" . $row["first_name"] . "</td>
                      <td id='capacity-table-td' style='font-weight:500;'>" . $row["role"] . "</td>
                      <td id='capacity-table-td' style='font-weight:500; text-align: center;'><input onchange='this.form.submit()' class='capacity-text-input' type='text' name='velocity[]' value='" . $row2["value"] . "' /> %</td>
                      <td id='capacity-table-td' style='font-weight:500; text-align: center;'><input onchange='this.form.submit()' class='capacity-text-input' type='text' name='daysoff[]' value='".$doff."' /></td>
                      <td id='capacity-table-td' style='font-weight:500; text-align: center; background: #e9e9e9;'>".$storypts."&nbsp;pts</td>
                      <input type='hidden' name='rownum[]' value='".$rownum."'/>
                  </tr>";
                  $rownum++;
              }
          } else {
              echo "0 results";
          }

          $result->close();

          // *** delete button functionality ***
    /*
          if (isset($_GET['id'])) {
              if ($_GET['button'] == 'delete') {
                  $id = $_GET['id'];

                  $sql = 'DELETE FROM characters WHERE word_id=' . $id . ';';
                  $result = $db->query($sql);

                  $sql = 'DELETE FROM words WHERE word_id=' . $id . ';';
                  $result = $db->query($sql);

                  echo ' <script> alert(\'Record has been successfully deleted!!\'); window.location.replace("list.php"); </script>';
              }
          }

          if (isset($_POST['submit'])) {
              $inputFileName = $_FILES["fileToUpload"]["tmp_name"];
              $target_dir = "./Images/";
              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
              $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
              $imageName = basename($_FILES["fileToUpload"]["name"]);
              copy($inputFileName, $target_file);
              $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
              if ($check !== false) {
                  $sql = 'UPDATE words SET image=\'' . $imageName . '\' WHERE word_id=' . $_POST['word_id'] . '';
                  $result = run_sql($sql);
                  echo ' <script> alert(\'Image Upload Successful!!\'); window.location.replace("list.php"); </script>';
              } else {
                  echo ' <script> alert(\'Image is not valid!\');</script>';
              }
          }*/
          ?>

          <!--<script>
              function validateForm() {
                  var eng = document.forms["importFrom"]["fileToUpload"].value;
                  if (eng == "") {

                      document.getElementById("error").style = "display:block;background-color: #ce4646;padding:5px;color:#fff;";
                      return false;
                  }
              }

          </script>-->

          </tbody>

          <tfoot>

          </tfoot>

      </table>
      <input type="submit" id="capacity-button-blue" name="submit" value="Submit">
      <input type="submit" id="capacity-button-blue" name="restore" value="Restore Defaults">
      <input type="submit" id="capacity-button-blue" name="showNext" value="Show Next Iteration">
        <input type="hidden" name="current-team-selected" value="<?php echo $selected_team; ?>">
        <input type="hidden" name="current-sequence" value="<?php echo $sequence; ?>">
      </form>

      <div id="capacity-footnote">
        Note 1: Closed Iterations will NOT be shown.  The capacity cannot be changed for such iterations.  Show only the active iterations.<br/>
        Note 2: This page can be reached in two ways:
        <ul>
          <li>Capacity > Calculate</li>
          <li>Capacity > Summary > By clicking on one of the numbers</li>
        </ul>
      </div>

      </td>
      </tr>
      </table>

    </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            $('#info').DataTable({
                paging: false,
                searching: false,
                infoCallback: false
            });

        });

    </script>

<?php include("./footer.php"); ?>
