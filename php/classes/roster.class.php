<?php

  class roster {

    $student_list;

    function add_student($s) {
      $index = count($this->student_list);
      $this->student_list[$index] = $s;
    }

  }

  

?>
