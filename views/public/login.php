<?php require_once("../../includes/functions/session.php"); ?>
<?php require_once("../../includes/functions/db_connection.php"); ?>
<?php require_once("../../includes/functions/functions.php"); ?>
    

<?php

if (isset($_SESSION["UserId"]))
{
    redirect_to("../index.php");
}

$username = "";

if (isset($_POST['submit'])) {


    $username = $_POST["username"];
    $password = $_POST["password"];

    $found_user = attempt_login($username, $password);
    
    if ($found_user) {
        
        $_SESSION["UserId"] = $found_user["id"];
        $_SESSION["UserName"] = $found_user["UserName"];
        $_SESSION["UserTypeId"] = $found_user["UserTypeId"];
        redirect_to("../../views/public/home.php");
    } else {

        // Failure
        $_SESSION["invalid_login_msg"] = "Username/password not found.";

    }
} 
?>

<?php $layout_context = "admin"; ?>
<?php include("../../includes/layouts/LoginHeader.php"); ?>
<div class="card">
    <div class="body">
        <form id="sign_in" action="login.php" method="post">
            <?php
            if(isset($_SESSION["invalid_login_msg"])){
                if($_SESSION["invalid_login_msg"] != ""){
                    ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION["invalid_login_msg"]?>
            </div>
                    
                    <?php
                    $_SESSION["invalid_login_msg"] = "";
                }
            }
            ?>
            
            <div class="msg">Sign in to start your session</div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="form-line">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 p-t-5">
<!--                    <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                    <label for="rememberme">Remember Me</label>-->
                </div>
                <div class="col-xs-4">
                    <input type="submit" name="submit"  class="btn btn-block bg-pink waves-effect" value="SIGN IN">
                </div>
            </div>
            
        </form>
    </div>
</div>

<?php include("../../includes/layouts/LoginFooter.php"); ?>
