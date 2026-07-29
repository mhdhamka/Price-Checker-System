<div class="topic-stats">


    <!-- Views -->
    <span class="stat-chip views-chip">

        <i class="fa-solid fa-eye"></i>

        <strong>
            <?php echo $post['views']; ?>
        </strong>

        <small>
            Views
        </small>

    </span>



    <!-- Replies -->
    <a class="topic-stat-link stat-chip replies-chip"
       href="../<?php echo $pageType; ?>/viewTopic.php?id=<?php echo $post['topicID']; ?>">

        <i class="fa-solid fa-comments"></i>

        <strong>
            <?php echo $post['totalReplies']; ?>
        </strong>

        <small>
            Replies
        </small>

    </a>





    <?php if(!$isAdmin){ ?>



        <!-- Like -->
        <span class="stat-chip like-chip">

            <a href="#" 
               class="like-btn" 
               data-id="<?php echo $post['topicID']; ?>">

                <i class="<?php echo $post['userLiked'] 
                ? 'fa-solid fa-heart' 
                : 'fa-regular fa-heart'; ?>">
                </i>

            </a>


            <span class="like-count">

                <?php echo $post['totalLikes'] ?? 0; ?>

            </span>

        </span>





        <!-- Bookmark -->
        <span class="stat-chip bookmark-chip">


            <a href="#" 
               class="bookmark-btn" 
               data-id="<?php echo $post['topicID']; ?>">


                <i class="<?php echo $post['userBookmarked'] 
                ? 'fa-solid fa-bookmark' 
                : 'fa-regular fa-bookmark'; ?>">
                </i>


            </a>


            <span class="bookmark-count">

                <?php echo $post['totalBookmarks'] ?? 0; ?>

            </span>


        </span>





        <!-- Owner Actions LAST -->
        <?php if($post['studentID']==$studentID){ ?>

            <?php include(__DIR__ . "/forumTopicOwnerActions.php"); ?>

        <?php } ?>



    <?php } else { ?>



        <!-- ADMIN ACTIONS -->

        <!-- Pin -->
        <span class="stat-chip admin-chip">

            <a href="#"
            class="pin-topic <?php echo $post['isPinned'] ? 'active' : ''; ?>"
            data-id="<?php echo $post['topicID']; ?>">

                <i class="fa-solid fa-thumbtack"></i>

            </a>

            <span class="pin-label">

                <?php echo $post['isPinned'] ? "Pinned" : "Pin"; ?>

            </span>

        </span>



        <!-- Lock -->
        <span class="stat-chip admin-chip">

            <a href="#"
            class="lock-topic"
            data-id="<?php echo $post['topicID']; ?>">

                <i class="fa-solid fa-lock"></i>

            </a>

            <span class="lock-label">

                <?php echo $post['isLocked'] ? "Locked" : "Lock"; ?>

            </span>

        </span>



        <!-- Delete -->
        <span class="stat-chip admin-chip delete-chip">

            <a href="#"
            class="delete-topic"
            data-id="<?php echo $post['topicID']; ?>">

                <i class="fa-solid fa-trash-can"></i>

            </a>

            <span>

                Delete

            </span>

        </span>


    <?php } ?>


</div>