<?php

  $nav_selected = "TRAINS"; // set the current page; options: TRAINS, ORG, CAPACITY, TRAINING, REPORTS, SETUP, LOGIN, HELP, SEARCH
  $left_buttons = "YES"; // make the left menu buttons visible; options: YES, NO
  $left_selected = "LISTS"; // set the left menu button selected; options: LIST, LISTS, GRID, TREE, HYBRID // IGNORE IF left_buttons==NO

  include("./nav.php"); ?>

<div class="right-content">
    <div class="container">

      <h3><img src="images/solution_train.png" style="max-height: 35px;" /> Solution Trains (ST)</h3>

      <table id="info" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered datatable-style"
             width="100%" style="width: 100px;">

          <thead>

          <tr id="table-first-row">

              <th>Name</th>
              <th>Type</th>
              <th>Team ID</th>
              <th>Parent</th>

          </tr>

          </thead>

          <tbody>


          <?php

          $sql = "SELECT * FROM trains_and_teams WHERE type='ST'";

          $result = run_sql($sql);


          if ($result->num_rows > 0) {

              // output data of each

              while ($row = $result->fetch_assoc()) {



                  echo
                  "<tr>
                      <td>" . $row["name"] . "</td>
                      <td>" . $row["type"] . "</td>
                      <td>" . $row["team_id"] . "</td>
                      <td>" . $row["parent"] . "</td>
                  </tr>";
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

</div>
<br/>
<div class="container">

        <h3><img src="images/image17.png" style="max-height: 35px;" /> Agile Release Trains (ART)</h3>

        <table id="info2" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered datatable-style"
               width="100%" style="width: 100px;">

            <thead>

            <tr id="table-first-row">

                <th>Name</th>
                <th>Type</th>
                <th>Team ID</th>
                <th>Parent</th>

            </tr>

            </thead>

            <tbody>


            <?php

            $sql = "SELECT * FROM trains_and_teams WHERE type='ART'";

            $result = run_sql($sql);


            if ($result->num_rows > 0) {

                // output data of each

                while ($row = $result->fetch_assoc()) {



                    echo
                    "<tr>
                        <td>" . $row["name"] . "</td>
            						<td>" . $row["type"] . "</td>
            						<td>" . $row["team_id"] . "</td>
                        <td>" . $row["parent"] . "</td>
                    </tr>";
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

</div>
<br/>
<div class="container">

        <h3><img src="images/image20.png" style="max-height: 35px;" /> Agile Teams (AT)</h3>

        <table id="info3" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered datatable-style"
               width="100%" style="width: 100px;">

            <thead>

            <tr id="table-first-row">

                <th>Name</th>
                <th>Type</th>
                <th>Team ID</th>
                <th>Parent</th>

            </tr>

            </thead>

            <tbody>


            <?php

            $sql = "SELECT * FROM trains_and_teams WHERE type='AT'";

            $result = run_sql($sql);


            if ($result->num_rows > 0) {

                // output data of each

                while ($row = $result->fetch_assoc()) {



                    echo
                    "<tr>
                        <td>" . $row["name"] . "</td>
            						<td>" . $row["type"] . "</td>
            						<td>" . $row["team_id"] . "</td>
                        <td>" . $row["parent"] . "</td>
                    </tr>";
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


    </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            $('#info').DataTable({

            });

        });
        $(document).ready(function () {

            $('#info2').DataTable({

            });

        });
        $(document).ready(function () {

            $('#info3').DataTable({

            });

        });

    </script>

<?php include("./footer.php"); ?>
