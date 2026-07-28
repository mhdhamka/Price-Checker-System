<div class="topic-author">

    <div class="author-info">

        <span class="author-icon">

            <i class="fa fa-user-circle"></i>

        </span>

        <span>

            Started by

            <strong>

                <?php echo htmlspecialchars($post['fullName']); ?>

            </strong>

        </span>

    </div>

    <span class="author-divider"></span>

    <div class="date-info">

        

            <i class="fa-solid fa-clock"></i>

        

        <span>

            <?php echo date("d M Y",strtotime($post['created_at'])); ?>

        </span>

    </div>

</div>