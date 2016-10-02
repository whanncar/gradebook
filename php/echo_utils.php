<?php

include("utils.php");


function echo_roster_table() {

  $student_list = get_student_list();

  echo "<table border=\"1\">";

  echo "<tr><td></td><td>First name</td><td>Last name</td></tr>";

  for ($i = 0; $i < count($student_list); $i++) {
    echo "<tr>";
    echo "<td><input type=\"checkbox\" name=\"{$student_list[$i]["student_id"]}\" value=\"on\"/></td>";
    echo "<td>" . $student_list[$i]["first_name"] . "</td>";
    echo "<td>" . $student_list[$i]["last_name"] . "</td>";
    echo "</tr>";
  }

  echo "</table>";
}


function echo_assignment_group_table() {

  $assignment_group_list = get_assignment_group_list();

  echo "<table border=\"1\">";

  echo "<tr><td>Assignment group name</td><td>Assignment group weight</td></tr>";

  for ($i = 0; $i < count($assignment_group_list); $i++) {
    echo "<tr>";
    echo "<td>" . $assignment_group_list[$i]["group_name"] . "</td>";
    echo "<td>" . $assignment_group_list[$i]["group_weight"] . "</td>";
    echo "</tr>";
  }

  echo "</table>";
}


function echo_assignment_table() {

  $assignment_list = get_assignment_list_with_group_names();

  echo "<table border=\"1\">";

  echo "<tr><td>Assignment name</td><td>Assignment group</td></tr>";

  for ($i = 0; $i < count($assignment_list); $i++) {
    echo "<tr>";
    echo "<td>" . $assignment_list[$i]["assignment_name"] . "</td>";
    echo "<td>" . $assignment_list[$i]["group_name"] . "</td>";
    echo "</tr>";
  }

  echo "</table>";
}


function echo_assignment_group_dropdown() {

  $assignment_group_list = get_assignment_group_list();

  echo "<select name=\"new_assignment_group\">";

  for ($i = 0; $i < count($assignment_group_list); $i++) {
    $group_id = $assignment_group_list[$i]["group_id"];
    $group_name = $assignment_group_list[$i]["group_name"];
    echo "<option value=\"$group_id\">$group_name</option>";
  }

  echo "</select>";
}


function echo_assignment_dropdown() {

  $assignment_list = get_assignment_list();

  echo "<select name=\"assignment_id_to_edit\" onchange=\"this.form.submit()\">";

  for ($i = 0; $i < count($assignment_list); $i++) {
    $assignment_name = $assignment_list[$i]["assignment_name"];
    $assignment_id = $assignment_list[$i]["assignment_id"];
    $selected_mask = "";
    if ($_SESSION["assignment_id_to_edit"] == $assignment_id) {
      $selected_mask = "selected";
    }
    echo "<option value=\"$assignment_id\" $selected_mask>$assignment_name</option>";
  }

  echo "</select>";

}


function echo_assignment_grade_edit_table($assignment_id) {

  $assignment_data = get_assignment_data($assignment_id);

  echo "<table border=\"1\">";

  echo "<tr><td>Student</td><td>Grade</td></tr>";

  for ($i = 0; $i < count($assignment_data); $i++) {
    $student_name = $assignment_data[$i]["first_name"] . " " . $assignment_data[$i]["last_name"];
    $student_id = $assignment_data[$i]["student_id"];
    $grade = $assignment_data[$i]["grade"];
    echo "<tr>";
    echo "<td>$student_name</td>";
    echo "<td><input type=\"text\" size=\"4\" name=\"$student_id\" value=\"$grade\"/></td>";
    echo "</tr>";
  }

  echo "</table>";
}


function echo_search_results($search_string) {

  $results = get_search_results($search_string);

  for ($i = 0; $i < count($results); $i++) {
    echo $results[$i] . "<br>";
  }
}


?>




















