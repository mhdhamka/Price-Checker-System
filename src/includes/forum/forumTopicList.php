<div class="forum-main">

    <?php if(isset($_SESSION['forum_success'])){ ?>

        <div class="forum-alert success" id="forumAlert">

            <i class="fa fa-check-circle"></i>

            <div>

                <strong>Discussion Published</strong>

                <p><?php echo $_SESSION['forum_success']; ?></p>

            </div>

        </div>

        <?php unset($_SESSION['forum_success']); ?>

    <?php } ?>


    <?php if(isset($_SESSION['forum_error'])){ ?>

        <div class="forum-alert error" id="forumAlert">

            <i class="fa fa-times-circle"></i>

            <div>

                <strong>Unable to Publish</strong>

                <p><?php echo $_SESSION['forum_error']; ?></p>

            </div>

        </div>

        <?php unset($_SESSION['forum_error']); ?>

    <?php } ?>


    <?php while($post=mysqli_fetch_assoc($communityPosts)){ ?>

        <?php include("../includes/forum/forumTopicCard.php"); ?>

    <?php } ?>

</div>