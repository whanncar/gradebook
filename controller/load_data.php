<?php

  include("db.php");

  include("../model/assignment.class.php");
  include("../model/assignment_group.class.php");
  include("../model/grade.class.php");
  include("../model/student.class.php");


  function save_student_list($student_list) {

    connect_to_db();

    mysql_query("DELETE FROM students;");

    for ($i = 0; $i < count($student_list); $i++) {

      $stud = $student_list[$i];

      $id = $stud->student_id;
      $name = $stud->student_name;

      if ($id != -1) {

        mysql_query("INSERT INTO students " .
                    "(student_id, name) " .
                    "VALUES " .
                    "($id, \"$name\");");
      }

      else {

        mysql_query("INSERT INTO students " .
                    "(name) " .
                    "VALUES " .
                    "(\"$name\");");
      }

    }

    disconnect_from_db();
  }


  function load_student_list() {

    connect_to_db();


    $query = mysql_query("SELECT * FROM students;");

    $i = 0;

    while ($row = mysql_fetch_assoc($query)) {
      $student_list[$i] = new student($row["student_id"], $row["name"]);
    }

    disconnect_from_db();

    return $student_list;
  }




?>
