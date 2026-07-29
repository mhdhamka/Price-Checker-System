<div class="forum-toolbar">


    <div class="forum-search">

        <i class="fa fa-search"></i>

        <input type="text" id="topicSearch"
        placeholder="Search topics...">

        <div class="search-suggestions"></div>

    </div>


    <select id="topicCategory">

        <option value="">
            All Categories
        </option>


        <?php

        $catQuery=mysqli_query($conn,"
            SELECT *
            FROM forumcategory
            ORDER BY categoryName
        ");


        while($cat=mysqli_fetch_assoc($catQuery))
        {

        ?>

        <option value="<?php echo $cat['categoryID']; ?>">

            <?php echo $cat['categoryName']; ?>

        </option>


        <?php } ?>


    </select>



    <select id="topicSort">

        <option value="newest">
            Newest
        </option>


        <option value="views">
            Most Viewed
        </option>


        <option value="reply">
            Most Replies
        </option>


    </select>



    <button id="filterTopicBtn">

        <i class="fa fa-filter"></i>

        Filter

    </button>


</div>