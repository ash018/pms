<?php
	include("../../includes/functions/session.php");
        authonticate();
	include("../../includes/functions/db.php");
        
        $PatientID = $_POST['PatientID'];
	$PatientCode = $_POST['PatientCode'];
	$PatientName = $_POST['PatientName'];
	$DOB = $_POST['DOB'];
	$Sex = $_POST['Sex'];
	$ContactNo = $_POST['ContactNo'];
	$Address = $_POST['Address'];

	$sql = "UPDATE patientinformation SET PatientCode='$PatientCode', PatientName='$PatientName', DOB='$DOB',Sex='$Sex', ContactNo='$ContactNo',Address='$Address' where PatientID = '$PatientID'";
        
	if(mysqli_query($link, $sql)){
            header("Location: ../../views/public/all_patient_view.php");
        }



?>