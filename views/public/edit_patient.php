<?php require_once("../../includes/functions/session.php");authonticate(); ?>
<?php require_once("../../includes/functions/db_connection.php"); ?>
<?php require_once("../../includes/functions/functions.php"); ?>
<?php require_once("../../includes/functions/db_all_select_statement.php"); ?>
<?php require_once("../../includes/functions/db_all_script.php"); ?>
<?php require_once("../../includes/layouts/view_support_function.php");?>

<?php
    $patientId = $_GET['id'];
    $GetPatient =  array();
    $GetPatient = getPatientForEdit($patientId);
    //print_r($GetPatient); exit();
?>

<html>
    <?php echo attachedHeader('Edit Patient');?>

    
<?php include ("../index.php"); ?>

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
                            <h2><center>Edit Patient</center>
                            </h2>

                        </div>

                        <div class="body">
                            <form class="form-horizontal" method="post" action="update_newpatient.php">
                                <div class="row clearfix">
                                    <input type="hidden" class="form-control" name="PatientID" value="<?php echo $GetPatient[0]['PatientID']; ?>">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="patientCode">Patient Code</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" readonly="true" class="form-control" name="PatientCode" value="<?php echo $GetPatient[0]['PatientCode']; ?>">
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
                                                 <input  type="text" class="form-control" name="PatientName" value="<?php echo $GetPatient[0]['PatientName']; ?>" placeholder="Enter Patient Name" required>
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
                                                <input type="text" class="form-control" name="DOB" placeholder="Enter current Age" value="<?php echo $GetPatient[0]['DOB']; ?>" required>
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
                                                <select name="Sex" class="form-control"    required>
                                                    <option value="0">Select Gender</option>
                                                    <option value="1" <?php if($GetPatient[0]['Sex']==1){echo'selected';}?>>Male</option>
                                                    <option value="2" <?php if($GetPatient[0]['Sex']==2){echo'selected';}?>>Female</option>
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
                                                <input type="text" class="form-control" name="ContactNo" placeholder="Contact No" value="<?php echo $GetPatient[0]['ContactNo']; ?>" required>
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
                                                <input type="text" class="form-control" name="Address" placeholder="Address" value="<?php echo $GetPatient[0]['Address']; ?>" required>
                                            </div>
                                        </div>
                                    </div>
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
                <!-- /.section -->

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

</body>
</html>