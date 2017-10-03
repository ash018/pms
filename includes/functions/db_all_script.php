
<?php
function getAllPrescriptionIdGeneration(){
   include("../../includes/functions/db.php");
    $sql = "SELECT PatientCode FROM PatientIdGeneration;";
     
    $result = mysqli_query($link, $sql);
    return mysqli_fetch_array($result);
    
}
function insertIntoPatientIdGeneration($patientId){
    include("../../includes/functions/db.php");
    $sql = "INSERT INTO patientidgeneration (PatientCode) VALUES ('$patientId');";
    mysqli_query($link, $sql);
    mysqli_insert_id($link);
}

function getAllDrugWhentype(){
    include("../../includes/functions/db.php");
    $sql = "SELECT id,bangla FROM drug_when_type;";
    $result = mysqli_query($link, $sql);
    
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
       $rows[] = $r;
    }
    //var_dump($rows); exit();
    return $rows;
}

function getAllDrugAdviceType(){
    include("../../includes/functions/db.php");
    $sql = "SELECT id,bangla FROM drug_advice_type;";
    $result = mysqli_query($link, $sql);
    
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
       $rows[] = $r;
    }
    //var_dump($rows); exit();
    return $rows;
}
function insertIntoPrescription($patientId,
                                $patientCode,
                                $chiefComplaints,
                                $advice,
                                $remark,
                                $nextvisitdate,$userId,
                                $parentPrescriptionId,
                                $nextVisitDurationCount,
                                $nextVisitDurationType){
    
    include("../../includes/functions/db.php");
    $nextvisitdate = $nextvisitdate.' 00:00:00';
    $prescriptionId='';//select PatientID  from patientinformation where PatientID = '$patientId'
    $sql = "INSERT INTO prescription(
            patientId,
            patientCode,
            chiefComplain,
            advice,
            remark,
            nextvisitingdate,
            entryDate,
            UserID,
            nextVisitDurationCount,
            nextVisitDurationType
            )
            VALUES
            ($patientId,'$patientCode','$chiefComplaints','$advice','$remark','$nextvisitdate',now(),$userId,$nextVisitDurationCount,$nextVisitDurationType);";
    
    $sqlUpdatePrescription = '';
    //echo $sql ; exit();
    if(mysqli_query($link, $sql)){
        $prescriptionId = mysqli_insert_id($link);
        if($parentPrescriptionId == ''){
            $sqlUpdatePrescription = "update prescription set referenceID = '$prescriptionId' where id = '$prescriptionId';";
        }
        else{
            $sqlUpdatePrescription = "update prescription set referenceID = '$parentPrescriptionId' where id = '$prescriptionId';";
        }
        mysqli_query($link, $sqlUpdatePrescription);
    }
    //echo $sql; exit();
    return $prescriptionId;
    
}

function insertIntoPrescriptionExamination($prsId, $names, $description){
    include("../../includes/functions/db.php");
    if(isset($description) && $description == '' && sizeof($description)<1 ){
        $index = sizeof($names);
        $description = array_fill(0,$index,'');
    }
    for ($c = 0; $c<sizeof($names);$c++ ){
        $sql = "INSERT INTO prescription_examination ( 
                prsId,
                name,
                description)
                VALUES
                ($prsId,'$names[$c]','$description[$c]');";
        mysqli_query($link, $sql);
        mysqli_insert_id($link);
      }
}

function insertIntoPrescriptionInvestigation($prsId, $names, $description){
    include("../../includes/functions/db.php");
    if(isset($description) && $description == '' && sizeof($description)<1 ){
        $index = sizeof($names);
        $description = array_fill(0,$index,'');
    }
    for($c = 0; $c<sizeof($names);$c++ ){
        $sql = "INSERT INTO prescription_investigation(
                prsId,
                name,
                description)
                VALUES
                ($prsId,'$names[$c]','$description[$c]');";
        
        mysqli_query($link, $sql);
        mysqli_insert_id($link);
    }    
    
}

function insertIntoPrescriptionMedicationRule($prsId,
        $drugTypeName,$drugName, $doseInitial,
        $timesaDay, $when, $intervalWiseDose,
        $duration, $durationType,$drugAdvice){
    include("../../includes/functions/db.php");
    
    
    for($c=0; $c<sizeof($drugName); $c++){
        $dplitedDuration = explode('-',$duration[$c])[0];
        $splitedDutationType = explode('-',$durationType[$c])[1];
        if($drugAdvice[$c] == 'Select'){
            $drugAdvice[$c] = '0';
        }
        if($splitedDutationType == 'Select'){
            $splitedDutationType = '0';
        }
        $sql = "INSERT INTO prescription_medication_rule (prsId, drugTypeName, drugName, doseInitial, timesaDay,
                    `when`, intervalWiseDose, duration, durationType, drugAdvice)
                    VALUES ($prsId,'$drugTypeName[$c]','$drugName[$c]',"
                     . "'$doseInitial[$c]','$timesaDay[$c]',"
                     . "'$when[$c]','$intervalWiseDose[$c]',"
                     . "'$dplitedDuration','$splitedDutationType',"
                     . "'$drugAdvice[$c]');";
        
        mysqli_query($link, $sql);
        mysqli_insert_id($link);
        
    }
}


function insertrBaseLineData(){
    include("../../includes/functions/db.php");
   $duration = array('দিন',
                     'সপ্তাহ',
                     'মাস',
                     'বছর',
                     'চলবে',
                     'মাঝে মাঝে');
   
//    $create = array("স্বামী স্ত্রী দুজন ই খাবেন", 
//                        "মাসিকের ৩য়  দিন থেকে",
//                        "মাসিকের  ২য় , ৪থ ,৬ষঠ,৮ম,১০ম  দিন খাবেন",
//                        "১ দিন পর পর",
//                        "মাংস পেশীতে",
//                        "শিরাতে",
//                        "যোনিপথে ব্যবহার করবেন",
//                        "পায়ুপথে ব্যবহার করবেন",
//                        "অপারেশনের পাচ দিন আগে থেকে",
//                        "অপারেশনের পাচ দিন পর থেকে",
//                        "অপারেশনের সাত দিন আগে থেকে",
//                        "অপারেশনের পাচ দিন পর থেকে",
//                        "সকালে",
//                        "রাতে",
//                        "দুপুরে",
//                        "সেলাইতে ব্যবহার করবেন",
//                        "স্তনে ব্যবহার করবেন",
//                        "মাসিকের 16তম থেকে 25তম দিন",
//                        "৪ চামুচ করে হাফ গ্লাস পানিতে দিনে দশ বার কুলি করবেন",
//                        "১৫ দিন পর পর",
//                        "সন্ধ্যা ৮ টার সময় খাবেন।",
//                        "চামডার নিচে",
//                        "ব্যাথা করলে খাবেন",
//                        "ক্ষতস্থানে মলম লাগাবেন। ",
//                        "সপ্তাহে ১ দিন ",
//                        "চোখে দিবেন" ,
//                        "মুখে দিবেন", 
//                        "ক্ষতস্থানে নির্দেশ অনুযায়ী ",
//                        "নির্দেশিত স্থানে ",
//                        "দিনে ১ টা ",
//                        "মাংস পেশীতে",
//                        "শ্বাস কষ্ট হলে",
//                        "পেটে ব্যথা বেশী হলে");
//                    $name = "পেটে ব্যথা বেশী হলে";
//        
//                    foreach ($create as $r){
//                        $s = "INSERT INTO patientinformation VALUES ('$PatientCode','$r','$DOB','$Sex','$ContactNo','$Address','$DateEntry','$Notes')";
//                        
//                        if(mysqli_query($link, $s)){
//                            $PatientID = mysqli_insert_id($link);
//                        }
//                    }
                    
                    foreach ($duration as $r){
                        $s = "INSERT INTO duration_type (`typeName`)  VALUES ('$r')";
                        //echo $s;
                         mysqli_query($link, $s);
                         
                        
                    }
                   
}


?>

