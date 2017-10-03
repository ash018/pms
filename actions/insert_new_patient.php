<?php
	//Insert data to the table
//        include("auth.php");

        require_once("../includes/functions/session.php");
	
        include("../includes/functions/db.php");
        $userId = $_SESSION['UserId'];
         
	//Post Data from front-end
	$PatientCode = $_POST['PatientCode'];
	$PatientName = $_POST['PatientName'];
	$DOB = $_POST['DOB'];
	$Sex = $_POST['Sex'];
	$ContactNo = $_POST['ContactNo'];
	$Address = $_POST['Address'];
	//$DateEntry = $_POST['DateEntry'];
	$Notes = $_POST['Notes'];
        
	$sql = "INSERT INTO patientinformation(`PatientCode`,`PatientName`,`DOB`,`Sex`,`ContactNo`,`Address`,`DateEntry`,`Notes`,`userID`) VALUES ('$PatientCode','$PatientName','$DOB','$Sex','$ContactNo','$Address',now(),'$Notes',$userId)";
	
	if(mysqli_query($link, $sql)){
            header("Location: ../views/public/all_patient_view.php");
        }
        


?>