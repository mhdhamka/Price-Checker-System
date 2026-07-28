<div class="forum-modal" id="editTopicModal">

    <div class="topic-modal-box">

        <div class="topic-modal-header">

            <div class="topic-title-area">

                <div class="topic-modal-icon edit">

                    <i class="fa fa-pencil"></i>

                </div>

            <div>

                <h3>

                    Edit Discussion

                </h3>


                <p>

                    Update your discussion details

                </p>

            </div>


        </div>

        <span class="close-edit-topic modal-close-icon">

            <i class="fa fa-times"></i>

        </span>

    </div>


    <form id="editTopicForm">

        <input type="hidden" name="topicID" id="editTopicID">

        <div class="topic-modal-body">

            <div class="topic-form-group">


                <label>

                    <i class="fa fa-heading"></i>

                    Discussion Title

                </label>


                <input type="text" name="topicTitle" id="editTopicTitle"
                maxlength="150" required>


            </div>


            <div class="topic-form-group">

                <label>

                    <i class="fa fa-folder"></i>

                    Category

                </label>

                <select name="categoryID" id="editCategoryID">

                    <?php

                    mysqli_data_seek($categoryQuery,0);


                    while($cat=mysqli_fetch_assoc($categoryQuery)){

                    ?>

                    <option value="<?php echo $cat['categoryID']; ?>">


                        <?php echo htmlspecialchars($cat['categoryName']); ?>


                    </option>


                    <?php } ?>


                </select>


            </div>

            <div class="topic-form-group">

                <label>

                    <i class="fa fa-align-left"></i>

                    Discussion

                </label>

                <textarea id="editTopicContent" name="topicContent"
                maxlength="2000" rows="8"></textarea>

            </div>

        </div>


        <div class="topic-modal-footer">


            <button type="button" class="topic-cancel-btn">

                Cancel

            </button>

            <button class="topic-submit-btn">

                <i class="fa fa-save"></i>

                Save Changes

            </button>


        </div>


    </form>


</div>


</div>