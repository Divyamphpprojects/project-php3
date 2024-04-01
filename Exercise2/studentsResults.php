<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // we will save each input from the user
    // as a variable ( in a condition)

    $studentName = $_POST['studentN'];
    $studentID = $_POST['studentID'];
    $studentGrade = $_POST['studentGrade'];

    if($studentGrade > 50){
        echo "The student $studentName of ID = $studentID has passed";
    }
    else{
        echo "The student $studentName of ID = $studentID has not passed";
    }

}
