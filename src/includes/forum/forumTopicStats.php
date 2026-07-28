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

        <span>
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
        </span>


        <?php if(!$isAdmin){ ?>

        <?php if($post['studentID']==$studentID){ ?>

            <?php include("../includes/forum/forumTopicOwnerActions.php"); ?>

        <?php } ?>

            <!-- Like -->
            <span class="stat-chip like-chip">

                    <a href="#" class="like-btn" data-id="<?php echo $post['topicID']; ?>">

                        <i class="<?php echo $post['userLiked'] ? 'fa-solid fa-heart' : 'fa-regular fa-heart'; ?>"></i>

                    </a>

                <span class="like-count">

                    <?php echo $post['totalLikes']; ?>

                </span>

            </span>


                <!-- Bookmark -->
            <span class="stat-chip bookmark-chip">
                <a href="#" class="bookmark-btn" data-id="<?php echo $post['topicID']; ?>">

                    <i class="<?php echo $post['userBookmarked'] ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark'; ?>"></i>

                </a>

                <span class="bookmark-count">

                    <?php echo $post['totalBookmarks']; ?>

                </span>

            </span>

        <?php } else { ?>

            <span class="admin-actions">

                <a href="#" class="topic-action">

                    <i class="fa-solid fa-thumbtack"></i>

                </a>

                <a href="#" class="topic-action">

                    <i class="fa-solid fa-lock"></i>

                </a>

                <a href="#" class="topic-action delete">

                    <i class="fa-solid fa-trash-can"></i>

                </a>

            </span>

        <?php } ?>

    </div>