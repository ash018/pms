<?php
include("../../includes/functions/session.php");
authonticate();
include("../../includes/functions/db_connection.php");
include("../../includes/functions/functions.php");
include("../../includes/layouts/view_support_function.php");

$prescriptionId = $_GET['id'];
$lastGeneratedPrescription = getPrescriptionData($prescriptionId);

//print_r('<pre />'); print_r($lastGeneratedPrescription); exit();
?>
<html>
    <?php echo prescriptionCreateHeader('PDF Of Prescription');?>
    <body>
        <br />
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card  col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header col-md-push-5 col-lg-2 col-md-2 col-sm-2 col-xs-2">
<!--                        <input id="generatepdf" type="button" class="btn btn-success" value="PDF"/>-->
                        
                        <input id="printprescription" type="button" class="btn btn-success" value="Print" onclick="printDiv('printablearea')"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic Card -->
            <div id="printablearea" class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card  col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <h2><?php echo $lastGeneratedPrescription[5][0][1]; ?>
                                    <small><?php foreach ($lastGeneratedPrescription[6] as $dd) {
                                    echo $dd[0] . ',';
                                    } ?></small>
                                    <small><?php echo $lastGeneratedPrescription[5][0][4]; ?></small>   
                                </h2>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <h6><?php echo $lastGeneratedPrescription[5][0][2]; ?></h6>
                                <h6><?php echo $lastGeneratedPrescription[5][0][3]; ?></h6>
                            </div>
                        </div>


                    
                    <div class="body">
                        <table class="table table-boder">
                            <tr><td class="font-bold">Patient</td><td><p><?php echo $lastGeneratedPrescription[1][0][0]; ?></p></td>
                                <td class="font-bold">Code</td><td><small><?php echo $lastGeneratedPrescription[1][0][1]; ?></small></td>
                                <td class="font-bold">Age</td><td><small><?php echo $lastGeneratedPrescription[1][0][2]; ?></small></td>
                                <td class="font-bold">Gender</td><td><small><?php if($lastGeneratedPrescription[1][0][3] == 1){ echo 'Male';}else{echo 'Femail';} ?></small></td>
                                <td class="font-bold">Mobile</td><td><small><?php echo $lastGeneratedPrescription[1][0][4]; ?></small></td>
                                <td class="font-bold">Address</td><td><small><?php echo $lastGeneratedPrescription[1][0][5]; ?></small></td>
                                <td class="font-bold">Date</td><td><small><?php echo date("d-m-Y", strtotime( $lastGeneratedPrescription[0][0][6])); ?></small></td></tr>
                        </table>
                        <br/>
                        
                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <?php if(isset($lastGeneratedPrescription[2]) && sizeof($lastGeneratedPrescription[2])>0){echo '<h5>Examination</h5>'; }?>
                                <ul>
                                    <?php foreach ($lastGeneratedPrescription[2] as $row){
                                      echo '<li> '.$row[0].' ' . $row[1].'</li>';
                                    }?>
                                </ul>
                                <br/>
                               <?php if(isset($lastGeneratedPrescription[3]) && sizeof($lastGeneratedPrescription[3])>0){echo '<h5>Investigation</h5>'; }?> 
                                <ul>
                                    <?php foreach ($lastGeneratedPrescription[3] as $row){
                                      echo '<li> '.$row[0].' ' . $row[1].'</li>';
                                    }?>
                                </ul>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <?php if(isset($lastGeneratedPrescription[4]) && sizeof($lastGeneratedPrescription[4])>0){echo '<h3>Rx:</h3>'; }?> 
                                <ul>
                                    <?php foreach ($lastGeneratedPrescription[4] as $row){
                                      echo '<li> '.$row[0].' ' . $row[1].' '.$row[2].' '.$row[5].' '.$row[6].' '.$row[7].' '.$row[8].'</li>';
                                    }?>
                                </ul>
                                
                            </div>
                        
                        </div>
                        
                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <?php if(isset($lastGeneratedPrescription[2]) && sizeof($lastGeneratedPrescription[2])>0){echo '<h7>Next Visiting Date: '.date("d-m-Y", strtotime( $lastGeneratedPrescription[0][0][7])).'</h7>'; }?>
                                <ul>
                                    
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 right">
                                <h4><small>Doctor Signature</small></h4>
                                
                            </div>
                        
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../assets/BSBTheme/plugins/jquery/jquery.min.js"></script>
        <script src="../../assets/BSBTheme/js/jspdf.min.js"></script>
        <!-- #END# Basic Card -->
        <script type="text/javascript">
            function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;

                    document.body.innerHTML = printContents;

                    window.print();

                    document.body.innerHTML = originalContents;
               }
            
            $(document).ready(function () {
            var doc = new jsPDF();
            var specialElementHandlers = {
                '#editor': function (element, renderer) {
                    return true;
                }
            };

            $('#generatepdf').click(function () {   
                doc.fromHTML($('#printDiv').html(), 15, 15, {
                    'width': 170,
                        'elementHandlers': specialElementHandlers
                });
                doc.save('sample-file.pdf');
            });
        });
        </script>



    </body>
</html>




