<!-- Menu -->
<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
            <a href="../public/home.php">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>
        <?php
        if (isset($_SESSION["UserTypeId"])){
            if($_SESSION["UserTypeId"] == 1){
        ?>
        <li class="">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">swap_calls</i>
                <span>Admin Panel</span>
            </a>
            <ul class="ml-menu">
                <li class="">
                    <a href="../admin/user_create.php">User Create</a>
                </li>
                <li class="">
                    <a href="../admin/user_list.php">User List</a>
                </li>
            </ul>
        </li>
        <?php
            }
        }
        ?>
        <?php
        if (isset($_SESSION["UserTypeId"])){
            if($_SESSION["UserTypeId"] == 2){
        ?>
        <li class="">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">swap_calls</i>
                <span>Patient</span>
            </a>
            <ul class="ml-menu">
                <li class="">
                    <a href="../public/all_patient_view.php">Patient List</a>
                </li>
                <li class="">
                    <a href="../public/new_patient.php">New Patient</a>
                </li>
            </ul>
        </li>
        
        <li class="">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">swap_calls</i>
                <span>Prescription</span>
            </a>
            <ul class="ml-menu">
                <li class="">
                    <a href="../public/all_prescription_view.php">Prescription List</a>
                </li>
                <li class="">
                    <a href="../public/all_followup_prescription.php">Followup List</a>
                </li>
                
            </ul>
        </li>
        <?php
            }
        }
        ?>
        
        

    </ul>
</div>
<!-- #Menu -->