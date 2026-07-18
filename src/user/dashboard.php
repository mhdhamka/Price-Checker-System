


<?php include __DIR__."/../includes/userHeader.php"; ?>



<main class="dashboard">
    <div class="container">

        <h1>
            Welcome back,
            <span>
                <?= htmlspecialchars($username); ?>
            </span>
        </h1>

        <p>
            Find better prices and shop smarter today.
        </p>

        <!-- Search -->
        <div class="dashboard-search">
            <input 
            type="text"
            placeholder="Search products...">

            <button>
                Search
            </button>

        </div>

        <!-- Statistics -->
        <div class="stats">
            <div class="stat-card">
                <h3>
                    Saved Items
                </h3>

                <h2>
                    0
                </h2>
            </div>

            <div class="stat-card">
                <h3>
                    Comparisons
                </h3>

                <h2>
                    0
                </h2>
            </div>

            <div class="stat-card">
                <h3>
                    Money Saved
                </h3>

                <h2>
                    RM0.00
                </h2>
            </div>
        </div>


        <!-- Recommended -->
        <section>
            <h2>
                Today's Best Deals
            </h2>

            <div class="product-grid">
                <?php

                $sql="
                SELECT *
                FROM item
                LIMIT 6
                ";

                $result=mysqli_query($conn,$sql);

                while($row=mysqli_fetch_assoc($result)){

                ?>


                <div class="product-card">
                    <img src="../<?= $row['ItemImage']; ?>">

                    <h3>
                        <?= htmlspecialchars($row['ItemName']); ?>
                    </h3>

                    <p>
                        RM <?= number_format($row['ItemPrice'],2); ?>
                    </p>

                    <a href="compare.php?item=<?=$row['ItemID'];?>">
                        Compare
                    </a>
                </div>

                <?php } ?>

            </div>
        </section>
    </div>
</main>



<?php include __DIR__."/../includes/userFooter.php"; ?>


</body>

</html>