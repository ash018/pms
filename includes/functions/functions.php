<?php

function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}

function mysql_prep($string) {
    global $connection;

    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
}

function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed.");
    }
}

function form_errors($errors = array()) {
    $output = "";
    if (!empty($errors)) {
        $output .= "<div class=\"error\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        foreach ($errors as $key => $error) {
            $output .= "<li>";
            $output .= htmlentities($error);
            $output .= "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

function find_all_admins() {
    global $connection;

    $query = "SELECT * ";
    $query .= "FROM UserInfo ";
    $query .= "ORDER BY username ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_admin_by_id($admin_id) {
    global $connection;

    $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);

    $query = "SELECT * ";
    $query .= "FROM UserInfo ";
    $query .= "WHERE id = {$safe_admin_id} ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if ($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function find_admin_by_username($username) {
    global $connection;

    $safe_username = mysqli_real_escape_string($connection, $username);

    $query = "SELECT * ";
    $query .= "FROM UserInfo ";
    $query .= "WHERE username = '{$safe_username}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if ($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function password_encrypt($password) {
    $hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
    $salt_length = 22;      // Blowfish salts should be 22-characters or more
    $salt = generate_salt($salt_length);
    $format_and_salt = $hash_format . $salt;
    $hash = crypt($password, $format_and_salt);
    return $hash;
}

function generate_salt($length) {
    // Not 100% unique, not 100% random, but good enough for a salt
    // MD5 returns 32 characters
    $unique_random_string = md5(uniqid(mt_rand(), true));

    // Valid characters for a salt are [a-zA-Z0-9./]
    $base64_string = base64_encode($unique_random_string);

    // But not '+' which is valid in base64 encoding
    $modified_base64_string = str_replace('+', '.', $base64_string);

    // Truncate string to the correct length
    $salt = substr($modified_base64_string, 0, $length);

    return $salt;
}

function password_check($password, $existing_hash) {
    // existing hash contains format and salt at start
    $hash = crypt($password, $existing_hash);
    if ($hash === $existing_hash) {
        return true;
    } else {
        return false;
    }
}

function attempt_login($username, $password) {
    $admin = find_admin_by_username($username);
    if ($admin) {
        // found admin, now check password
        if (password_check($password, $admin["Password"])) {
            // password matches
            return $admin;
        } else {
            // password does not match
            return false;
        }
    } else {
        // admin not found
        return false;
    }
}

function logged_in() {
    return isset($_SESSION['admin_id']);
}

function confirm_logged_in() {
    if (!logged_in()) {
        redirect_to("public/login.php");
    }
}

function db() {
    static $conn;
    if ($conn === NULL) {
        $conn = mysqli_connect("localhost", "root", "", "ppPro");
    }
    return $conn;
}

function get_all_user_type() {
    $connection = db();

    $query = "SELECT * FROM UserType;";
    $result_set = mysqli_query($connection, $query);
    $rows = array();
    while ($r = mysqli_fetch_assoc($result_set)) {
        $rows[] = $r;
    }

    return $rows;
}

function userNameUniqueNessCheck($userName) {
    $connection = db();
    $sql = "SELECT * FROM userinfo where UserName = '$userName';";
    $result_set = mysqli_query($connection, $sql);
    $rows = array();
    while ($r = mysqli_fetch_assoc($result_set)) {
        $rows[] = $r;
    }
    if (sizeof($rows) > 0) {
        return false;
    } else {
        return true;
    }
}

function create_user($username, $password, $userTypeId, $active) {
    $connection = db();
    $hashed_password = password_encrypt($password);
    $EntryById = 1;
    $UserTypeId = intval($userTypeId);
    $IsActive = intval($active);

    $query = "INSERT INTO UserInfo (";
    $query .= "  UserName, Password, UserTypeId, IsActive, EntryById";
    $query .= ") VALUES (";
    $query .= "  '{$username}', '{$hashed_password}', {$UserTypeId}, {$IsActive}, {$EntryById}";
    $query .= ")";

    $userId = '';

    if (mysqli_query($connection, $query)) {
        $userId = mysqli_insert_id($connection);
    }
    return $userId;
}

function insertIntoDoctorInformationTable($doctorName, $doctorAddress, $doctorContact, $DoctorNotes, $userInfoId) {
    $connection = db();
    $sql = "INSERT INTO doctorinformation(
                        DoctorName,
                        DoctorAddress,
                        Contact,Notes,
                        userInfoId)
                        VALUES
                        ('$doctorName','$doctorAddress','$doctorContact','$DoctorNotes','$userInfoId');";

    //print_r($sql); exit();
    //$result = mysqli_query($connection, $sql);
    $doctorId = '';
    if (mysqli_query($connection, $sql)) {
        $doctorId = mysqli_insert_id($connection);
    }
    return $doctorId;
}

function insertIntoDoctorEducationalqualificationMapping($doctorId, $educationQulificationId) {
    $connection = db();
    $sql = "INSERT INTO `doctor_educationalqualification_mapping`
            (`doctorId`,
            `educationalQualificatioId`)
            VALUES
            ('$doctorId','$educationQulificationId');";

    $result = mysqli_query($connection, $sql);

    return $result;
}

function optionsOfTimesaDay() {
    $option = '<option value="0" selected="selected">Select</option>
                        <option value="12 hourly">12 hourly</option>
                        <option value="8 hourly">8 hourly</option>
                        <option value="6 hourly">6 hourly</option>
                        <option value="4 hourly">4 hourly</option>
                        <option value="3 hourly">3 hourly</option>
                        <option value="2 hourly">2 hourly</option>
                        <option value="Periodic Dose">Periodic Dose</option>
                        <option value="Same As">Same As</option>
                        <option value="Empty Dose">Empty Dose</option>';
    return $option;
}

function saveOperationSuccessMessage($moduleNmae, $operationName) {
    return '<div class="alert bg-green alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <center>' . $moduleNmae . ' successfully' . $operationName . '</center>
                                </div>';
}

function saveOperationFailMessage($moduleName, $operationName) {
    return '<div class="alert bg-pink alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <center>' . $moduleName . ' successfully' . $operationName . ' Failed</center>
                                </div>';
}

function editUserInfo($userId) {
    $connection = db();

    $editDoctor = array(
        'userInfo' => array(),
        'doctorInfo' => array(),
        'doctorEducation' => array()
    );

    $sqlUserInfo = "select * from userinfo where id = '$userId';";

    $sqlDocInfo = "select * from doctorinformation where userInfoId = '$userId'";



    $resultUserInfo = mysqli_query($connection, $sqlUserInfo);
    $resultDocInfo = mysqli_query($connection, $sqlDocInfo);

    $rowsUserInfo = array();
    $rowsDocInfo = array();
    $rowsDocEdu = array();

    while ($r = mysqli_fetch_assoc($resultUserInfo)) {
        $rowsUserInfo[] = $r;
    }
    /*
     * User Type Check If this user either Doctor or Not
     */
    if ($rowsUserInfo[0]['UserTypeId'] == 2) {

        while ($r = mysqli_fetch_assoc($resultDocInfo)) {
            $rowsDocInfo[] = $r;
        }

        $doctorId = $rowsDocInfo[0]['DoctorID'];
        $sqlDocEdu = "select * from doctor_educationalqualification_mapping where doctorId = '$doctorId';";
        $resultDocEdu = mysqli_query($connection, $sqlDocEdu);

        while ($r = mysqli_fetch_assoc($resultDocEdu)) {
            $rowsDocEdu[] = $r;
        }
    }
    $editDoctor = array(
        'userInfo' => $rowsUserInfo,
        'doctorInfo' => $rowsDocInfo,
        'doctorEducation' => $rowsDocEdu
    );

    return $editDoctor;
}

function updateUserInfo($userId, $password, $userTypeId, $active) {
    $connection = db();
    $hashed_password = password_encrypt($password);
    $UserTypeId = intval($userTypeId);
    $IsActive = intval($active);
    $sql = "UPDATE userinfo
                    SET
                    Password = '$hashed_password',
                    UserTypeId = '$UserTypeId',
                    IsActive = '$IsActive'
                    WHERE id = '$userId';";

    if (mysqli_query($connection, $sql)) {
        return true;
    } else {
        false;
    }
}

function deleteDoctorinformationDoctorEducationMap($userId, $doctorId) {
    $connection = db();
    $sql = "DELETE FROM doctorinformation
            WHERE userInfoId = '$userId';";
    $deleteDocEdu = "DELETE FROM doctor_educationalqualification_mapping
                WHERE doctorId = '$doctorId';";

    if (mysqli_query($connection, $sql) && mysqli_query($connection, $deleteDocEdu)) {
        return true;
    } else {
        false;
    }
}

function getPrescriptionData($prescriptionId) {
    $connection = db();
    $mainArray = array();

    $sql = "CALL total_prescription_generate('$prescriptionId');";
    $flag = mysqli_multi_query($connection, $sql);
    if ($flag) {
        $i = 0;
        do {
            if ($result = mysqli_store_result($connection)) {
                $mainArray[$i] = array();
                while ($row = mysqli_fetch_row($result)) {
                    $mainArray[$i][] = $row;
                }
                $i++;
                mysqli_free_result($result);
            }
        } while (mysqli_more_results($connection) && mysqli_next_result($connection));
    }
    return $mainArray;
}

function getAllDurationType(){
    $connection = db();
    $sql = "SELECT id,typeName FROM duration_type where id != 5;";
    $result = mysqli_query($connection, $sql);
    
    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    return $rows;
}

function getDrugByTypeId($typeId,$drugName){
    $connection = db();
    $sql = "SELECT id,drugName FROM drug where drugName like "."'%".$drugName."%'"." and typeID = '$typeId';";
    $result = mysqli_query($connection, $sql);
    
    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    return $rows;
}

function getStrengthByDrugId($drugId){
    $connection = db();
    $sql = "SELECT id,strengthName FROM drug_strength where id in (select strengthId from drug_drugstrength_mapper where drugId = '$drugId' ); ";
    //echo $sql; exit();
    $result = mysqli_query($connection, $sql);
    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    return $rows;
}

?>

