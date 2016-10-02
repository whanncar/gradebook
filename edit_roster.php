<?php

session_start();

include("php/echo_utils.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["add_student_form"])) {
    add_student($_POST["new_student_first_name"], $_POST["new_student_last_name"]);
    unset($_POST["add_student_form"]);
    unset($_POST["new_student_first_name"]);
    unset($_POST["new_student_last_name"]);
  }
  if (isset($_POST["delete_student_form"])) {
    $student_list = get_student_list();
    for ($i = 0; $i < count($student_list); $i++) {
      if ($_POST[$student_list[$i]["student_id"]] == "on") {
        delete_student($student_list[$i]["student_id"]);
      }
      unset($_POST[$student_list[$i]["student_id"]]);
    }
    unset($_POST["delete_student_form"]);
  }
}

?>

<html>

  <head>

    <title>
      Maegan's Gradebook
    </title>

    <table border="0"><tr>
        <td><a href="edit_roster.php">Students</a></td><td width="50"/>
        <td><a href="edit_assignment_groups.php">Assignment groups</a></td><td width="50"/>
        <td><a href="edit_assignments.php">Assignments</a></td><td width="50"/>
        <td><a href="edit_grades_by_assignment.php">Grades</a></td><td width="50"/>
        <td><a href="create_student_report.php">Reports</a></td><td width="50"/>
      </tr>
    </table>

  </head>

  <body>

    <form action="edit_roster.php" method="POST">

      <?php echo_roster_table(); ?><br>
      <input type="submit" name="delete_student_button" value="Delete selected"/>
      <input type="hidden" name="delete_student_form" value=""/>

    </form>

    <form action="edit_roster.php" method="POST">

      First name<input type="text" name="new_student_first_name" value=""/><br>
      Last name<input type="text" name="new_student_last_name" value=""/><br>

      <input type="submit" name="edit_button" value="Add new student"/>

      <input type="hidden" name="add_student_form" value=""/>

    </form>

  </body>

</html>
