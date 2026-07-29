<div class="topic-modal" id="createTopicModal">


    <div class="topic-modal-box">


        <!-- HEADER -->

        <div class="topic-modal-header">


            <div class="topic-title-area">


                <div class="topic-modal-icon">

                    <i class="fa-solid fa-comments"></i>

                </div>



                <div>

                    <h3>
                        Start a New Discussion
                    </h3>


                    <p>
                        Ask questions, share shopping tips, and help the community.
                    </p>


                </div>


            </div>




            <span class="close-create-topic modal-close-icon">

                <i class="fa fa-times"></i>

            </span>



        </div>


        <form action="processes/forum/addTopic.php" method="POST">

            <div class="topic-modal-body">

                <!-- TITLE -->
                <div class="topic-form-group">

                    <label>

                        <i class="fa-solid fa-heading"></i>

                        Discussion Title

                    </label>

                    <input type="text" name="topicTitle" maxlength="150" placeholder="Example: Cheapest Milo around UNIMAS?" required>

                </div>


                <!-- CATEGORY -->
                <div class="topic-form-group">

                    <label>

                        <i class="fa-solid fa-folder-open"></i>

                        Discussion Category

                    </label>

                    <select name="categoryID" required>


                        <option value="">

                            Select category

                        </option>


                        <?php while($category=mysqli_fetch_assoc($categoryQuery)){ ?>


                        <option value="<?php echo $category['categoryID']; ?>">


                            <?php echo htmlspecialchars($category['categoryName']); ?>


                        </option>


                        <?php } ?>


                    </select>



                </div>


                <!-- TAGS -->
                <div class="topic-form-group">

                    <label>

                        <i class="fa-solid fa-tags"></i>

                        Topic Tags

                    </label>


                    <input  type="text" id="topicTagsInput"
                    placeholder="Example: Bread, Bakery, Budget">


                    <small class="tag-help">
                        Add up to 3 tags separated by commas
                    </small>


                    <input type="hidden" name="topicTags"
                    id="topicTags">

                </div>


                <!-- CONTENT -->
                <div class="topic-form-group">


                    <label>

                        <i class="fa-solid fa-align-left"></i>

                        Discussion Details

                    </label>



                    <textarea name="topicContent" maxlength="2000" rows="8" placeholder="Share your experience, ask questions, compare prices, or recommend products..." required></textarea>

                </div>

            </div>


            <!-- FOOTER -->
            <div class="topic-modal-footer">

                <button type="button" class="topic-cancel-btn">

                    Cancel

                </button>

                <button type="submit" class="topic-submit-btn">

                    <i class="fa-solid fa-paper-plane"></i>

                    Publish Discussion

                </button>

            </div>

        </form>

    </div>

</div>