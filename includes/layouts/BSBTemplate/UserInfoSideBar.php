
<!-- User Info -->
<div class="user-info">
    <div class="image">
        <img src=" ../../assets/BSBTheme/images/user.png" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if (isset($_SESSION["UserName"])){
    echo htmlentities($_SESSION["UserName"]);
        }
else
    echo "Guest"
    ?></div>

        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                <li role="seperator" class="divider"></li>
                <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                <li role="seperator" class="divider"></li>
                <?php
                if (isset($_SESSION["UserName"])) {
                    ?>
                <li><a href="../../views/public/logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                        <?php
                    } else {
                        ?>
                    <li><a href="../../views/public/login.php"><i class="material-icons">input</i>Sign In</a></li>
    <?php
}
?>
            </ul>
        </div>
    </div>
</div>
<!-- #User Info -->