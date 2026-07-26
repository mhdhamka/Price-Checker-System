<div class="reply-header">

    <div class="reply-user">

        <img

        src="<?php echo !empty($reply['studentIMG']) ? $reply['studentIMG'] : '../../assets/images/profile/default.png'; ?>"

        class="reply-avatar">

        <div>

            <strong>

                <?php echo htmlspecialchars($reply['fullName']); ?>

            </strong>

            <br>

            <small>

                <i class="fa fa-clock-o"></i>

                <?php echo date("d M Y h:i A",strtotime($reply['created_at'])); ?>

            </small>

        </div>

    </div>

</div>