<?php

// Firstly, I need to make sure that the request method is correct
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // make sure that the values from user are not empty
    if (empty($_POST["studentName"]) || empty($_POST["studentID"]) || empty($_POST["studentGrade"])) {
        echo "All fields are required";
    }
    else{
        // else means that all the values are not empty
        // we will validate the student name
        // first parameter I need letter from A to Z or a to z
        if (!preg_match("/^[a-zA-Z\s]*$/", $_POST["studentName"])) {
            echo " Student name should only be in characters";
            exit();
        } else {
            $studentName = $_POST["studentName"];
        }

        // Validate student ID (only numbers, length = 8)
        if (!preg_match("/^[0-9]{8}$/", $_POST["studentID"])) {
            echo "Student ID should contain only 8 numbers";
            exit();
        } else {
            $studentID = $_POST["studentID"];
        }

        // Validate the student grade
        if (!preg_match("/^[0-9]+$/", $_POST["studentGrade"]) || $_POST["studentGrade"] < 0 || $_POST["studentGrade"] > 100) {
            echo "Student grade should be a number between 0 and 100";
            exit();
        } else {
            $studentGrade = $_POST["studentGrade"];
        }

        // Now after php has done all the validations, we will send the saved values to my database

        // We will build a connection between PHP and my database

        $conn = new mysqli("localhost", "root", "", "College");

        // make sure that connection is built :
        if ($conn->connect_error) {
            die (" Connection failed : " . $conn->connect_error);
        }
        // write a query to insert the values:
        $sql = "INSERT INTO student_result( studentName, studentID, studentGrade) VALUES ('$studentName','$studentID','$studentGrade')";

        // We need to run / execute the query:
        // we use query function query($sql)

        $results = $conn->query($sql);

        // now my query is executed.
        // we will check that it was successfully executed

        if ($results == TRUE) {
            echo "Your data is stored successfully in the college database.<br><br>";
        } else {

            echo "You got error" . $sql . $conn->error;
        }

        if($studentGrade > 50){
            echo "Congratulations!!<br>";
            echo "The student $studentName of ID = $studentID has passed";
        }
        else{
            echo "The student $studentName of ID = $studentID has not passed";
        }

        $conn->close();

        // -> connect_error : this will show me errors in my connection
        // -> error : this will show me errors in my query execution
    }
}
else {
    // if the request method is not POST
    echo "Invalid request method";
}