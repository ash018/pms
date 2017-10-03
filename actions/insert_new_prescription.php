<?php require_once("../includes/functions/session.php"); authonticate(); ?>
<?php require_once("../includes/functions/db_all_script.php"); ?>
<?php
//        include("auth.php");
//        include("db_all_script.php");
        //include("../../includes/functions/session.php");

//        authonticate();
//	
//        include("..\includes\functions\db_all_script.php");
//        print_r('<pre />');
//        print_r($_POST); exit();
        
        $patientId = $_POST['patientId'];
        $patientCode = $_POST['patientCode'];
        
        $userId = $_SESSION['UserId'];
        
        $chiefComplaints = $_POST['chiefComplaints'] ?: '';
        $advice = $_POST['advice'] ?: '';
        $remark = $_POST['remark'] ?: '';
        $nextvisitdate = $_POST['nextvisitdate'] ?: '';
        
        $prescriptionId =  insertIntoPrescription($patientId,$patientCode,$chiefComplaints,
                                $advice, $remark, $nextvisitdate,$userId);
       
        $vitalName = $_POST['vitalName'];
        $notesE = $_POST['NotesE'];
        
        $investigationName = $_POST['investigationName'];
        $investigationNote = $_POST['investigationNote'];
        
        
        $drugTypeName = $_POST['DrugTypeName'] ?: '';
        $drugName = $_POST['DrugName'] ?: '';
        $doseInitial = $_POST['DoseInitial'] ?: '';
        $timesaDay = $_POST['TimesaDay'] ?: '';
        $when = $_POST['When'] ?: '';
        $intervalWiseDose = $_POST['IntervalWiseDose'] ?: '';
        $duration = $_POST['DurationDurationType'] ?: '';
        $durationType = $_POST['DurationDurationType'] ?: '';
        $drugAdvice = $_POST['DrugAdvice'] ?: '';
        
        
        
        if(isset($vitalName) && sizeof($vitalName) > 0){
            insertIntoPrescriptionExamination($prescriptionId,$vitalName,$notesE);
        }
        if(isset($investigationName) && sizeof($investigationNote) > 0){
            insertIntoPrescriptionInvestigation($prescriptionId,$investigationName,$investigationNote);
        }
        if(isset($drugName) && sizeof($drugName) > 0){
            insertIntoPrescriptionMedicationRule($prescriptionId,
            $drugTypeName,$drugName, $doseInitial,
            $timesaDay, $when, $intervalWiseDose,
            $duration, $durationType,$drugAdvice);
        }
        //readdir('all_prescription_view.php');
        header('Location:../../views/public/all_prescription_view.php');

?>

