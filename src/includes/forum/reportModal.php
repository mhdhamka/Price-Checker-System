<div class="topic-modal" id="reportModal">

    <div class="topic-modal-box">

        <div class="topic-modal-header">

            <div class="topic-title-area">

                <div class="topic-modal-icon">

                    <i class="fa-solid fa-flag"></i>

                </div>

                <div>

                    <h3>
                        Report Content
                    </h3>

                    <p>
                        Tell us why this content should be reviewed.
                    </p>

                </div>


            </div>

            <span class="close-report-modal modal-close-icon">

                <i class="fa fa-times"></i>

            </span>


        </div>

        <form id="reportForm">

            <input type="hidden" name="topicID" id="reportTopicID">

            <input type="hidden" name="replyID" id="reportReplyID">

            <div class="topic-modal-body">

                <div class="topic-form-group">

                    <label>

                        <i class="fa-solid fa-circle-exclamation"></i>
                        Reason

                    </label>

                    <select name="reason" required>

                        <option value="">
                            Select reason
                        </option>

                        <option value="Spam">
                            Spam
                        </option>

                        <option value="Offensive">
                            Offensive content
                        </option>

                        <option value="Wrong Information">
                            Wrong information
                        </option>

                        <option value="Other">
                            Other
                        </option>

                    </select>

                </div>

            </div>

            <div class="topic-modal-footer">

                <button type="button" class="topic-cancel-btn">

                    Cancel

                </button>

                <button type="submit" class="topic-submit-btn">

                    <i class="fa-solid fa-flag"></i>
                    Submit Report

                </button>

            </div>

        </form>

    </div>

</div>