<?php
    include("../../includes/functions/session.php");
    authonticate();
    include("../../includes/functions/db_connection.php");
    include("../../includes/functions/functions.php");
    include("../../includes/functions/db_all_select_statement.php");
    include("../../includes/layouts/view_support_function.php");
    $userId = $_SESSION['UserId'];
    $presRows = getAllPrescriptionAccordingtoCurrentUser($userId);
    
?>

<html>
<?php echo attachedHeader('prescriptions'); ?>
    
<?php include ("../index.php"); ?>
    <!-- /.container-fluid -->

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><center>All Prescription</center>
                            </h2>

                        </div>
                        <div class="panel">

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover specialCollapse">
                                            <thead>
                                                <tr>
                                                    <td>SL</td>
                                                    <td>Patient Name</td>
                                                    <td>patient Code</td>
                                                    <td>Visiting Date(dd-MM-YY)</td>
                                                    <td>Next Visit Date(dd-MM-YY)</td>
                                                    <td>Action's</td>
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <?php $c = 1; foreach ($presRows as $row){?>
                                                <tr>
                                                <td><?php echo $c++; ?></td>
                                                <td><?php echo $row['patientName']; ?></td>
                                                <td><?php echo $row['patientCode']; ?></td>
                                                <td><?php echo $row['entryDate']; ?></td>
                                                <td><?php if($row['nextvisitingdate'] != '01-01-70'){ echo $row['nextvisitingdate'];}else{ echo 'No Need';} ?></td>

                                                <td><a data-toggle="tooltip" data-placement="top"  data-original-title="Edit Prescription" class="btn btn-info" href="<?php echo '../../views/public/edit_prescription.php?id='.$row['id'].'&patientId='.$row['patientId']; ?>">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <a data-toggle="tooltip" data-placement="top"  data-original-title="View&Print" class="btn btn-info" target="blank" href="<?php echo '../../views/public/pdf_of_current_prescription.php?id='.$row['id']; ?>" >
                                                        <span class="glyphicon glyphicon-book"></span>
                                                    </a>
                                                    
                                                     <a data-toggle="tooltip" data-placement="top"  data-original-title="New Followup" class="btn btn-info" target="blank" href="<?php echo '../../views/public/new_followup_with_old_prescription.php?id='.$row['id'].'&patientId='.$row['patientId']; ?>" >
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
<script src="../../assets/BSBTheme/js/pages/ui/tooltips-popovers.js"></script>
<script src="../../assets/BSBTheme/js/demo.js"></script>
<?php
// 5. Close database connection
//if (isset($connection)) {
//    mysqli_close($connection);
//}
?>

</body>
</html>

