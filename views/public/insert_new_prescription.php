<?php
    include("../../includes/functions/session.php");
    authonticate();
    include("../../includes/functions/db_all_script.php");
    
    $patientId = '';
    $patientCode = '';
    $PatientName = '';
    $parentPrescriptionId = '';
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
    $userId = $_SESSION['UserId'];
    

    if(isset($_POST['patientId']) && count($_POST['patientId']) > 0){
        $patientId = $_POST['patientId'];
    }
    if(isset($_POST['patientCode']) && count($_POST['patientCode']) > 0){
        $patientCode = $_POST['patientCode'];
    }
    if(isset($_POST['patientName']) && count($_POST['patientName']) > 0){
        $PatientName = $_POST['patientName'];
    }
    
    if(isset($_POST['parentPrescriptionId'])){
        $parentPrescriptionId = $_POST['parentPrescriptionId'] ? : '';
    }
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
            $vitalName = $_POST['vitalName'] ? : '';
    }
    if(isset($_POST['NotesE'])){
        $notesE = $_POST['NotesE'] ? : '';
    }
    if(isset($_POST['investigationName'])){
        $investigationName = $_POST['investigationName'] ? : '';
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
    
    if($chiefComplaints == '' && $advice == '' 
            && $remark == '' && $nextVisitDurationCount == '0' 
            && $nextVisitDurationType == '5' && $nextvisitdate == '1970-01-01'
            && $vitalName == '' && $investigationName == ''
            && $drugTypeName == '' && $drugName == ''){
        $ShowAlert = true;
        $_SESSION['showalert'] = $ShowAlert;
        header('Location: new_prescription.php?PatientID='.$patientId.'&PatientCode='.$patientCode.'&PatientName='.$PatientName);
    }
    else{
        $prescriptionId = insertIntoPrescription($patientId, $patientCode,
                                                 $chiefComplaints, $advice, 
                                                 $remark, $nextvisitdate, 
                                                 $userId,$parentPrescriptionId,
                                                 $nextVisitDurationCount,
                                                 $nextVisitDurationType);
        

        if ($vitalName != '') {
            insertIntoPrescriptionExamination($prescriptionId, $vitalName, $notesE);
        }
        if ($investigationName != '') {
            insertIntoPrescriptionInvestigation($prescriptionId, $investigationName, $investigationNote);
        }
        if ($drugName != '') {
            insertIntoPrescriptionMedicationRule($prescriptionId, $drugTypeName, $drugName, $doseInitial, $timesaDay, $when, $intervalWiseDose, $duration, $durationType, $drugAdvice);
        }
        //readdir('all_prescription_view.php');
        header('Location: ../../views/public/all_prescription_view.php');
    }
?>

