<?php require_once("../../includes/functions/session.php"); authonticate(); ?>
<?php require_once("../../includes/functions/db_connection.php"); ?>
<?php require_once("../../includes/functions/functions.php"); ?>
<?php require_once("../../includes/functions/db_all_select_statement.php"); ?>
<?php require_once("../../includes/functions/db_all_script.php"); ?>



<?php
function generaterandomnumber($size){
    $alpha_key = '';
    $keys = range('A', 'Z');
    for ($i = 0; $i < 2; $i++) {
        $alpha_key .= $keys[array_rand($keys)];
    }
    $length = $size - 2;
    $key = '';
    $keys = range(0, 9);
    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    $finalid = $alpha_key . $key;
    return  trim($finalid);
    
}
//Generate random number 
function random_num($size) {
    
    //echo '<pre/>'.print_r($size);exit();
    $finalid = generaterandomnumber($size);
 
    $allpatientId = getAllPrescriptionIdGeneration();
   // echo '<pre/>'.print_r($allpatientId);exit();
    for($patient = 0; $patient<sizeof($allpatientId); $patient++){
        if($finalid == $allpatientId[$patient]){
           random_num($size);
           break;
        }
        else{
            insertIntoPatientIdGeneration($finalid);
            return $finalid;
        }
    }
   
}
?>

<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>new patient</title>

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
                <!-- /.container-fluid -->
                
        <section class="content">
        <div class="container-fluid">
            <div class="block-header">
<!--                <h2><center>
                        
                    </center>
                </h2>-->
            </div>
            <!-- Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><center>New Patient</center>
                            </h2>

                        </div>

                        <div class="body">
                            <form class="form-horizontal" method="post" action="insert_new_patient.php">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="patientCode">Patient Code</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="patientCode" readonly="true" name="PatientCode" class="form-control" value=<?php  echo random_num(8);?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="patientName">Patient Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="PatientName" name="PatientName" class="form-control" placeholder="Patient Name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="patientAge">Age</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number"  class="form-control" name="DOB" placeholder="Enter current Age" style="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="patientGender">Gender</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="Sex" class="form-control" required>
                                                    <option value="" selected='selected'>Select Option</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="mobileNumber">Mobile Number</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="ContactNo" placeholder="Contact No" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="address">Address</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="Address" placeholder="Address" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="row clearfix js-sweetalert">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <center><input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Save" data-type="success" name="submit"></center>
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
                
<script src="../../assets/BSBTheme//plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../../assets/BSBTheme/plugins/bootstrap/js/bootstrap.js"></script>

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
<!--    <script src="../../assets/BSBTheme/plugins/nouislider/nouislider.js"></script>-->

<!-- Waves Effect Plugin Js -->
<script src="../../assets/BSBTheme/plugins/node-waves/waves.js"></script>

<!-- Custom Js -->
<script src="../../assets/BSBTheme/js/admin.js"></script>
<!--    <script src="../../assets/BSBTheme/js/pages/forms/advanced-form-elements.js"></script>-->
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