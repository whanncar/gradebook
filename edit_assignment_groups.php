<?php

session_start();

include("php/echo_utils.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["new_group_form"])) {
    add_assignment_group($_POST["new_group_name"], $_POST["new_group_weight"]);
    unset($_POST["new_group_form"]);
    unset($_POST["new_group_name"]);
    unset($_POST["new_group_weight"]);
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

    <?php echo_assignment_group_table(); ?><br>

    <form action="edit_assignment_groups.php" method="POST">

      Group name<input type="text" name="new_group_name" value=""/><br>
      Group weight<input type="text" name="new_group_weight" value=""/><br>
      <input type="submit" name="new_group_button" value="Add new group"/>
      <input type="hidden" name="new_group_form" value=""/>

    </form>

  </body>

</html>
