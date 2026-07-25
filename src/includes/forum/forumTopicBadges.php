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