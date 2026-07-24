<div class="forum-right">

    <!-- Statistics -->

    <div class="forum-box">

        <h4>

            Forum Statistics

        </h4>

        <div class="forum-stat">

            <span>Topics</span>

            <strong>

                <?php echo $totalTopics; ?>

            </strong>

        </div>

        <div class="forum-stat">

            <span>Replies</span>

            <strong>

                <?php echo $totalReplies; ?>

            </strong>

        </div>

        <div class="forum-stat">

            <span>Members</span>

            <strong>

                <?php echo $totalMembers; ?>

            </strong>

        </div>

    </div>



    <div class="forum-box">

        <h4>

            Trending Topics

        </h4>

        <?php

        while($trend=mysqli_fetch_assoc($trendingTopics)){

        ?>

            <a href="../<?php echo $pageType; ?>/viewTopic.php?id=<?php echo $trend['topicID']; ?>">

                <?php echo htmlspecialchars($trend['topicTitle']); ?>

            </a>

        <?php

        }

        ?>

    </div>

</div>