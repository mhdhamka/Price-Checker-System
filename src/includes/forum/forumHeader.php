<?php

if($pageType=="admin")
{
    $dashboardLink="../admin/dashboard.php";
    $dashboardText="Admin Dashboard";
    $dashboardIcon="fa-dashboard";
}
else
{
    $dashboardLink="../student/dashboard.php";
    $dashboardText="Student Dashboard";
    $dashboardIcon="fa-home";
}

?>

<br>


<a href="<?php echo $dashboardLink; ?>" class="back-dashboard-btn">

    <i class="fa <?php echo $dashboardIcon; ?>"></i>

    <span>
        <?php echo $dashboardText; ?>
    </span>

</a>


<div class="community-heading">


    <div class="community-title">


        <div class="community-icon">

            <i class="fa fa-commenting"></i>

        </div>


        <div>

            <h2>
                Community <em>Forum</em>
            </h2>


            <p>
                Discuss products, compare prices, ask questions and help fellow students.
            </p>


        </div>


    </div>



    <?php if(!$isAdmin){ ?>


        <a href="#" id="openCreateTopic" class="community-btn">


            <i class="fa fa-plus-circle"></i>


            Create Discussion


        </a>


    <?php } ?>


</div>


<br>