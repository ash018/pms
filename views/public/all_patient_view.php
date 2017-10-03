<?php require_once("../../includes/functions/session.php"); authonticate(); ?>

<?php require_once("../../includes/functions/functions.php"); ?>
<?php require_once("../../includes/functions/db_all_select_statement.php"); ?>
<?php

    $userId = $_SESSION['UserId'];
    $patientRows = getAllPatientInformationAccordingtoCurrentUser($userId);

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>All Patient</title>

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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><center>All Patient</center>
                            </h2>

                        </div>
                        <div class="panel">

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover specialCollapse">
                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Patient Name</td>
                                    <td>patient Code</td>
                                    <td>Mobile</td>
                                    <td>Gender</td>
                                    <td>Creation Date(dd-MM-YY)</td>
                                    <td>Action's</td>
                                </tr> 
                            </thead>
                            <tbody>
                            <?php $c = 1;
                            foreach ($patientRows as $row) { ?>
                                    <tr>
                                        <td><?php echo $c++; ?></td>
                                        <td><?php echo $row['PatientName']; ?></td>
                                        <td><?php echo $row['PatientCode']; ?></td>
                                        <td><?php echo $row['ContactNo']; ?></td>
                                        <td><?php if ($row['Sex'] == 1) {
                                    echo 'Male';
                                }   else {
                                    echo 'Female';
                                } ?></td>
                                        <td><?php echo $row['DateEntry']; ?></td>
                                        <td><a data-toggle="tooltip" data-placement="top"  data-original-title="Edit Patient" class="btn btn-info" href="<?php echo '../../views/public/edit_patient.php?id=' . $row['PatientID']; ?>" class="btn btn-primary btn-xs" data-titleedit_prescription="<?php echo $row['PatientID']; ?>" data-toggle="modal" >
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            <a data-toggle="tooltip" data-placement="top"  data-original-title="New Prescription" class="btn btn-info" href="<?php  echo '../../views/public/new_prescription.php?PatientID=' . $row['PatientID'].'&PatientCode='.$row['PatientCode'].'&PatientName='.$row['PatientName']; ?>" class="btn btn-primary btn-xs" data-title="<?php echo $row['PatientID']; ?>" data-toggle="modal" >
                                                <span class="glyphicon glyphicon-new-window"></span>
                                            </a>
                                            
                                            <a data-toggle="tooltip" data-placement="top"  data-original-title="Patient History" class="btn btn-info" href="<?php echo '../../views/public/patient_histry.php?id=' . $row['PatientID']; ?>" class="btn btn-primary btn-xs" data-title="<?php echo $row['PatientID']; ?>" data-toggle="modal" >
                                                <span class="glyphicon glyphicon-book"></span>
                                            </a>
                                        </td>
                                    </tr> 
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- /.col-md-12 -->
                </div>
            </div>
                    </div>
                </div>
            </div>

        </div>
    </section>                               




<!-- /.container-fluid -->

<!-- /.section -->


<!-- /.main-page -->

<script src="../../assets/BSBTheme/plugins/jquery/jquery.min.js"></script>

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
<script src="../../assets/BSBTheme/js/pages/ui/tooltips-popovers.js"></script>
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


