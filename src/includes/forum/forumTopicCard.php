<div class="topic-card">

    <!-- =========================
         TOP BADGES
    ========================== -->

    <div class="topic-top">

        <?php include(__DIR__ . "/forumTopicBadges.php"); ?>

    </div>

    <!-- TAGS -->
    <?php include(__DIR__ . "/forumTopicTags.php"); ?>


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

    <?php include(__DIR__ . "/forumTopicAuthor.php"); ?>



    <!-- =========================
         STATS
    ========================== -->

    <?php include(__DIR__ . "/forumTopicStats.php"); ?>


    <!-- =========================
         REPORT ACTION
    ========================== -->

     <?php

     if(
     isset($studentID) &&
     $post['studentID'] != $studentID
     )
     {
     include(__DIR__ . "/forumTopicReportAction.php");
     }

     ?>

    <!-- =========================
         LAST REPLY
    ========================== -->

    <?php include(__DIR__ . "/forumTopicLastReply.php"); ?>

    

</div>