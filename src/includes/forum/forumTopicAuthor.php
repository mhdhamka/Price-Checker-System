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