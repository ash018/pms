<?php require_once("../../includes/functions/session.php");
authonticate();
?>
<?php require_once("../../includes/functions/db_connection.php"); ?>
<?php require_once("../../includes/functions/functions.php"); ?>
<?php require_once("../../includes/functions/db_all_select_statement.php"); ?>

<?php

if (isset($_POST['submit'])) {

    $username = $_POST["CreateUsername"];
    $password = $_POST["password"];
    $userTypeId = $_POST["selectRole"];
    $active = (isset($_POST['UserActive'])) ? 1 : 0;
    $result = false;
    $checkName = userNameUniqueNessCheck($username);
    if ($checkName) {
        $userId = create_user($username, $password, $userTypeId, $active);

        if (isset($userTypeId) && $userId != '' && $userTypeId == '2') {
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
        else if(isset($userTypeId) && $userId != '' && $userTypeId != '2'){
            $result = true;
        }
    }
    
    $ShowAlert = true;
    $success = false;
    if ($result) {
        $success = true;
    } else {
        $success = false;
    }
    
    if ($result && $checkName) {
        $_SESSION['showalert'] = $ShowAlert;
        $_SESSION['success'] = $success;
        header("Location: ../admin/user_list.php");
    } else {
        $success = true;
        $_SESSION['showalert'] = $ShowAlert;
        $_SESSION['success'] = $success;
        $_SESSION['CreateUsername'] = $_POST["CreateUsername"];
        $_SESSION['password'] = $_POST["password"];
        $_SESSION['selectRole'] = $_POST["selectRole"];
        $_SESSION['UserActive'] = (isset($_POST['UserActive'])) ? 1 : 0;
        if(isset($userTypeId) && $userTypeId == 2){
            $_SESSION['DoctorName'] = $_POST["DoctorName"] ? : '';
            $_SESSION['DoctorAddress'] = $_POST["DoctorAddress"] ? : '';
            $_SESSION['DoctorContact'] = $_POST["DoctorContact"] ? : '';
            $_SESSION['DoctorNotes'] = $_POST["DoctorNotes"] ? : '';
            $_SESSION['DoctorDegree'] = $_POST["DoctorDegree"];
        }
        header("Location: ../admin/user_create.php");
    }
}
?>