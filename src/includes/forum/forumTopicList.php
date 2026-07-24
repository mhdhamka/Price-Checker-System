<div class="forum-main">

    <?php while($post=mysqli_fetch_assoc($communityPosts)){ ?>

    <?php include("../includes/forum/forumTopicCard.php"); ?>

    <?php } ?>

</div>


