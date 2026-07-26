<?php if($reply['studentID']==$studentID){ ?>

<div class="reply-owner-actions">

    <a

    href="#"

    class="edit-reply-btn"

    data-id="<?php echo $reply['replyID']; ?>">

        <i class="fa fa-pencil"></i>

        Edit

    </a>

    <a

    href="#"

    class="delete-reply-btn"

    data-id="<?php echo $reply['replyID']; ?>">

        <i class="fa fa-trash"></i>

        Delete

    </a>

</div>

<?php } ?>