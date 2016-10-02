<?php

$db_connection;

function connect_to_db() {

  global $db_connection;

  $dbhost = 'localhost';
  $dbuser = 'admin';
  $dbpass = 'password';

  $db_connection = mysql_connect($dbhost, $dbuser, $dbpass);
  mysql_select_db("gradebook_data");
}


function disconnect_from_db() {
  global $db_connection;
  mysql_close($db_connection);
}


function add_student_to_db($first_name, $last_name) {


  connect_to_db();

  mysql_query("INSERT INTO students (first_name, last_name) " .
              "VALUES (\"$first_name\", \"$last_name\");");

  $query = mysql_query("SELECT * FROM students WHERE first_name=\"$first_name\" AND last_name=\"$last_name\";");

  $row = mysql_fetch_assoc($query);

  $student_id = $row["student_id"];

  disconnect_from_db();

  return $student_id;
}


function student_exists_in_db($first_name, $last_name) {

  connect_to_db();

  $query = mysql_query("SELECT * FROM students WHERE first_name=\"$first_name\"" .
                       "AND last_name=\"$last_name\";");

  $exists = 0;

  if (mysql_fetch_assoc($query)) {
    $exists = 1;
  }

  disconnect_from_db();

  return $exists;

}

function add_assignment_group_to_db($group_name, $weight) {

  connect_to_db();

  $query = mysql_query("SELECT * FROM assignment_groups WHERE "
                       . "group_name=\"$group_name\";");

  if (!mysql_fetch_assoc($query)) {
    mysql_query("INSERT INTO assignment_groups (group_name, group_weight) "
                . "VALUES (\"$group_name\", $weight);");
  }

  disconnect_from_db();
}


function add_assignment_to_db($group_id, $assignment_name) {

  $assignment_id;
  $row;

  connect_to_db();

  mysql_query("INSERT INTO assignments (assignment_name, group_id) " .
              "VALUES (\"$assignment_name\", $group_id);");
  
  $query = mysql_query("SELECT * FROM assignments " .
                       "WHERE assignment_name=\"$assignment_name\" " .
                       "AND group_id=$group_id;");

  $row = mysql_fetch_assoc($query);

  $assignment_id = $row["assignment_id"];

  disconnect_from_db();

  return $assignment_id;
}


function set_grade_in_db($student_id, $assignment_id, $grade) {

  connect_to_db();

  $query = mysql_query("SELECT * FROM grades WHERE " .
                       "student_id=$student_id AND " .
                       "assignment_id=$assignment_id;");

  if (!mysql_fetch_assoc($query)) {
    mysql_query("INSERT INTO grades (student_id, assignment_id, grade) " .
                "VALUES ($student_id, $assignment_id, $grade);");
  }
  else {
    mysql_query("UPDATE grades SET grade=$grade " .
                "WHERE student_id=$student_id " .
                "AND assignment_id=$assignment_id;");
  }

  disconnect_from_db();
}


function get_assignment_list_from_db() {

  $list;

  connect_to_db();

  $query = mysql_query("SELECT * FROM assignments;");

  $i = 0;

  while ($row = mysql_fetch_assoc($query)) {
    $list[$i] = $row;
    $i++;
  }

  disconnect_from_db();
  
  return $list;
}


function get_assignment_list_with_group_names_from_db() {

  connect_to_db();

  $query = mysql_query("SELECT * FROM assignments a, assignment_groups b " .
                       "WHERE a.group_id=b.group_id;");

  $i = 0;

  while ($row = mysql_fetch_assoc($query)) {
    $list[$i] = $row;
    $i++;
  }

  disconnect_from_db();

  return $list;
}



function get_student_list_from_db() {

  connect_to_db();

  $query = mysql_query("SELECT * FROM students;");

  $i = 0;

  while ($row = mysql_fetch_assoc($query)) {
    $list[$i] = $row;
    $i++;
  }

  disconnect_from_db();

  return $list;
}


function get_assignment_group_list_from_db() {

  connect_to_db();

  $query = mysql_query("SELECT * FROM assignment_groups;");

  $i = 0;

  while ($row = mysql_fetch_assoc($query)) {
    $list[$i] = $row;
    $i++;
  }

  disconnect_from_db();

  return $list;
}


function get_assignment_data_from_db($assignment_id) {

  connect_to_db();

  $query = mysql_query("SELECT * FROM grades g, assignments a, students s " .
                       "WHERE g.assignment_id=$assignment_id " .
                       "AND a.assignment_id=g.assignment_id " .
                       "AND s.student_id=g.student_id;");

  $i = 0;

  while ($row = mysql_fetch_assoc($query)) {
    $list[$i] = $row;
    $i++;
  }

  disconnect_from_db();

  return $list;
}


function get_grade_from_db($student_id, $assignment_id) {

  connect_to_db();

  $query = mysql_query("SELECT * FROM grades WHERE " .
                       "assignment_id=$assignment_id AND student_id=$student_id;");

  $row = mysql_fetch_assoc($query);

  $grade = $row["grade"];

  disconnect_from_db();

  return $grade;
}


function delete_student_from_db($student_id) {

  connect_to_db();

  mysql_query("DELETE FROM students WHERE student_id=$student_id;");

  mysql_query("DELETE FROM grades WHERE student_id=$student_id;");

  disconnect_from_db();
}

?>
















