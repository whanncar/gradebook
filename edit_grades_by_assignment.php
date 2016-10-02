<?php

  session_start();

  if (!isset($_SESSION["assignment_id_to_edit"])) {
    $_SESSION["assignment_id_to_edit"] = "unselected";
  }

  if (isset($_POST["assignment_id_to_edit"])) {
    $_SESSION["assignment_id_to_edit"] = $_POST["assignment_id_to_edit"];
  }

  include("php/echo_utils.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST" &&
      isset($_POST["edit_form"])) {

    $student_list = get_student_list();

    for ($i = 0; $i < count($student_list); $i++) {
      $student_id = $student_list[$i]["student_id"];
      if (isset($_POST[$student_id])) {
        set_grade($student_id, $_SESSION["assignment_id_to_edit"], $_POST[$student_id]);
      }
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

    <form action="edit_grades_by_assignment.php" method="POST">

      <?php echo_assignment_dropdown(); ?>

    </form>

    <form action="edit_grades_by_assignment.php" method="POST">

      <?php

        if ($_SESSION["assignment_id_to_edit"] != "unselected") {
          echo_assignment_grade_edit_table($_SESSION["assignment_id_to_edit"]);
          echo "<input type=\"submit\" name=\"save_button\" value=\"Save\"/>"; 
        }

      ?>

      <input type="hidden" name="edit_form" value=""/>

    </form>

  </body>

</html>
