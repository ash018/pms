<?php
    function updatePrescription($prescriptionId, $patientId,
            $patientCode,$chiefComplaints,$advice,$remark,$nextvisitdate,$nextVisitDurationCount,$nextVisitDurationType){
       include("../../includes/functions/db.php");
        $nextvisitdate = $nextvisitdate.' 00:00:00';
        $sql = "UPDATE prescription
                SET `patientId` = '$patientId',`patientCode` = '$patientCode',`chiefComplain` = '$chiefComplaints',
                `advice` = '$advice',`remark` = '$remark' ,`nextvisitingdate` = '$nextvisitdate',`nextVisitDurationCount` = '$nextVisitDurationCount' , `nextVisitDurationType` = '$nextVisitDurationType'
                WHERE id = '$prescriptionId';";
        $result = mysqli_query($link, $sql);
        return $result;
    }
