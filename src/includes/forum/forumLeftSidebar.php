<?php


/* ==========================
   CATEGORY DATA
========================== */


$categorySQL = "

SELECT

c.categoryID,
c.categoryName,
c.categoryDescription,

COUNT(t.topicID) AS totalTopics


FROM forumcategory c


LEFT JOIN forumtopic t

ON c.categoryID = t.categoryID

AND t.status='Active'


GROUP BY c.categoryID


ORDER BY c.categoryID ASC

";


$categoryResult=mysqli_query($conn,$categorySQL);





/* ==========================
   TOTAL TOPICS
========================== */


$totalTopicQuery=mysqli_query($conn,"

SELECT COUNT(*) AS total

FROM forumtopic

WHERE status='Active'

");


$totalTopic=mysqli_fetch_assoc($totalTopicQuery);





/* ==========================
   POPULAR TAGS
========================== */


$tagSQL="

SELECT

topicTags

FROM forumtopic

WHERE status='Active'

AND topicTags IS NOT NULL

AND topicTags != ''

";


$tagResult=mysqli_query($conn,$tagSQL);



$tagCount=[];



while($row=mysqli_fetch_assoc($tagResult)){


    $tags=explode(",",$row['topicTags']);



    foreach($tags as $tag){


        $tag=trim($tag);



        if($tag!=""){


            if(isset($tagCount[$tag])){

                $tagCount[$tag]++;

            }
            else{

                $tagCount[$tag]=1;

            }


        }


    }


}



arsort($tagCount);



?>

<div class="forum-left">


<div class="forum-box community-box">


    <?php if($isAdmin){ ?>

    <!-- ==========================
        ADMIN MODERATION MENU
    ========================== -->

    <div class="admin-forum-menu">

        <div class="admin-menu-title">

            <i class="fa-solid fa-shield-halved"></i>

            <span>
                Forum Admin
            </span>

        </div>

        <!-- MODERATION DASHBOARD -->
        <a href="forumModeration.php"
        class="admin-menu-item">


            <div class="admin-menu-icon moderation-icon">

                <i class="fa-solid fa-gauge-high"></i>

            </div>

            <div class="admin-menu-content">

                <strong>
                    Moderation Dashboard
                </strong>


                <small>
                    Overview & statistics
                </small>

            </div>


        </a>


        <!-- REPORT MANAGEMENT -->

        <a href="forumReports.php"
        class="admin-menu-item">


            <div class="admin-menu-icon report-icon">

                <i class="fa-solid fa-flag"></i>

            </div>


            <div class="admin-menu-content">


                <strong>
                    Report Management
                </strong>


                <small>
                    Review reported content
                </small>


            </div>


        </a>


        <!-- HIDDEN CONTENT -->

        <a href="forumHiddenContent.php"
        class="admin-menu-item">

            <div class="admin-menu-icon hidden-icon">

                <i class="fa-solid fa-eye-slash"></i>

            </div>


            <div class="admin-menu-content">


                <strong>
                    Hidden Content
                </strong>


                <small>
                    Restore hidden topics & replies
                </small>


            </div>


        </a>





        <!-- ANALYTICS -->

        <a href="forumReportAnalytics.php"
        class="admin-menu-item">


            <div class="admin-menu-icon analytics-icon">

                <i class="fa-solid fa-chart-line"></i>

            </div>


            <div class="admin-menu-content">


                <strong>
                    Report Analytics
                </strong>


                <small>
                    Moderation insights
                </small>


            </div>


        </a>





        <!-- AUDIT LOGS -->

        <a href="forumAuditLogs.php"
        class="admin-menu-item">


            <div class="admin-menu-icon audit-icon">

                <i class="fa-solid fa-clock-rotate-left"></i>

            </div>


            <div class="admin-menu-content">


                <strong>
                    Audit Logs
                </strong>


                <small>
                    Track admin activities
                </small>


            </div>


        </a>


    </div>



    <?php } ?>

    <hr>



    <!-- HEADER -->

    <div class="community-side-header">


        <div class="community-side-icon">

            <i class="fa fa-compass"></i>

        </div>



        <div>

            <h4>
                Explore
            </h4>


            <p>
                Find discussions
            </p>

        </div>


    </div>







    <!-- CATEGORIES -->
    <div class="category-list">

        <!-- ALL TOPICS -->


        <a href="../<?php echo $pageType; ?>/forum.php"

        class="category-item 
        <?php echo !isset($_GET['category']) ? 'active':''; ?>">

            <div class="category-icon">

                <i class="fa-solid fa-comments"></i>

            </div>

            <div class="category-info">

                <strong>

                    All Topics

                </strong>


                <small>

                    Latest discussions

                </small>

            </div>

            <span>

                <?php echo $totalTopic['total']; ?>

            </span>



        </a>

        <?php while($category=mysqli_fetch_assoc($categoryResult)){ ?>


        <?php


        $categoryIcons=[

            1=>"fa-comments",

            2=>"fa-tags",

            3=>"fa-cart-shopping",

            4=>"fa-lightbulb",

            5=>"fa-bullhorn"

        ];


        $icon=$categoryIcons[$category['categoryID']] ?? "fa-folder";


        ?>


        <a href="../<?php echo $pageType; ?>/forum.php?category=<?php echo $category['categoryID']; ?>"


        class="category-item

        <?php 

        echo (isset($_GET['category']) 
        && $_GET['category']==$category['categoryID']) 
        ? 'active':''; 

        ?>">

            <div class="category-icon">


                <i class="fa-solid <?php echo $icon; ?>"></i>


            </div>

            <div class="category-info">


                <strong>

                    <?php echo htmlspecialchars($category['categoryName']); ?>

                </strong>


                <small>

                    <?php echo htmlspecialchars($category['categoryDescription']); ?>

                </small>


            </div>

            <span>

                <?php echo $category['totalTopics']; ?>

            </span>





        </a>





        <?php } ?>




    </div>


    <!-- TAGS -->
    <div class="popular-tags">

        <div class="tags-title">


            <i class="fa fa-fire"></i>


            Popular Tags


        </div>

        <div class="tag-wrapper">


        <?php

            $displayTags=array_slice($tagCount,0,6,true);

            foreach($displayTags as $tag=>$count){

        ?>

            <a href="../<?php echo $pageType; ?>/forum.php?tag=<?php echo urlencode($tag); ?>">


                #<?php echo htmlspecialchars($tag); ?>


            </a>

        <?php } ?>

        </div>

    </div>

</div>


</div>