<div class="forum-toolbar">

    <form method="GET">

        <div class="forum-search">

            <i class="fa fa-search"></i>

            <input
                type="text"
                name="search"
                placeholder="Search topics..."
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ""; ?>"
            >

        </div>

        <select name="category">

            <option value="">All Categories</option>

            <?php

            $catQuery=mysqli_query($conn,"
            SELECT *
            FROM forumcategory
            ORDER BY categoryName
            ");

            while($cat=mysqli_fetch_assoc($catQuery))
            {

            ?>

            <option
            value="<?php echo $cat['categoryID']; ?>"

            <?php

            if(isset($_GET['category']) &&
                $_GET['category']==$cat['categoryID'])
                echo "selected";

            ?>

            >

            <?php echo $cat['categoryName']; ?>

            </option>

            <?php } ?>

        </select>

        <select name="sort">

            <option value="">Newest</option>

            <option value="views">Most Viewed</option>

            <option value="reply">Most Replies</option>

        </select>

        <button type="submit">

            <i class="fa fa-filter"></i>

            Filter

        </button>

    </form>

</div>