<?php
$mysqli = new mysqli("localhost", "root", "rootroot", "assignmentDB");

/* check connection */
if ($mysqli->connect_errno) {

    echo "Connect failed " . $mysqli->connect_error;

    exit();
}

$query = "SELECT * FROM student";

$studentArray = array();

if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {

        array_push($studentArray, $row);
    }

    if (count($studentArray)) {

        createXMLfile($studentArray);
    }

    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();


function createXMLfile($studentArray)
{

    $filePath = 'student.xml';

    $dom     = new DOMDocument('1.0', 'utf-8');

    $root      = $dom->createElement('student');

    for ($i = 0; $i < count($studentArray); $i++) {

        $studentId        =  $studentArray[$i]['id'];

        $studentName      =   $studentArray[$i]['name'];

        $studentRollNo    =  $studentArray[$i]['rollno'];

        $studentMarks     =  $studentArray[$i]['marks'];

        $student = $dom->createElement('student');

        $student->setAttribute('id', $studentId);

        $name     = $dom->createElement('id', $studentId);

        $student->appendChild($name);

        $name   = $dom->createElement('name', $studentName);

        $student->appendChild($name);

        $rollno    = $dom->createElement('rollno', $studentRollNo);

        $student->appendChild($rollno);

        $marks     = $dom->createElement('marks', $studentMarks);

        $student->appendChild($marks);

        $root->appendChild($student);
    }

    $dom->appendChild($root);

    $dom->save($filePath);
}
