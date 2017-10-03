<?php
    include("../../includes/functions/session.php");
    authonticate();
    include("../../includes/functions/db_all_script.php");
    include("../../includes/functions/db_all_update_statement.php");
    include("../../includes/functions/db_all_delete_statement.php");
    
    $userId = $_SESSION['UserId'];
    
    //print_r('<pre/>'); print_r($_POST);exit();
    
    $prescriptionId = $_POST['prescriptionId'];
    $patientId = $_POST['patientId'];
    $patientCode = $_POST['patientCode'];
    
    $chiefComplaints = '';
    $advice = '';
    $remark = '';
    $nextVisitDurationCount = '';
    $nextVisitDurationType = '';
    $nextvisitdate = '';
    
    $vitalName = '';
    $notesE = '';
    $investigationName = '';
    $investigationNote = '';
    
    $drugTypeName = '';
    $drugName = '';
    $doseInitial = '';
    $timesaDay = '';
    $when = '';
    $intervalWiseDose = '';
    $duration = '';
    $durationType = '';
    $drugAdvice = '';
    
    
    if(isset($_POST['chiefComplaints'])){
        $chiefComplaints = $_POST['chiefComplaints'] ? : '';
    }
    if(isset($_POST['advice'])){
        $advice = $_POST['advice'] ? : '';
    }
    if(isset($_POST['remark'])){
        $remark = $_POST['remark'] ? : '';
    }
    if(isset($_POST['nextVisitDurationCount'])){
        $nextVisitDurationCount = $_POST['nextVisitDurationCount'] ? : '0';
    }
    if(isset($_POST['nextVisitDurationType'])){
        $nextVisitDurationType = $_POST['nextVisitDurationType'] ? : '5';
    }
    if(isset($_POST['nextvisitdate'])){
        $nextvisitdate = $_POST['nextvisitdate'] ? : '1970-01-01';
    }
    
    if(isset($_POST['vitalName'])){
            $vitalName = $_POST['vitalName'];
    }
    if(isset($_POST['NotesE'])){
        $notesE = $_POST['NotesE'];
    }
    if(isset($_POST['investigationName'])){
        $investigationName = $_POST['investigationName'];
    }
    if(isset($_POST['investigationNote'])){
        $investigationNote = $_POST['investigationNote'];
    }

    if(isset($_POST['DrugTypeName'])){
        $drugTypeName = $_POST['DrugTypeName'] ? : '';
    }
    if(isset($_POST['DrugName'])){
        $drugName = $_POST['DrugName'] ? : '';
    }
    if(isset($_POST['DoseInitial'])){
        $doseInitial = $_POST['DoseInitial'] ? : '';
    }
    if(isset($_POST['TimesaDay'])){
        $timesaDay = $_POST['TimesaDay'] ? : '';
    }
    if(isset($_POST['When'])){
        $when = $_POST['When'] ? : '';
    }
    if(isset($_POST['IntervalWiseDose'])){
        $intervalWiseDose = $_POST['IntervalWiseDose'] ? : '';
    }
    if(isset($_POST['DurationDurationType'])){
        $duration = $_POST['DurationDurationType'] ? : '';
    }

    if(isset($_POST['DurationDurationType'])){
        $durationType = $_POST['DurationDurationType'] ? : '';
    }
    if(isset($_POST['DrugAdvice'])){
       $drugAdvice = $_POST['DrugAdvice'] ? : '';
    }
    
    if($chiefComplaints == '' && $advice == '' && $remark == '' 
            && $nextVisitDurationCount == '0' && $nextVisitDurationType == '5' 
            && $nextvisitdate == '1970-01-01' && $vitalName == '' 
            && $investigationName == '' && $drugTypeName == '' && $drugName == ''){
        $ShowAlert = true;
        $_SESSION['showalert'] = $ShowAlert;
        header('Location: edit_prescription.php?id='.$prescriptionId.'&patientId='.$patientId);
    }
    else{
        if(updatePrescription($prescriptionId, $patientId, $patientCode,$chiefComplaints,$advice,$remark,$nextvisitdate,$nextVisitDurationCount,$nextVisitDurationType)){
            $delExami = deletePrescriptionExamination($prescriptionId);
            $delInves = deletePrescriptionInvestigation($prescriptionId);
            $delMediRule = deletePrescriptionMedicationRule($prescriptionId);

            if($delExami == 1 && $vitalName != ''){
                insertIntoPrescriptionExamination($prescriptionId,$vitalName,$notesE);
            }
            if($delInves == 1 && $investigationName != ''){
                insertIntoPrescriptionInvestigation($prescriptionId,$investigationName,$investigationNote);
            }
            if($delMediRule == 1 && $drugName != '' && $drugTypeName != ''){
                insertIntoPrescriptionMedicationRule($prescriptionId,
                $drugTypeName,$drugName, $doseInitial,
                $timesaDay, $when, $intervalWiseDose,
                $duration, $durationType,$drugAdvice);
            }
        }

        header('Location: ../../views/public/all_prescription_view.php');
    }
     
?>    

        

