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

        <span class="category-badge">

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

                <i class="fa fa-clock-o"></i>

                <?php echo date("d M Y",strtotime($topic['created_at'])); ?>

            </small>

        </div>

    </div>



    <!-- ==========================
         META
    =========================== -->

    <div class="topic-header-meta">

        <span>

            <i class="fa fa-eye"></i>

            <?php echo $topic['views']; ?>

            Views

        </span>


        <span>

            <a href="#"

            class="like-btn"

            data-id="<?php echo $topic['topicID']; ?>">

                <i class="fa fa-heart-o"></i>

            </a>

            <span class="like-count">

                <?php echo $topic['totalLikes']; ?>

            </span>

        </span>


        <span>

            <a href="#" class="bookmark-btn" data-id="<?php echo $topic['topicID']; ?>">

                <i class="fa fa-bookmark-o"></i>

            </a>

            <span class="bookmark-count">

                <?php echo $topic['totalBookmarks']; ?>

            </span>

        </span>

    </div>



    <!-- ==========================
         CONTENT
    =========================== -->

    <div class="topic-description">

        <?php echo nl2br(htmlspecialchars($topic['topicContent'])); ?>

    </div>

</div>