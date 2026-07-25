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