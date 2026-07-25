<div class="forum-modal" id="editTopicModal">

    <div class="forum-create-modal">

        <div class="modal-header">

            <h3>

                <i class="fa fa-pencil"></i>

                Edit Discussion

            </h3>

            <span class="close-edit-topic">&times;</span>

        </div>

        <form action="processes/forum/updateTopic.php" id="editTopicForm">

            <input type="hidden" name="topicID" id="editTopicID">

            <div class="forum-create-body">

                <div class="form-group">

                    <label>Discussion Title</label>

                    <input type="text" name="topicTitle" id="editTopicTitle" required>

                </div>

                <div class="form-group">

                    <label>Category</label>

                    <select
                    name="categoryID"
                    id="editCategoryID">

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

                <div class="form-group">

                    <label>Discussion</label>

                    <textarea
                    id="editTopicContent"
                    name="topicContent"
                    rows="8"></textarea>

                </div>

            </div>

            <div class="modal-footer">

                <button
                type="button"
                class="btn-cancel">

                    Cancel

                </button>

                <button
                class="btn-create-topic">

                    <i class="fa fa-save"></i>

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</div>