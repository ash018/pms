<?php
    include("../../includes/functions/session.php");
    authonticate();
    include("../../includes/functions/db_connection.php");
    include("../../includes/functions/functions.php");
    
    $drugTypeId = $_GET['drugTypeId'];
    $drugName = $_GET['drugName'];
    $drugByTypeId = getDrugByTypeId($drugTypeId,$drugName);
    
    echo json_encode($drugByTypeId);
?>
