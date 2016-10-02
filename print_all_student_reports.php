<?php

  require("fpdf/fpdf.php");

  include("php/utils.php");

  $pdf = new FPDF();


/* Get student data */
  $student_list = get_student_list();

for ($s = 0; $s < count($student_list); $s++) {

  $pdf->AddPage();

  $student_data = $student_list[$s];

  $student_id = $student_data["student_id"];

  $pdf->SetFont('Arial', '', 16);
  $pdf->Cell(40, 10, $student_data["first_name"] . " " . $student_data["last_name"]);
  $pdf->Ln();

/* Get grades */

  $assignment_group_list = get_assignment_group_list();
  $assignment_list = get_assignment_list();

  for ($i = 0; $i < count($assignment_group_list); $i++) {
    $group_name = $assignment_group_list[$i]["group_name"];
    $group_id = $assignment_group_list[$i]["group_id"];
    $pdf->SetFont('Arial', 'U', 12);
    $pdf->Cell(40, 10, $group_name);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 10);
    for ($j = 0; $j < count($assignment_list); $j++) {
      if ($assignment_list[$j]["group_id"] != $group_id) {
        continue;
      }
      $assignment_name = $assignment_list[$j]["assignment_name"];
      $assignment_id = $assignment_list[$j]["assignment_id"];
      $grade = get_grade($student_id, $assignment_id);
      $pdf->Cell(150, 10, $assignment_name, 1);
      $pdf->Cell(25, 10, $grade, 1);
      $pdf->Ln();
    }
  }
}

  $pdf->Output();


?>
