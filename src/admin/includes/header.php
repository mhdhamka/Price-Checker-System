<?php

include("../config/db_cPCS.php");

$adminID = $_SESSION['adminID'];

$sql = "SELECT * FROM admin WHERE adminID = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $adminID);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$admin = mysqli_fetch_assoc($result);


?>

<!-- Admin Header -->
<div class="admin-header">

    <div class="header-title">
        <h3>
            Dashboard
        </h3>
    </div>

    <div class="admin-profile">

        <img src="<?php echo $admin['adminIMG']; ?>">

        <div>
            <h6>
                <?php echo $admin['adminFullname']; ?>
            </h6>

            <span>
                Administrator
            </span>

        </div>
    </div>
</div>