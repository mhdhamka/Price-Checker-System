<div class="reply-list">

    <h4>

        <i class="fa fa-comments"></i>

        Replies

        (<?php echo mysqli_num_rows($replyQuery); ?>)

    </h4>

    <?php if(mysqli_num_rows($replyQuery)==0){ ?>

        <?php include("../includes/forum/replyEmpty.php"); ?>

    <?php }else{ ?>

        <?php while($reply=mysqli_fetch_assoc($replyQuery)){ ?>

            <?php include("../includes/forum/replyCard.php"); ?>

        <?php } ?>

    <?php } ?>

</div>