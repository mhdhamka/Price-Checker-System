<div class="topic-card">

    <!-- =========================
         TOP BADGES
    ========================== -->

    <div class="topic-top">

        <div class="topic-badges">

            <?php if($post['isPinned']){ ?>

                <span class="pin-badge">
                    <i class="fa fa-thumb-tack"></i>
                    Pinned
                </span>

            <?php } ?>

            <span class="category-badge">

                <?php echo htmlspecialchars($post['categoryName']); ?>

            </span>

        </div>

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

    <div class="topic-author">

        <i class="fa fa-user"></i>

        Started by

        <strong>

            <?php echo htmlspecialchars($post['fullName']); ?>

        </strong>

        <span class="author-divider"></span>

        <i class="fa fa-clock-o"></i>

        <?php echo date("d M Y",strtotime($post['created_at'])); ?>

    </div>


    <!-- =========================
         STATS
    ========================== -->

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

            <span>

                    <a href="#" class="like-btn" data-id="<?php echo $post['topicID']; ?>">

                        <i class="fa fa-heart-o"></i>

                    </a>

                <span class="like-count">

                    <?php echo $post['totalLikes']; ?>

                </span>

            </span>


            <span>

                    <a href="#" class="bookmark-btn" data-id="<?php echo $post['topicID']; ?>">

                        <i class="fa fa-bookmark-o"></i>

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


    <!-- =========================
         LAST REPLY
    ========================== -->

    <div class="topic-last-reply">

        <?php if(!empty($post['lastReplyDate'])){ ?>

            <small>

                Last reply by

                <strong>

                    <?php echo htmlspecialchars($post['lastReplyBy']); ?>

                </strong>

            </small>

            <br>

            <span>

                <?php echo date("d M Y",strtotime($post['lastReplyDate'])); ?>

            </span>

        <?php } else { ?>

            <small>

                No replies yet

            </small>

        <?php } ?>

    </div>

</div>