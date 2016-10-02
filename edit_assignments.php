<?php

  session_start();

  include("php/echo_utils.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["new_assignment_form"])) {
      add_assignment($_POST["new_assignment_group"], $_POST["new_assignment_name"]);
      unset($_POST["new_assignment_form"]);
      unset($_POST["new_assignment_group"]);
      unset($_POST["new_assignment_name"]);
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

    <?php echo_assignment_table(); ?>

    <form action="edit_assignments.php" method="POST">

      Assignment name<input type="text" name="new_assignment_name" value=""/><br>
      Assignment group<?php echo_assignment_group_dropdown(); ?>
      <input type="submit" name="new_assignment_button" value="Add new assignment"/>
      <input type="hidden" name="new_assignment_form" value=""/>

    </form>

  <body>

</html>
