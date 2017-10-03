<?php

    function getAllEducation(){
       include("../../includes/functions/db.php");
        $sql = "SELECT id,certificateName FROM doctor_educational_qualification;";
        $result = mysqli_query($link, $sql);
    
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
           $rows[] = $r;
        }
        return $rows; 
    }

    function getAllUser($curentuser){
        include("../../includes/functions/db.php");
        $sql = "SELECT u.id as id, u.UserName as uName,u.IsActive as IsActive, ut.typeName as uTypeName  FROM userinfo u, usertype ut where u.UserTypeId = ut.id and u.EntryById = '$curentuser';";
        $result = mysqli_query($link, $sql);
    
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
           $rows[] = $r;
        }
        return $rows;
    }

    function getAllPrescriptionAccordingtoCurrentUser($userId){
        include("../../includes/functions/db.php");
        $sql ="SELECT prescription.id as id,prescription.patientId as patientId, patientinformation.PatientName as patientName, prescription.patientCode as patientCode,  DATE_FORMAT(prescription.entryDate,'%d-%m-%y') as entryDate, DATE_FORMAT(prescription.nextvisitingdate,'%d-%m-%y') as nextvisitingdate FROM prescription, patientinformation where prescription.userID = '$userId' and patientinformation.PatientID = prescription.patientId and prescription.id = prescription.referenceID order by prescription.id desc;";
        //$sql = "SELECT prescription.id as id,prescription.patientId as patientId, patientinformation.PatientName as patientName, prescription.patientCode as patientCode,  DATE_FORMAT(prescription.entryDate,'%d-%m-%y') as entryDate, DATE_FORMAT(prescription.nextvisitingdate,'%d-%m-%y') as nextvisitingdate   FROM prescription, pati entinformation where prescription.userID = '$userId' and patientinformation.PatientID = prescription.patientId order by prescription.id desc;";
        //$sql = "SELECT * FROM prescription where userID = '$userId' order by id desc;"; 
        //echo $sql; exit();
        $result = mysqli_query($link, $sql);
    
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
           $rows[] = $r;
        }
        
        return $rows;
    }
    
    function getAllFollowupsAccordingtoCurrentUser($userId){
        include("../../includes/functions/db.php");
        $sql = "SELECT prescription.id as id,prescription.patientId as patientId, patientinformation.PatientName as patientName, prescription.patientCode as patientCode,  DATE_FORMAT(prescription.entryDate,'%d-%m-%y') as entryDate, DATE_FORMAT(prescription.nextvisitingdate,'%d-%m-%y') as nextvisitingdate FROM prescription, patientinformation where prescription.userID = '$userId' and patientinformation.PatientID = prescription.patientId and prescription.id != prescription.referenceID order by prescription.id desc;";
        $result = mysqli_query($link, $sql);
    
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
           $rows[] = $r;
        }
        
        return $rows;
    }
    
    function getPatientInfoAccordingToPatientId($patientId){
        include("../../includes/functions/db.php");
        $sql = "SELECT PatientID, PatientName, PatientCode, Sex, ContactNo, DOB FROM patientinformation where PatientID = '$patientId' ";
        $result = mysqli_query($link, $sql);
    
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
           $rows[] = $r;
        }
        //var_dump($rows);
        return $rows;
    }
    
    function getAllPatientInformationAccordingtoCurrentUser($userId){
        include("../../includes/functions/db.php");
        $sql = "SELECT PatientID, PatientName, PatientCode, Sex, ContactNo, date_format( DateEntry ,'%d-%m-%y') as DateEntry FROM patientinformation where userID = '$userId' order by PatientID desc;";
        $result = mysqli_query($link, $sql);
    
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
           $rows[] = $r;
        }
        //var_dump($rows);
        return $rows;
    }
    
    
    
    function getPrescriptionForEdit($userId, $prescriptionId){
       include("../../includes/functions/db.php");
        $multiDimentionalRows = array(
            'prescription' => array(),
            'examination' => array(),
            'investigation' => array(),
            'medicationRule' => array()
           );
        
        $prescription = array();
        
        $prescriptionExamination = array();
        $prescriptionInvestigation = array();
        $prescriptionMedicationRule = array();
        

        $sqlPrescription="select pres.id as id, patiInfo.patientId as patientId, 
                            patiInfo.patientCode as patientCode, patiInfo.PatientName as PatientName,
                            patiInfo.ContactNo as ContactNo, patiInfo.DOB as DOB, patiInfo.Sex as sex,
                            pres.chiefComplain as chiefComplain, pres.advice as advice,
                            pres.remark as remark, date_format(pres.nextvisitingdate,'%d-%m-%y') as nextvisitingdate,
                            date_format(pres.nextvisitingdate,'%Y-%m-%d') as showDate,
                            pres.nextVisitDurationCount as nextVisitDurationCount,
                            pres.nextVisitDurationType as nextVisitDurationType
                            from prescription as pres, patientinformation as patiInfo   
                            where pres.id = '$prescriptionId' and pres.patientId = patiInfo.PatientID;";
        $resultPrescription = mysqli_query($link, $sqlPrescription);
        while($r = mysqli_fetch_assoc($resultPrescription)) {
           $prescription[] = $r;
        }
        
        $sqlPrescriptionExamination = "select id,`name`,description from prescription_examination where prsId = '$prescriptionId';";
        $sqlPrescriptionInvestigation = "select id,`name`,description from prescription_investigation where prsId = '$prescriptionId';";
        $sqlPrescriptionMedicationRule = "select id, drugTypeName, drugName, doseInitial, timesaDay,`when`, intervalWiseDose, duration, durationType, drugAdvice  from prescription_medication_rule where prsId = '$prescriptionId';";
        
        
        $resultPrescriptionExamination = mysqli_query($link, $sqlPrescriptionExamination);
        $resultPrescriptionInvestigation = mysqli_query($link, $sqlPrescriptionInvestigation);
        $resultPrescriptionMedicationRule = mysqli_query($link, $sqlPrescriptionMedicationRule);
        
        while($r = mysqli_fetch_assoc($resultPrescriptionExamination)) {
           $prescriptionExamination[] = $r;
        }
        while($r = mysqli_fetch_assoc($resultPrescriptionInvestigation)) {
           $prescriptionInvestigation[] = $r;
        }
        while($r = mysqli_fetch_assoc($resultPrescriptionMedicationRule)) {
           $prescriptionMedicationRule[] = $r;
        }
        
        
        $multiDimentionalRows = array(
            'prescription' => $prescription,
            'examination' => $prescriptionExamination,
            'investigation' => $prescriptionInvestigation,
            'medicationRule' => $prescriptionMedicationRule
           );
        
        
        return $multiDimentionalRows;
      }
      
      function getDrugTypeInformationForMakeJSONArray(){
            include("../../includes/functions/db.php");
            //$queryDTN = "SELECT * FROM drugtypeinformation";
            $queryDTN = "SELECT id,typeInitial FROM drug_type;";
            $resultDTN = mysqli_query($link, $queryDTN);

            $availableTagsDTN = array(array());
            $k = 0;
            while ($rowDTN = mysqli_fetch_array($resultDTN)) {
                //$availableTagsDTN[] = $rowDTN["DrugTypeName"];
                $availableTagsDTN[$k]['id'] = $rowDTN['id'];
                $availableTagsDTN[$k]['type'] = $rowDTN['typeInitial'];
                $k++;
            }
        return json_encode($availableTagsDTN);
      }
      
      function getDrugInformationForMakeJSONArray(){
            include("../../includes/functions/db.php");
            $queryDN = "SELECT * FROM druginformation";
            $resultDN = mysqli_query($link, $queryDN);
            $availableTagsDN = array();
            while ($rowDN = mysqli_fetch_array($resultDN)) {
                $availableTagsDN[] = $rowDN["DrugName"];
            }
            $availableTags_jsonDN = '[';
            foreach ($availableTagsDN as $at) {
                //$availableTags_json .= "'" . $at ."',";
                $at2 = str_replace("'", " ", $at);
                $availableTags_jsonDN .= "'" . $at2 . "',";
            }
            $availableTags_jsonDN = substr($availableTags_jsonDN, 0, -1);
            $availableTags_jsonDN .= ']';
            
            return $availableTags_jsonDN;
          
      }
      
      function getInvestigationInformationForMakeJSONArray(){
            include("../../includes/functions/db.php");
            $query = "SELECT * FROM investigationinformation";
            $result = mysqli_query($link, $query);

            $availableTags = array();
            while ($row = mysqli_fetch_array($result)) {
                $availableTags[] = $row["InvestigationName"];
            }
            $availableTags_json = '[';
            foreach ($availableTags as $at) {
                //$availableTags_json .= "'" . $at ."',";
                $at2 = str_replace("'", " ", $at);
                $availableTags_json .= "'" . $at2 . "',";
            }
            $availableTags_json = substr($availableTags_json, 0, -1);
            $availableTags_json .= ']';
            
            return $availableTags_json;
        }
        
        function getVitalForMakeJSONArray(){
            include("../../includes/functions/db.php");
            
            $queryE = "SELECT * FROM vital";
            $resultE = mysqli_query($link, $queryE);

            $availableTagsE = array();
            while ($row = mysqli_fetch_array($resultE)) {
                $availableTagsE[] = $row["vitalName"];
            }
            $availableTags_jsonE = '[';
            foreach ($availableTagsE as $at) {
                
                $at2 = str_replace("'", " ", $at);
                $availableTags_jsonE .= "'" . $at2 . "',";
            }
            $availableTags_jsonE = substr($availableTags_jsonE, 0, -1);
            $availableTags_jsonE .= ']';
            
            return $availableTags_jsonE;
            
        }
        function getInvestigationInfForMakeJSONArray(){
            include("../../includes/functions/db.php");
            $query = "SELECT * FROM investigationinformation";
            $result = mysqli_query($link, $query);

            $availableTags = array();
            while ($row = mysqli_fetch_array($result)) {
                $availableTags[] = $row["InvestigationName"];
            }
            $availableTags_json = '[';
            foreach ($availableTags as $at) {
                $at2 = str_replace("'", " ", $at);
                $availableTags_json .= "'" . $at2 . "',";
            }
            $availableTags_json = substr($availableTags_json, 0, -1);
            $availableTags_json .= ']';
            return $availableTags_json;
        }
        
        function getPatinentInfoByPatientId($PatientID){
            include("../../includes/functions/db.php");
            $query = "SELECT PatientID,PatientName,PatientCode,DOB as dd, Sex, ContactNo from patientinformation Where PatientID = '$PatientID'";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
            return $row;
        }



    
    function getPatientForEdit($patientId){
        include("../../includes/functions/db.php");
        $sqlPatient="select PatientID, PatientCode, PatientName, DOB, Sex, ContactNo,Address, DateEntry  from patientinformation  where PatientID = '$patientId';";
        $result = mysqli_query($link, $sqlPatient);
        
        //return $resultPatient;
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
           $rows[] = $r;
        }
        
        return $rows;
    }
    
    
    function getAllPreviousFollowup($userId, $parentPrescriptionId){
        include("../../includes/functions/db.php");
        $prescription = array(); 
        $prescriptionExamination = array(); 
        $prescriptionInvestigation = array(); 
        $prescriptionMedicationRule = array(); 
        $multiDimentionalRows = array(
            'prescription' => array(),
            'examination' => array(),
            'investigation' => array(),
            'medicationRule' => array()
           );
        
        
        $sqlprescription = "select id,patientId,patientCode,"
                . "chiefComplain,advice,remark,nextvisitingdate,entryDate "
                . "from prescription where prescription.id != prescription.referenceID "
                . "and referenceID = '$parentPrescriptionId' and userID = '$userId' order by entryDate asc;";
        
        $sqlExa = "select pexa.prsId as prsId, pexa.`name` as `name`,"
                . "pexa.description as description from prescription_examination as pexa,"
                . " (select id from prescription where prescription.id != prescription.referenceID and"
                . " referenceID = '$parentPrescriptionId' and userID = '$userId' "
                . "order by entryDate asc) as followsUp where pexa.prsId = followsUp.id;";
        
        $sqlInv = "select pein.prsId as prsId, pein.`name` as `name`,pein.description as description "
                . "from prescription_investigation as pein, (select id from prescription "
                . "where prescription.id != prescription.referenceID and referenceID = '$parentPrescriptionId' "
                . "and userID = '$userId' order by entryDate asc) as followsUp where pein.prsId = followsUp.id;";


        $sqlMedi = "select pemerl.id as id, pemerl.prsId as prsId, pemerl.drugTypeName as drugTypeName, "
                . "pemerl.drugName as drugName, pemerl.doseInitial as doseInitial, "
                . "pemerl.timesaDay as timesaDay, pemerl.`when` as `when`, "
                . "pemerl.intervalWiseDose as intervalWiseDose, pemerl.duration as duration, "
                . "pemerl.durationType as durationType, pemerl.drugAdvice as drugAdvice "
                . "from prescription_medication_rule as pemerl, (select id from prescription "
                . "where prescription.id != prescription.referenceID and referenceID = '$parentPrescriptionId' and "
                . "userID = '$userId' order by entryDate asc) as followsUp where pemerl.prsId = followsUp.id;";

        $resultprescription = mysqli_query($link, $sqlprescription);
        
        while($r = mysqli_fetch_assoc($resultprescription)) {
           $prescription[] = $r;
        }
        
        $resultExa = mysqli_query($link, $sqlExa);
        while($r = mysqli_fetch_assoc($resultExa)) {
           $prescriptionExamination[] = $r;
        }
        
        $resultInv = mysqli_query($link, $sqlInv);
        while($r = mysqli_fetch_assoc($resultInv)) {
           $prescriptionInvestigation[] = $r;
        }
        
        $resultMedi = mysqli_query($link, $sqlMedi);
        while($r = mysqli_fetch_assoc($resultMedi)) {
           $prescriptionMedicationRule[] = $r;
        }
        
        $multiDimentionalRows = array(
            'prescription' => $prescription,
            'examination' => $prescriptionExamination,
            'investigation' => $prescriptionInvestigation,
            'medicationRule' => $prescriptionMedicationRule
           );
        
          return $multiDimentionalRows;      
      }

    
    

