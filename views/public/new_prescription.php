<?php
include("../../includes/functions/session.php");
authonticate();
include("../../includes/functions/db_connection.php");
include("../../includes/functions/functions.php");
include("../../includes/functions/db_all_select_statement.php");
include("../../includes/functions/db_all_script.php");
include("../../includes/functions/config.php");
include("../../includes/layouts/view_support_function.php");



$userId = $_SESSION['UserId'];
$patientRows = getAllPatientInformationAccordingtoCurrentUser($userId);

$allDurationType = getAllDurationType();

$PatientID = $_GET['PatientID'];
$PatientCode = $_GET['PatientCode'];
$PatientName = $_GET['PatientName'];
$row = getPatinentInfoByPatientId($PatientID);

$allWhenType = getAllDrugWhentype();
$allAdviceType = getAllDrugAdviceType();

$availableTags_jsonDTN = getDrugTypeInformationForMakeJSONArray();
//$availableTags_jsonDN = getDrugInformationForMakeJSONArray();
$availableTags_jsonE = getVitalForMakeJSONArray();
$availableTags_json = getInvestigationInfForMakeJSONArray();
?>

<!DOCTYPE html>
<html>

    <?php echo prescriptionCreateHeader('New Prescription'); ?>
    <?php include ("../index.php"); ?>
    <!-- /.container-fluid -->


    <!-- Section For Patient Info Data Show -->
    <section class="content">
        
        
        
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><center>New Prescription</center>
                            </h2>

                        </div>
                        <div class="panel">

                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover specialCollapse">

                                        <tbody>

                                            <tr>
                                                <td>Patient Name</td>
                                                <td><?php echo $PatientName; ?></td>
                                                <td>Patient Age</td>
                                                <td><?php echo $row['dd']; ?></td>
                                                <td>Mobile Number</td>
                                                <td><?php echo $row['ContactNo']; ?></td>
                                                <td>Sex</td>
                                                <td><?php
                                if ($row['Sex'] == 1) {
                                    echo 'Male';
                                } else {
                                    echo 'Female';
                                }
    ?></td>

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
        
        
        <?php
        if (isset($_SESSION) && isset($_SESSION['showalert'])) {
            $ShowAlert = $_SESSION['showalert'];
            $_SESSION['showalert'] = null;
            if ($ShowAlert){?>
                <div class="alert bg-pink alert-dismissible col-lg-12 col-md-12 col-sm-12 col-xs-12" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center> <i class="material-icons">error</i> Please Make a Proper Prescription</center>
                </div>
                <?php
            }
        }
        ?>
        

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="panel">
                            <div class="panel-body">
                                <div style="width: 100%;">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <form id="newprescriptionform" action="insert_new_prescription.php" method="post">
                                                <div class="panel panel-primary" style="font-size: 12px;">
                                                    <div class="panel-heading">Medication Rule</div>
                                                    <div class="panel-body" id="medication Rule">


                                                        <div style="width: 100%;">
                                                            <!-- Left Side DIV  -->
                                                            <div style="width: 38%; float: left;">															
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="panel panel-primary" style="font-size: 12px;">
                                                                            <div class="panel-heading">Chief Complaints</div>
                                                                            <div class="panel-body" id="ChiefComplaints">
                                                                                <textarea id="prescriptionChiefComplain" class="form-control no-resize" rows="4" name="chiefComplaints" rows="4" cols="40" placeholder="Chief Complains"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.col-md-12 -->                                                        
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="panel panel-primary" style="font-size: 12px;">
                                                                            <div class="panel-heading">Examination</div>
                                                                            <div class="panel-body">
                                                                                <div class="row clearfix">
                                                                                    <div class="col-md-4 col-sm-4">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input class="form-control" id="vitalName" name=""  placeholder="Examination" type="text">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4 col-sm-4">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input class="form-control" id="NotesE" name="" placeholder="Note" type="text">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class=" col-md-4 col-sm-4">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input type="button" id="create-newE" class="btn btn-info form-control " value="Add"/>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                                <div class="" id="addexamination">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.col-md-12   container1 -->                                                        
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="panel panel-primary" style="font-size: 12px;">
                                                                            <div class="panel-heading">Investigation</div>

                                                                            <div class="panel-body">


                                                                                <div class="row clearfix">
                                                                                    <div class="col-md-4 col-sm-4">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input class="form-control" id="investigationName" name=""  placeholder="Investigation" type="text">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4 col-sm-4">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input class="form-control" id="investigationNote" name="" placeholder="Note" type="text">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class=" col-md-4 col-sm-4">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input type="button" id="create-newI" class="btn btn-info form-control " value="Add"/>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="" id="addinvestigation">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.col-md-12 -->                                                        
                                                                </div>

                                                            </div>
                                                            <!-- End Left Side DIV  -->

                                                            <!-- Right Side DIV -->
                                                            <div style="width: 58%; float: right;">

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="panel panel-primary" style="height: 500px;">
                                                                            <div class="panel-heading">Rx</div>
                                                                            <div class="panel-body nopadding">
                                                                                <div class="modal fade" id="myModal" role="dialog">
                                                                                    <div class="modal-dialog">

                                                                                        <!-- Modal content-->
                                                                                        <div class="modal-content panel panel-primary">
                                                                                            <div class="modal-header panel-heading">
                                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                <h8 class="modal-title">Add Drug</h8>
                                                                                            </div>
                                                                                            <div class="modal-body panel-body">
                                                                                                <div class="form-group">
                                                                                                    <div class="row clearfix col-lg-12 col-md-12 col-sm-12">
                                                                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                                            <label>Type</label>
                                                                                                            <input class="form-control" id="DrugTypeName" name=""  placeholder="Investigation" type="text" >
                                                                                                        </div>
                                                                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                                            <label>Drug Name</label>
                                                                                                            <input class="form-control" type="text" id="DrugName" name=""  placeholder="Drug Name">
                                                                                                        </div>
                                                                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                                            <label>Dose Initial</label>
                                                                                                            <input class="form-control" id="DoseInitial" name=""  placeholder="No Initial" type="text">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row clearfix col-lg-12 col-md-12 col-sm-12">
                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                                            <label>Times a day </label>
                                                                                                            <select class="form-control"  id="TimesaDay" name="">
                                                                                                                <?php echo optionsOfTimesaDay(); ?>					
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                                            <label>When</label>
                                                                                                            <select class="form-control"  id="When" name="">
                                                                                                                <option value="0" selected="selected">Select Option</option>
                                                                                                                <?php foreach ($allWhenType as $option) { ?>
                                                                                                                    <option value="<?php echo $option['id']; ?>">
                                                                                                                        <?php echo htmlspecialchars_decode($option['bangla'], ENT_NOQUOTES); ?> 
                                                                                                                    </option>
                                                                                                                <?php } ?>
                                                                                                            </select>
                                                                                                        </div>

                                                                                                    </div>

                                                                                                    <div class="row clearfix col-lg-12 col-md-12 col-sm-12">
                                                                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                                            <label>Interval Wise Dose </label>
                                                                                                            <input class="form-control" id="IntervalWiseDose" name=""  placeholder="0+0+0" type="text">
                                                                                                        </div>
                                                                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                                            <label>Duration</label>
                                                                                                            <select class="form-control" name="" id="Duration">
                                                                                                                <option value="0" selected="selected">Select</option>
                                                                                                                <option value="1">1</option>
                                                                                                                <option value="2">2</option>
                                                                                                                <option value="3">3</option>
                                                                                                                <option value="4">4</option>
                                                                                                                <option value="5">5</option>
                                                                                                                <option value="6">6</option>
                                                                                                                <option value="7">7</option>
                                                                                                                <option value="8">8</option>
                                                                                                                <option value="9">9</option>
                                                                                                                <option value="10">10</option>
                                                                                                                <option value="11">11</option>
                                                                                                                <option value="12">12</option>
                                                                                                                <option value="13">13</option>
                                                                                                                <option value="14">14</option>
                                                                                                                <option value="15">15</option>
                                                                                                                <option value="16">16</option>
                                                                                                                <option value="17">17</option>
                                                                                                                <option value="18">18</option>
                                                                                                                <option value="19">19</option>
                                                                                                                <option value="20">20</option>
                                                                                                                <option value="21">21</option>
                                                                                                                <option value="22">22</option>
                                                                                                                <option value="23">23</option>
                                                                                                                <option value="24">24</option>
                                                                                                                <option value="25">25</option>
                                                                                                                <option value="26">26</option>
                                                                                                                <option value="27">27</option>
                                                                                                                <option value="28">28</option>
                                                                                                                <option value="29">29</option>
                                                                                                                <option value="30">30</option>
                                                                                                                <option value="31">31</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                                            <label>Duration Type</label>
                                                                                                            <select class="form-control" id="DurationType" name="">
                                                                                                                <option value="0" selected="selected">Select</option>
                                                                                                                <option value="1">সপ্তাহ</option>
                                                                                                                <option value="2">মাস</option>
                                                                                                                <option value="3">বছর</option>
                                                                                                                <option value="4">চলবে</option>
                                                                                                                <option value="5">মাঝে মাঝে</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row clearfix col-lg-12 col-md-12 col-sm-12">

                                                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                                            <label>Drug Advice </label>
                                                                                                            <select class="form-control" id="DrugAdvice" name=""  >
                                                                                                                <option value="0" selected="selected">Select</option>
                                                                                                                <?php foreach ($allAdviceType as $advice) { ?>
                                                                                                                    <option value="<?php echo $advice['id']; ?>"><?php echo htmlspecialchars_decode($advice['bangla'], ENT_NOQUOTES); ?></option>
                                                                                                                <?php } ?>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                            <div id="modalbottombuttoncontrol" class="modal-footer">

                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <div id="medicationrule">
                                                                                    <!-- Test Editable Table -->
                                                                                    <div class="col-md-12">
                                                                                        <table id="mainTable" class="table table-striped table-bordered">
                                                                                            <tbody>

                                                                                            </tbody>

                                                                                        </table>
                                                                                    </div>


                                                                                </div>
                                                                                <input type="button" id="create-newRx" class="btn btn-info btn-xs" value="Add New"/>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.col-md-12 -->                                                        
                                                                </div>

                                                                <div class="row clearfix">
                                                                    <div class="col-md-12">
                                                                        <div class="panel panel-primary">
                                                                            <div class="panel-heading">Advice</div>
                                                                            <div class="panel-body">
                                                                                <textarea id="prescriptionAdvice" class="form-control no-resize" name="advice" rows="3" cols="65" placeholder="Advice"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.col-md-12 -->                                                        
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-md-12">
                                                                        <div class="panel panel-primary">
                                                                            <div class="panel-heading">Remarks</div>
                                                                            <div class="panel-body">
                                                                                <textarea id="prescriptionRemark" class="form-control no-resize" name="remark" rows="2" cols="65" placeholder="Remarks"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.col-md-12 -->                                                        
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-md-12">
                                                                        <div class="panel panel-primary">
                                                                            <div class="panel-heading">Next Visit</div>
                                                                            <div class="panel-body">
                                                                                <div class="row clearfix col-lg-12 col-md-12 col-sm-12">
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                        <label>Counter</label>
                                                                                        <input class="form-control" id="nextVisitDurationCount" name="nextVisitDurationCount"  type="number" placeholder="Time"/>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                        <label>Type</label>
                                                                                        <select class="form-control" id="nextVisitDurationType" name="nextVisitDurationType"  >
                                                                                        <option value="0" selected="selected">Select</option>
                                                                                        <?php foreach ($allDurationType as $dr) { ?>
                                                                                            <option value="<?php echo $dr['id']; ?>"><?php echo htmlspecialchars_decode( $dr['typeName'], ENT_NOQUOTES); ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                    </div>
                                                                                    <div id="showNextVisitingDate" class="col-lg-4 col-md-4 col-sm-4" style="display: none;">
                                                                                        <label>Next Visiting Date(yyyy-mm-dd)</label>
                                                                                        <input class="form-control" id="datepicker1" name="nextvisitdate"  type="text"/>
                                                                                    </div>
                                                                                    
                                                                                </div>
<!--                                                                                <input class="form-control" id="datepicker1" name="nextvisitdate"  type="text"/>-->
                                                                                <input type="hidden" name="patientId" value="<?php echo $PatientID; ?>"/> 
                                                                                <input type="hidden" name="patientCode" value="<?php echo $PatientCode; ?>"/>
                                                                                <input type="hidden" name="patientName" value="<?php echo $PatientName; ?>"/> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.col-md-12 -->                                                        
                                                                </div>

                                                            </div>														
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row clearfix col-md-12">
                                                    <div class=" row btn-group pull-right mt-10" >
                                                        <input type="reset" id="prescriptionReset" class="btn btn-danger waves-effect" value="Reset">
                                                        <input type="submit" id="prescriptionSave" class=" btn btn-primary waves-effect" value="Save">														
                                                    </div>
                                                    <!-- /.btn-group -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <link rel="stylesheet" href="../../assets/BSBTheme/css/jquery-ui.css" />

    <script src="../../assets/BSBTheme/plugins/jquery/jquery.min.js"></script>
<!-- <script src="../../assets/BSBTheme/js/jquery-1.12.4.js"></script>-->
    <script src="../../assets/BSBTheme/js/jquery-ui.js"></script>
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

    <script src="../../assets/BSBTheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <script src="../../assets/BSBTheme/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../assets/BSBTheme/js/admin.js"></script>

    <script src="../../assets/BSBTheme/js/pages/forms/form-validation.js"></script>

    <!-- Demo Js -->
    <script src="../../assets/BSBTheme/js/demo.js"></script>

    <script src="../../assets/BSBTheme/js/mindmup-editabletable.js"></script>
    <script src="../../assets/BSBTheme/js/prescription_create_script.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var availableTagsE = <?php echo $availableTags_jsonE; ?>;
            vitalNameAutoComplete(availableTagsE);

            var availableTags = <?php echo $availableTags_json; ?>;
            InvestigationNameAutoComplete(availableTags);
            
            var availableTagsDTN = <?php echo $availableTags_jsonDTN; ?>;
            
            drugTypeNameAutoComplete(availableTagsDTN);
            
            //var availableTagsDN = <?php //echo $availableTags_jsonDN; ?>;
            //DrugNameAutoComplete(availableTagsDN);
            drugNameAutoComplete();
            
            doseInitialAutoComplete();
        });

    </script>
</body>
</html>