<div class="reply-modal" id="editReplyModal">

    <div class="reply-edit-box">

        <div class="modal-top">

            <div class="modal-title">

                <div class="modal-icon edit">

                    <i class="fa fa-pencil"></i>

                </div>


                <div>

                    <h3>Edit Reply</h3>

                    <p>Update your response</p>

                </div>

            </div>

            <span class="close-edit-reply">

            <i class="fa fa-times"></i>

            </span>

        </div>

        <form id="editReplyForm">


            <input type="hidden" id="editReplyID" name="replyID">

            <div class="reply-input-area">

                <label>

                    <i class="fa fa-comment"></i>

                    Your Reply

                </label>

                <textarea

                id="editReplyContent"

                name="replyContent"

                maxlength="1000"

                placeholder="Write your reply..."

                required></textarea>

                <div class="char-count">

                    0/1000

                </div>


            </div>

            <div class="modal-actions">

                <button type="button" class="edit-cancel">

                    Cancel

                </button>

                <button class="save-reply-btn">

                    <i class="fa fa-save"></i>

                    Save Changes

                </button>

            </div>


        </form>



</div>


</div>