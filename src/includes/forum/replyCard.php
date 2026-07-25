<div class="reply-list">

    <h4>

    <i class="fa fa-comments"></i>

    Replies

    (

    <?php echo mysqli_num_rows($replyQuery); ?>

    )

    </h4>


    <?php

    if(mysqli_num_rows($replyQuery)==0){

    ?>

    <div class="no-reply">

        <i class="fa fa-comment-o fa-3x"></i>

        <p>

            No replies yet.

            <br>

            Be the first to start the discussion!

        </p>

    </div>

    <?php

    }else{

    while($reply=mysqli_fetch_assoc($replyQuery)){

    ?>

    <div class="reply-card">

        <!-- USER -->

        <div class="reply-user">

            <img

            src="<?php echo $reply['studentIMG']; ?>"

            class="rounded-circle"

            width="55"

            height="55"

            >

        </div>


        <!-- BODY -->

        <div class="reply-body">

            <div class="reply-top">

                <strong>

                    <?php

                    echo htmlspecialchars($reply['fullName']);

                    ?>

                </strong>

                <small>

                    <?php

                    echo date(

                        "d M Y h:i A",

                        strtotime($reply['created_at'])

                    );

                    ?>

                </small>

            </div>


            <div class="reply-content">

                <?php

                echo nl2br(

                    htmlspecialchars($reply['replyContent'])

                );

                ?>

            </div>


            <!-- ACTIONS -->

            <div class="reply-actions">

                <?php

                if($reply['studentID']==$studentID){

                ?>

                    <a

                    href="#"

                    class="edit-reply"

                    data-id="<?php echo $reply['replyID']; ?>"

                    >

                        <i class="fa fa-pencil"></i>

                        Edit

                    </a>

                    <a

                    href="#"

                    class="delete-reply"

                    data-id="<?php echo $reply['replyID']; ?>"

                    >

                        <i class="fa fa-trash"></i>

                        Delete

                    </a>

                <?php

                }

                ?>

            </div>

        </div>

    </div>

    <?php

    }

    }

    ?>

</div>