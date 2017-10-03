<?php require_once("../../includes/functions/session.php");
authonticate();
?>
<?php require_once("../../includes/functions/db_connection.php"); ?>
<?php require_once("../../includes/functions/functions.php"); ?>
<?php require_once("../../includes/functions/db_all_select_statement.php"); ?>

<?php

if (isset($_POST['submit'])) {

    //print_r('<pre />');    print_r($_POST);exit();
    $userId = $_POST["userId"];

    $password = $_POST["password"];
    $userTypeId = $_POST["selectRole"] ? : '';
    $active = (isset($_POST['UserActive'])) ? 1 : 0;

    $userUpdate = updateUserInfo($userId, $password, $userTypeId, $active);
    if ($userUpdate && isset($userTypeId) && $userTypeId == 1) {
        $result = deleteDoctorinformationDoctorEducationMap($userId, $doctorId);
    } 
    else if ($userUpdate && isset($userTypeId) && $userTypeId == 2) {
        $doctorId = $_POST["DoctorId"];
        if (isset($doctorId) && sizeof($doctorId) > 0) {
            $deleteResult = deleteDoctorinformationDoctorEducationMap($userId, $doctorId);
            if ($deleteResult) {
                $doctorName = $_POST["DoctorName"] ? : '';
                $doctorAddress = $_POST["DoctorAddress"] ? : '';
                $doctorContact = $_POST["DoctorContact"] ? : '';
                $DoctorNotes = $_POST["DoctorNotes"] ? : '';
                $DoctorDegree = $_POST["DoctorDegree"];

                $doctorId = insertIntoDoctorInformationTable($doctorName, $doctorAddress, $doctorContact, $DoctorNotes, $userId);

                if (isset($doctorId) && isset($DoctorDegree) && sizeof($DoctorDegree) > 0) {
                    foreach ($DoctorDegree as $degree) {
                        $result = insertIntoDoctorEducationalqualificationMapping($doctorId, $degree);
                    }
                }
            }
            else{
                $doctorName = $_POST["DoctorName"] ? : '';
                $doctorAddress = $_POST["DoctorAddress"] ? : '';
                $doctorContact = $_POST["DoctorContact"] ? : '';
                $DoctorNotes = $_POST["DoctorNotes"] ? : '';
                $DoctorDegree = $_POST["DoctorDegree"];

                $doctorId = insertIntoDoctorInformationTable($doctorName, $doctorAddress, $doctorContact, $DoctorNotes, $userId);

                if (isset($doctorId) && isset($DoctorDegree) && sizeof($DoctorDegree) > 0) {
                    foreach ($DoctorDegree as $degree) {
                        $result = insertIntoDoctorEducationalqualificationMapping($doctorId, $degree);
                    }
                }
            }
        }
    }


    $ShowAlert = true;
    $success = false;
    if ($result) {
        $success = true;
    } else {
        $success = false;
    }


    if ($result) {
        $_SESSION['showalert'] = $ShowAlert;
        $_SESSION['success'] = $success;
        header("Location: ../admin/user_list.php");
    } else {
        header("Location: ../admin/user_create.php");
    }
}
?>