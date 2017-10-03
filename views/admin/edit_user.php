<?php require_once("../../includes/functions/session.php");
authonticate();

manage_admin_access();
?>
<?php require_once("../../includes/functions/db_connection.php"); ?>
<?php require_once("../../includes/functions/functions.php"); ?>
<?php require_once("../../includes/functions/db_all_select_statement.php"); ?>

<?php
$userId = $_GET['id'];
$ShowAlert = false;
$role = get_all_user_type();
$education = getAllEducation();
$userEdit = editUserInfo($userId);
$userInfo = $userEdit['userInfo'];

//print_r('<pre />'); print_r($role); exit();

$doctorInfo = $userEdit['doctorInfo'];
$doctorEducation = $userEdit['doctorEducation'];
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit User</title>

        <!-- Favicon-->
        <link rel="icon" href="../../assets/BSBTheme/favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="../../assets/BSBTheme/plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="../../assets/BSBTheme/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Sweet Alert Css -->
        <link href="../../assets/BSBTheme/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

        <!-- Colorpicker Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />

        <!-- Dropzone Css -->
        <link href="../../assets/BSBTheme/plugins/dropzone/dropzone.css" rel="stylesheet">

        <!-- Multi Select Css -->
        <link href="../../assets/BSBTheme/plugins/multi-select/css/multi-select.css" rel="stylesheet">

        <!-- Bootstrap Spinner Css -->
        <link href="../../assets/BSBTheme/plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

        <!-- Bootstrap Tagsinput Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

        <!-- Bootstrap Select Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

        <!-- noUISlider Css -->
        <link href="../../assets/BSBTheme/plugins/nouislider/nouislider.min.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="../../assets/BSBTheme/css/style.css" rel="stylesheet">

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="../../assets/BSBTheme/css/themes/all-themes.css" rel="stylesheet" />
    </head>



    <?php include ("../index.php"); ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                
            </div>
            <!-- Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><center>
                                    Edit User <?php echo $userInfo[0]['UserName'];?></center>
                            </h2>

                        </div>

                        <div class="body">
                            <form class="form-horizontal" method="post" action="user_update.php">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="CreateUsername">User Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="hidden" id="userId" name="userId" value="<?php echo $userInfo[0]['id'];?>">
                                                <input readonly="readonly" type="text" id="CreateUsername" name="CreateUsername" class="form-control" placeholder="Enter Username" value="<?php echo $userInfo[0]['UserName'];?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" required="required" id="password" name="password" class="form-control" placeholder="Enter your password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group">
                                        <label for="selectRole" class="col-lg-2 form-control-label">Role</label>
                                        <div class="col-lg-10">
                                            <select class="form-control" name="selectRole"  id="selectRole">
                                                <option  value="">Select Role</option>
                                                <?php
                                                foreach ($role as $row) {
                                                    if($userInfo[0]['UserTypeId'] == $row['id']){
                                                        echo '<option selected="selected" value="' . $row['id'] . '">' . $row['typeName'] . '</option>';   
                                                    }else{
                                                        echo '<option value="' . $row['id'] . '">' . $row['typeName'] . '</option>';   
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>


                                <div id="DoctorNameDiv" class="row clearfix" style="<?php if($userInfo[0]['UserTypeId'] == 2){echo 'display: block;';}else{echo 'display: none;';}?>">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="DoctorName">Doctor Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="hidden" id="DoctorId" name="DoctorId" value="<?php if($userInfo[0]['UserTypeId'] == 2 && isset($doctorInfo[0]['DoctorID'])){echo $doctorInfo[0]['DoctorID'];}else {echo '';}?>" >
                                                <input type="text" id="DoctorName" name="DoctorName" class="form-control" placeholder="Enter Doctor Name" value="<?php if($userInfo[0]['UserTypeId'] == 2 && isset($doctorInfo[0]['DoctorName'])){ echo $doctorInfo[0]['DoctorName'];}?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="DoctorAddressDiv" class="row clearfix" style="<?php if($userInfo[0]['UserTypeId'] == 2){echo 'display: block;';}else{echo 'display: none;';}?>">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="DoctorAddress">Doctor Address</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="DoctorAddress" name="DoctorAddress" class="form-control" value="<?php if($userInfo[0]['UserTypeId'] == 2 && isset($doctorInfo[0]['DoctorAddress'])){echo $doctorInfo[0]['DoctorAddress'];} else{echo '';}?>" placeholder="Enter Doctor Address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                    
                              
                                <div id="DoctorContactDiv" class="row clearfix" style="<?php if($userInfo[0]['UserTypeId'] == 2){echo 'display: block;';}else{echo 'display: none;';}?>">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="DoctorContact">Doctor Contact</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="DoctorContact" name="DoctorContact" value="<?php if($userInfo[0]['UserTypeId'] == 2 && isset($doctorInfo[0]['Contact'])){echo $doctorInfo[0]['Contact'];}else{echo '';}?>" class="form-control" placeholder="Enter Doctor Contact">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="DoctorNotesDiv" class="row clearfix" style="<?php if($userInfo[0]['UserTypeId'] == 2){echo 'display: block;';}else{echo 'display: none;';}?>">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="DoctorNotes">Notes</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="DoctorNotes" name="DoctorNotes" value="<?php if($userInfo[0]['UserTypeId'] == 2 && isset($doctorInfo[0]['Notes'])){ echo $doctorInfo[0]['Notes'];} else{ echo '';}?>" class="form-control" placeholder="Notes about Doctor">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix" id="DoctorDegreeDiv" style="<?php if($userInfo[0]['UserTypeId'] == 2){echo 'display: block;';}else{echo 'display: none;';}?>">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            
                                                <label for="DoctorDegree" class="col-lg-2 form-control-label">Degree</label>
                                                <div class="col-lg-10">
                                                    <select id="optgroup" class="ms" multiple="multiple" name="DoctorDegree[]"  id="DoctorDegree">

                                                <?php if($userInfo[0]['UserTypeId'] == 2 && isset($doctorEducation)){
                                                        foreach ($education as $row) {
                                                            $currentOption = '';
                                                           foreach($doctorEducation as $edu){
                                                                if($edu['educationalQualificatioId'] == $row['id']){
                                                                    echo '<option selected="selected" value="' . $row['id'] . '">' . $row['certificateName'] . '</option>';
                                                                    $currentOption = $edu['educationalQualificatioId'];
                                                                }
                                                            }
                                                            if($currentOption != $row['id']){
                                                                echo '<option value="' . $row['id'] . '">' . $row['certificateName'] . '</option>';
                                                            }
                                                        }
                                                }
                                                else{
                                                    foreach ($education as $row) {
                                                        echo '<option value="' . $row['id'] . '">' . $row['certificateName'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix ">
                                    <center>
                                        <div class="form-group">
                                            <input type="checkbox" class="form-control" checked="<?php if($userInfo[0]['IsActive'] == 1){echo 'checked';}?>" id="checkbox" name="UserActive" >
                                            <label for="checkbox">Active</label>
                                        </div>
                                    </center>
                                </div>

                                <div class="row clearfix js-sweetalert">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <center><input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Update" data-type="success" name="submit"></center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Horizontal Layout -->
        </div>
    </section>


    <!-- Jquery Core Js -->
    <script src="../../assets/BSBTheme/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../assets/BSBTheme/plugins/bootstrap/js/bootstrap.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $("#selectRole").change(function () {
                if ($(this).find(":selected").val() == 2) {
                    $("#DoctorNameDiv").attr("style", "display: block");
                    $("#DoctorName").prop('required',true);
                    $("#DoctorAddressDiv").attr("style", "display: block");
                    $("#DoctorAddress").prop('required',true);
                    $("#DoctorContactDiv").attr("style", "display: block");
                    $("#DoctorContact").prop('required',true);
                    $("#DoctorNotesDiv").attr("style", "display: block");
                    $("#DoctorNotes").prop('required',true);
                    $("#DoctorDegreeDiv").attr("style", "display: block");
                    $("#DoctorDegree").prop('required',true);
                }
                else{
                    $("#DoctorNameDiv").attr("style", "display: none");
                    $("#DoctorName").prop('required',false);
                    $("#DoctorAddressDiv").attr("style", "display: none");
                    $("#DoctorAddress").prop('required',false);
                    $("#DoctorContactDiv").attr("style", "display: none");
                    $("#DoctorContact").prop('required',false);
                    $("#DoctorNotesDiv").attr("style", "display: none");
                    $("#DoctorNotes").prop('required',false);
                    $("#DoctorDegreeDiv").attr("style", "display: none");
                    $("#DoctorDegree").prop('required',false);
                }
            });


        });
    </script>

    <!-- Select Plugin Js -->
    <script src="../../assets/BSBTheme/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../assets/BSBTheme/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="../../assets/BSBTheme/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="../../assets/BSBTheme/plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="../../assets/BSBTheme/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Bootstrap Colorpicker Js -->
    <script src="../../assets/BSBTheme/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

    <!-- Dropzone Plugin Js -->
    <script src="../../assets/BSBTheme/plugins/dropzone/dropzone.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="../../assets/BSBTheme/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="../../assets/BSBTheme/plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="../../assets/BSBTheme/plugins/jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="../../assets/BSBTheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- noUISlider Plugin Js -->
    <script src="../../assets/BSBTheme/plugins/nouislider/nouislider.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../assets/BSBTheme/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../assets/BSBTheme/js/admin.js"></script>
    <script src="../../assets/BSBTheme/js/pages/forms/advanced-form-elements.js"></script>
    <script src="../../assets/BSBTheme/js/pages/forms/form-validation.js"></script>

    <!-- Demo Js -->
    <script src="../../assets/BSBTheme/js/demo.js"></script>
    <?php
// 5. Close database connection
//if (isset($connection)) {
//    mysqli_close($connection);
//}
    ?>

    

</body>
</html>

