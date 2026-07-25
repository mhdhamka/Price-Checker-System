<div class="topic-card">

    <!-- =========================
         TOP BADGES
    ========================== -->

    <div class="topic-top">

        <?php include("../includes/forum/forumTopicBadges.php"); ?>

    </div>


    <!-- =========================
         TITLE
    ========================== -->

    <h3 class="topic-title">

        <a href="../<?php echo $pageType; ?>/viewTopic.php?id=<?php echo $post['topicID']; ?>">

            <?php echo htmlspecialchars($post['topicTitle']); ?>

        </a>

    </h3>


    <!-- =========================
         AUTHOR
    ========================== -->

    <?php include("../includes/forum/forumTopicAuthor.php"); ?>



    <!-- =========================
         STATS
    ========================== -->

    <?php include("../includes/forum/forumTopicStats.php"); ?>


    <!-- =========================
         LAST REPLY
    ========================== -->

    <?php include("../includes/forum/forumTopicLastReply.php"); ?>

    

</div>