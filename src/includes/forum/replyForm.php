<div class="reply-form-card">

    <h4>

        <i class="fa fa-reply"></i>

        Join the Discussion

    </h4>

    <form id="replyForm" method="POST">

        <input type="hidden" name="topicID" value="<?php echo $topicID; ?>">

        <textarea

            name="replyContent"

            id="replyContent"

            placeholder="Share your thoughts with the community..."

            required

        ></textarea>


        <div class="reply-actions">

            <button type="submit" class="community-btn">

                <i class="fa fa-paper-plane"></i>

                Post Reply

            </button>

        </div>

    </form>

</div>