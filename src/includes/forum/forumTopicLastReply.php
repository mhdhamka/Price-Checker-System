<br>

<div class="topic-last-reply">


<?php if(!empty($post['lastReplyDate'])){ ?>


    <div class="last-reply-header">

        <i class="fa-solid fa-comments"></i>

        <span>
            Latest Reply
        </span>

    </div>



    <div class="last-reply-user">


        <div class="reply-mini-avatar">

            <i class="fa-solid fa-user"></i>

        </div>


        <div>


            <strong>

                <?php echo htmlspecialchars($post['lastReplyBy']); ?>

            </strong>


            <small>
                replied to this topic
            </small>


        </div>


    </div>





    <div class="last-reply-date">


        <i class="fa-regular fa-clock"></i>


        <?php echo date(
            "d M Y",
            strtotime($post['lastReplyDate'])
        ); ?>


    </div>



<?php } else { ?>


    <div class="no-last-reply">


        <i class="fa-regular fa-comment-dots"></i>


        <span>
            No replies yet
        </span>


    </div>



<?php } ?>


</div>