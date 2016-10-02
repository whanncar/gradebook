<?php

  session_start();

  include("php/utils.php");

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

    <form action="print_student_report.php" method="POST">

      <select name="student_id_for_report">

        <?php

          $student_list = get_student_list();

          for ($i = 0; $i < count($student_list); $i++) {
            echo "<option value=\"{$student_list[$i]["student_id"]}\">" .
                 "{$student_list[$i]["first_name"]} " .
                 "{$student_list[$i]["last_name"]}" .
                 "</option>";
          }

        ?>

      </select>

      <input type="submit" name="print_report_button" value="Print report"/>

    </form>

    <br>

    <form action="print_all_student_reports.php" method="POST">

      <input type="submit" name="print_all_reports_button" value="Print all reports">

    </form>

  </body>

</html>
