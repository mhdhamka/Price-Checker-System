<div class="topic-stats">

        <span>

            <i class="fa fa-eye"></i>

            <?php echo $post['views']; ?>

            Views

        </span>

        <span>
            <a class="topic-stat-link" href="../<?php echo $pageType; ?>/viewTopic.php?id=<?php echo $post['topicID']; ?>">

                <i class="fa fa-comment"></i>

                <?php echo $post['totalReplies']; ?>

                Replies

            </a>
        </span>


        <?php if(!$isAdmin){ ?>

        <?php if($post['studentID']==$studentID){ ?>

            <?php include("../includes/forum/forumTopicOwnerActions.php"); ?>

        <?php } ?>

            <span>

                    <a href="#" class="like-btn" data-id="<?php echo $post['topicID']; ?>">

                        <i class="fa <?php echo ($post['userLiked']) ? 'fa-heart' : 'fa-heart-o'; ?>"></i>

                    </a>

                <span class="like-count">

                    <?php echo $post['totalLikes']; ?>

                </span>

            </span>


                <span>
                    <a href="#" class="bookmark-btn" data-id="<?php echo $post['topicID']; ?>">

                        <i class="fa <?php echo $post['userBookmarked'] ? 'fa-bookmark' : 'fa-bookmark-o'; ?>"></i>

                    </a>

                <span class="bookmark-count">

                    <?php echo $post['totalBookmarks']; ?>

                </span>

            </span>

        <?php } else { ?>

            <span class="admin-actions">

                <a href="#" class="topic-action">

                    <i class="fa fa-thumb-tack"></i>

                </a>

                <a href="#" class="topic-action">

                    <i class="fa fa-lock"></i>

                </a>

                <a href="#" class="topic-action delete">

                    <i class="fa fa-trash"></i>

                </a>

            </span>

        <?php } ?>

    </div>