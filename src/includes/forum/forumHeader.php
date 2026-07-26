<?php

if($pageType=="admin")
{
    $dashboardLink="../admin/dashboard.php";
    $dashboardText="Admin Dashboard";
}
else
{
    $dashboardLink="../student/dashboard.php";
    $dashboardText="Student Dashboard";
}

?>

<br>

<a href="<?php echo $dashboardLink; ?>" class="back-dashboard-btn">

    <i class="fa fa-arrow-left"></i>

    <?php echo $dashboardText; ?>

</a>

<div class="community-heading">

    <div>

        <h2>
            Community <em>Forum</em>
        </h2>

        <p>
            Discuss products, compare prices, ask questions and help fellow students.
        </p>

    </div>

    <?php if(!$isAdmin){ ?>

        <a href="#" id="openCreateTopic" class="community-btn">

            <i class="fa fa-plus"></i>

            Create Discussion

        </a>

    <?php } ?>

</div>

<br>