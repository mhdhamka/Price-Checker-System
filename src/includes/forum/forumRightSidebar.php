<div class="forum-right">


    <!-- ==========================
    FORUM STATISTICS
    =========================== -->


    <div class="forum-box stats-box">


        <div class="sidebar-title">

            <div>

                <h4>
                    Forum Overview
                </h4>

                <small>
                    Community activity
                </small>

            </div>


        </div>




        <div class="stats-grid">


            <div class="stat-card">

                <div class="stat-icon topic">

                    <i class="fa fa-comments"></i>

                </div>


                <div>

                    <span>
                        Topics
                    </span>


                    <strong>
                        <?php echo $totalTopics; ?>
                    </strong>

                </div>


            </div>




            <div class="stat-card">

                <div class="stat-icon reply">

                    <i class="fa fa-reply"></i>

                </div>


                <div>

                    <span>
                        Replies
                    </span>


                    <strong>
                        <?php echo $totalReplies; ?>
                    </strong>

                </div>


            </div>





            <div class="stat-card">


                <div class="stat-icon member">

                    <i class="fa fa-users"></i>

                </div>


                <div>

                    <span>
                        Members
                    </span>


                    <strong>
                        <?php echo $totalMembers; ?>
                    </strong>

                </div>


            </div>



        </div>


    </div>






    <!-- ==========================
    TRENDING TOPICS
    =========================== -->


    <div class="forum-box trending-box">


        <div class="sidebar-title">


            <div>

                <h4>
                    Trending Topics
                </h4>

                <small>
                    Most discussed
                </small>

            </div>

        </div>





        <div class="trending-list">


        <?php while($trend=mysqli_fetch_assoc($trendingTopics)){ ?>


            <a href="../<?php echo $pageType; ?>/viewTopic.php?id=<?php echo $trend['topicID']; ?>">


                <div class="trend-number">

                    <?php echo $trend['views']; ?>

                </div>


                <div class="trend-content">


                    <p>

                    <?php echo htmlspecialchars($trend['topicTitle']); ?>

                    </p>


                    <span>

                        views

                    </span>


                </div>


            </a>


        <?php } ?>


        </div>


    </div>


</div>