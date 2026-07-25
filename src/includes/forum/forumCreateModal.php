<div class="forum-modal" id="createTopicModal">

    <div class="forum-create-modal">

        <div class="modal-header">

            <div>

                <h3>

                    <i class="fa fa-comments"></i>

                    Start a New Discussion

                </h3>

                <p>

                    Ask questions, share shopping tips, compare prices, or help other students make smarter purchasing decisions.

                </p>

            </div>

            <span class="close-create-topic">&times;</span>

        </div>

        <form action="processes/forum/addTopic.php" method="POST">

            <div class="forum-create-body">

                <!-- TITLE -->

                <div class="form-group">

                    <label>

                        Discussion Title

                    </label>

                    <input
                    type="text"
                    name="topicTitle"
                    placeholder="e.g. Which supermarket has the cheapest instant noodles?"
                    maxlength="150"
                    required>

                </div>



                <!-- CATEGORY -->

                <div class="form-group">

                    <label>

                        Discussion Category

                    </label>

                    <select name="categoryID" required>

                        <option value="">

                            Select a category

                        </option>

                        <?php while($category=mysqli_fetch_assoc($categoryQuery)){ ?>

                            <option value="<?php echo $category['categoryID']; ?>">

                                <?php echo htmlspecialchars($category['categoryName']); ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>



                <!-- CONTENT -->

                <div class="form-group">

                    <label>

                        Discussion Details

                    </label>

                    <textarea name="topicContent" rows="8" 
                    placeholder="Share your experience, ask a question, compare prices, recommend products, or start a discussion with the community..."
                    required></textarea>

                </div>

            </div>



            <div class="modal-footer">

                <button
                type="button"
                class="btn-cancel">

                    Cancel

                </button>

                <button
                type="submit"
                class="btn-create-topic">

                    <i class="fa fa-paper-plane"></i>

                    Publish Discussion

                </button>

            </div>

        </form>

    </div>

</div>