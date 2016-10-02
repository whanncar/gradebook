<?php

  session_start();

  include("php/utils.php");

  function echo_options() {

    $contents = file_get_contents($_FILES['csv_gradebook']['tmp_name']); 

    $rows = explode("\n", $contents);

    $column_names = explode(",", $rows[0]);

    $index = 0;

    $quotes_on = 0;

    for ($i = 0; $i < count($column_names); $i++) {
      if (substr($column_names[$i], 0, 1) == "\"") {
        $quotes_on = 1;
        $fixed_column_names[$index] = substr($column_names[$i], 1);
      }
      else if ($quotes_on) {
        $fixed_column_names[$index] = $fixed_column_names[$index] . "," . $column_names[$i];
        if (substr($column_names[$i], strlen($column_names[$i]) - 1) == "\"") {
          $quotes_on = 0;
          $fixed_column_names[$index] = substr($fixed_column_names[$index], 0, strlen($fixed_column_names[$index])-1);
          $index++;
        }
      }
      else {
        $fixed_column_names[$index] = $column_names[$i];
        $index++;
      }
    }

    $column_names = $fixed_column_names;

    $assignment_group_list = get_assignment_group_list();

    for ($i = 1; $i < count($column_names); $i++) {
      echo "<input type=\"checkbox\" checked/>";
      echo $column_names[$i];
      echo "<select name=\"banana\">";
      for ($j = 0; $j < count($assignment_group_list); $j++) {
        $group = $assignment_group_list[$j];
        echo "<option name=\"{$group["group_id"]}\">" . $assignment_group_list[$j]["group_name"] . "</option>";
      } 
      echo "</select><br>";
    }
  }

  function add_names() {

    $contents = file_get_contents($_FILES['csv_gradebook']['tmp_name']);

    $rows = explode("\n", $contents);

    for ($i = 1; $i < count($rows); $i++) {
      preg_match("/\"([\s\S]*)\"/", $rows[$i], $matches);
      $student_name = $matches[1];
      $name_in_parts = explode(",", $student_name);
      $last_name = $name_in_parts[0];
      $first_name = $name_in_parts[1];
      if ($first_name != "" && $last_name != "") {
        add_student($first_name, $last_name);
      }
    }

  }

?>


<html>

  <body>

    <form action="uploader.php" method="POST" enctype="multipart/form-data">

      <input type="file" name="csv_gradebook"/>
      <input type="submit" name="upload_button" value="Upload"/>
      <input type="hidden" name="upload_form" value=""/>

    </form>

    <form action="" method="POST">

      <?php

        if (isset($_POST["upload_form"])) {
          echo_options();
          add_names();
        }

      ?>

      <input type="submit" name="submit_button" value="Submit"/>

    </form>

  </body>

</html>
