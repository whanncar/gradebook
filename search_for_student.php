<?php

  session_start();

  include("php/echo_utils.php");

?>

<html>

  <body>

    <form action="search_for_student.php" method="POST">

      Name:<br>
      <input type="text" name="student_query" value=""/>
      <input type="submit" name="search_button" value="Search"/>
      <input type="hidden" name="student_search_form" value=""/>

    </form>

    <br>

    <?php

      if ($_SERVER["REQUEST_METHOD"] == "POST" &&
          isset($_POST["student_search_form"])) {

        unset($_POST["student_search_form"]);
        echo "<u>Results</u><br><br>";
        echo_search_results($_POST["student_query"]);
      }

    ?>

  </body>

</html>
