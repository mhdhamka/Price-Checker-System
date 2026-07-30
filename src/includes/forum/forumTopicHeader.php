<div class="topic-header-card">


    <!-- ==========================
         BADGES
    =========================== -->

    <div class="topic-header-top">

        <?php if($topic['isPinned']){ ?>

            <span class="pin-badge">

                <i class="fa fa-thumb-tack"></i>

                Pinned

            </span>

        <?php } ?>


        <?php if($topic['isLocked']){ ?>

            <span class="lock-badge">

                <i class="fa fa-lock"></i>

                Locked

            </span>

        <?php } ?>


        <span class="category-badge">

            <span class="category-dot"></span>

            <?php echo htmlspecialchars($topic['categoryName']); ?>

        </span>


    </div>




    <!-- ==========================
         TITLE
    =========================== -->

    <h1 class="topic-header-title">

        <?php echo htmlspecialchars($topic['topicTitle']); ?>

    </h1>




    <!-- ==========================
         AUTHOR
    =========================== -->

    <div class="topic-header-author">

        <img
        src="<?php echo !empty($topic['studentIMG']) ? $topic['studentIMG'] : '../../assets/images/profile/default.png'; ?>"
        class="topic-avatar">

        <div>

            <strong>

                <?php echo htmlspecialchars($topic['fullName']); ?>

            </strong>

            <br>

            <small>

                <i class="fa-solid fa-clock"></i>

                <?php echo date("d M Y",strtotime($topic['created_at'])); ?>

            </small>

        </div>

    </div>




    <!-- ==========================
         META
    =========================== -->

    <div class="topic-stats">


        <!-- Views -->

        <span class="stat-chip views-chip">

            <i class="fa-solid fa-eye"></i>

            <strong>
                <?php echo $topic['views']; ?>
            </strong>

            <small>
                Views
            </small>

        </span>




        <!-- Likes -->

        <span class="stat-chip like-chip">

            <a href="#"
            class="like-btn"
            data-id="<?php echo $topic['topicID']; ?>">

                <i class="<?php echo $topic['userLiked'] 
                    ? 'fa-solid fa-heart' 
                    : 'fa-regular fa-heart'; ?>">
                </i>

            </a>


            <span class="like-count">

                <?php echo $topic['totalLikes']; ?>

            </span>


            <small>
                Likes
            </small>


        </span>





        <!-- Bookmark -->

        <span class="stat-chip bookmark-chip">


            <a href="#"
            class="bookmark-btn"
            data-id="<?php echo $topic['topicID']; ?>">


                <i class="<?php echo $topic['userBookmarked'] 
                    ? 'fa-solid fa-bookmark' 
                    : 'fa-regular fa-bookmark'; ?>">
                </i>


            </a>


            <span class="bookmark-count">

                <?php echo $topic['totalBookmarks']; ?>

            </span>


            <small>
                Saves
            </small>


        </span>



    </div>





    <!-- ==========================
         ACTIONS
    =========================== -->

    <div class="topic-actions">

        <!-- REPORT -->
        <?php

        if(
            isset($studentID) &&
            $topic['studentID'] != $studentID
        )
        {

            include(__DIR__ . "/forumTopicReportAction.php");

        }

        ?>

        <br>

        <!-- OWNER ACTION -->
        <?php 

        if(
            isset($studentID) &&
            $topic['studentID']==$studentID
        )
        {

            include(__DIR__ . "/forumTopicOwnerActions.php");

        }

        ?>


    </div>






    <!-- ==========================
         CONTENT
    =========================== -->

    <div class="topic-description">

        <?php echo nl2br(htmlspecialchars($topic['topicContent'])); ?>

    </div>


</div>