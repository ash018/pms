<?php
    include("../../includes/functions/session.php");
    authonticate();
    include("../../includes/functions/db_connection.php");
    include("../../includes/functions/functions.php");
    
    $drugId = $_GET['drugId'];
    
    $drugStrengthByDrugId = getStrengthByDrugId($drugId);
    
    echo json_encode($drugStrengthByDrugId);


?>
