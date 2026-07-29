<div class="topic-badges">


    <?php if($post['isPinned']){ ?>

        <span class="pin-badge">

            <i class="fa-solid fa-thumbtack"></i>

            <span>Pinned</span>

        </span>


    <?php } ?>



    <?php if($post['isLocked']){ ?>

        <span class="lock-badge">

            <i class="fa-solid fa-lock"></i>

            <span>Locked</span>

        </span>


    <?php } ?>



    <span class="category-badge">

        <span class="category-dot"></span>

        <?php echo htmlspecialchars($post['categoryName']); ?>

    </span>


</div>