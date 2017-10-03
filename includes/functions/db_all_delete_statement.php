<?php

    function deletePrescriptionExamination($prescriptionId){
       include("../../includes/functions/db.php");
        $sql = "DELETE FROM prescription_examination WHERE prsId = '$prescriptionId';";
        $result = mysqli_query($link, $sql);
        return $result; 
        
    }
    function deletePrescriptionInvestigation($prescriptionId){
        include("../../includes/functions/db.php");
        $sql = "DELETE FROM prescription_investigation WHERE prsId = '$prescriptionId';";
        $result = mysqli_query($link, $sql);
        return $result; 
        
    }
    function deletePrescriptionMedicationRule($prescriptionId){
        include("../../includes/functions/db.php");
        $sql = "DELETE FROM prescription_medication_rule WHERE prsId = '$prescriptionId';";
        $result = mysqli_query($link, $sql);
        return $result;
    }
