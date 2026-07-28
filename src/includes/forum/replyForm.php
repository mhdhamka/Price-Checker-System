<div class="reply-form-card">

    <div class="reply-form-header">

        <div class="reply-form-icon">

            <i class="fa fa-comments"></i>

        </div>

    <div>

        <h4>
            Join the Discussion
        </h4>

        <p>
            Share your opinion with the community
        </p>

    </div>

</div>


<form id="replyForm">

    <input type="hidden" name="topicID"
    value="<?php echo $topicID; ?>">

        <div class="reply-editor">


        <textarea

        id="replyContent"

        name="replyContent"

        maxlength="1000"

        placeholder="Write your reply here..."

        required></textarea>


        <div class="reply-footer">

            <span class="char-count">

                0/1000

            </span>

            <button class="community-btn">

                <i class="fa fa-paper-plane"></i>

                Post Reply

            </button>


        </div>

    </div>

</form>



</div>