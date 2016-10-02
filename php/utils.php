<?php

include("db.php");


function add_student($first_name, $last_name) {

  if (student_exists_in_db($first_name, $last_name)) {
    return;
  }

  $student_id = add_student_to_db($first_name, $last_name);

  $assignment_list = get_assignment_list();

  for ($i = 0; $i < count($assignment_list); $i++) {
    set_grade($student_id, $assignment_list[$i]["assignment_id"], 0);
  } 
}


function add_assignment_group($group_name, $weight) {
  add_assignment_group_to_db($group_name, $weight);
}


function add_assignment($group_id, $assignment_name) {

  $assignment_id = add_assignment_to_db($group_id, $assignment_name);

  $student_list = get_student_list();

  for ($i = 0; $i < count($student_list); $i++) {
    set_grade($student_list[$i]["student_id"], $assignment_id, 0);
  } 
}


function set_grade($student_id, $assignment_id, $grade) {
  set_grade_in_db($student_id, $assignment_id, $grade);
}

function get_grade($student_id, $assignment_id) {
  return get_grade_from_db($student_id, $assignment_id);
}

function get_student_list() {
  return get_student_list_from_db();
}


function get_assignment_list() {
  return get_assignment_list_from_db();
}


function get_assignment_list_with_group_names() {
  return get_assignment_list_with_group_names_from_db();
}

function get_assignment_group_list() {
  return get_assignment_group_list_from_db();
}

function get_assignment_data($assignment_id) {
  return get_assignment_data_from_db($assignment_id);
}

function get_search_results($search_string) {

  $student_list = get_student_list();

  for ($i = 0; $i < count($student_list); $i++) {
    $student_name_list[$i] = $student_list[$i]["first_name"] . " " . $student_list[$i]["last_name"];
  }

  $j = 0;

  for ($i = 0; $i < count($student_name_list); $i++) {
    if (eregi($search_string, $student_name_list[$i])) {
      $matches[$j] = $student_name_list[$i];
      $j++;
    }
  }

  return $matches;
}

function delete_student($student_id) {
  delete_student_from_db($student_id);
}

?>
