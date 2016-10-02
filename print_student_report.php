<?php

  session_start();

  require("fpdf/fpdf.php");

  include("php/utils.php");

  $pdf = new FPDF();
  $pdf->AddPage();

/* Get student data */

  $student_id = $_POST["student_id_for_report"];

  $student_list = get_student_list();

  for ($i = 0; $i < count($student_list); $i++) {
    if ($student_list[$i]["student_id"] == $student_id) {
      $student_data = $student_list[$i];
      break;
    }
  }

  $pdf->SetFont('Arial', '', 16);
  $pdf->Cell(2, 15, "", 0);
  $pdf->Ln();
  $pdf->Cell(40, 10, $student_data["first_name"] . " " . $student_data["last_name"]);
  $pdf->Ln();
  $pdf->Ln();


/* Get grades */

  $assignment_group_list = get_assignment_group_list();
  $assignment_list = get_assignment_list();

  $overall_grade = 0;
  $overall_relevant_weight = 0;

  for ($i = 0; $i < count($assignment_group_list); $i++) {
    $percentage = $assignment_group_list[$i]["group_weight"] * 100;
    $group_name = $assignment_group_list[$i]["group_name"];
    $group_id = $assignment_group_list[$i]["group_id"];
    $pdf->SetFont('Arial', 'U', 12);
    $pdf->Cell(40, 10, $group_name . " (" . number_format($percentage, 0) . "%)");
    $pdf->Ln();

    $average = 0;
    $count = 0;

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
      $average += $grade;
      $count++;
    }

    if ($count != 0) {
      $average /= $count;
      $overall_grade += $average * $percentage / 100;
      $overall_relevant_weight += $percentage / 100;
    }

    $pdf->Cell(100, 10, "", 0);
    $pdf->Cell(50, 10, "Average: ", 0);
    $pdf->Cell(25, 10, number_format($average, 2), 0);
    $pdf->Ln();
  }

  $pdf->Ln();
  $pdf->Ln();
  $pdf->Ln();

  $pdf->SetFont('Arial', 'B', 14);

  $pdf->Cell(100, 10, "", 0);
  $pdf->Cell(50, 10, "Current grade: ", 0);
  $pdf->Cell(25, 10, number_format($overall_grade, 2), 0);

  $pdf->Output();


?>
