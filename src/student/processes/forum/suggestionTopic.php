<?php

session_start();

include("../../../config/db_cPCS.php");


$q=$_GET['q'] ?? "";


if(trim($q)=="")
{
    exit();
}


$q=mysqli_real_escape_string($conn,$q);



$sql="

SELECT

t.topicID,

t.topicTitle,

t.views,

c.categoryName


FROM forumtopic t


LEFT JOIN forumcategory c

ON t.categoryID=c.categoryID


WHERE t.status='Active'


AND

(

t.topicTitle LIKE '%$q%'

OR

t.topicContent LIKE '%$q%'

)


ORDER BY t.views DESC


LIMIT 6


";


$result=mysqli_query($conn,$sql);



if(mysqli_num_rows($result)==0)
{

?>

<div class="suggestion-empty">

    <i class="fa-solid fa-face-frown"></i>

    <span>
        No topics found
    </span>

</div>

<?php

exit();

}



?>

<div class="suggestion-header">

    <i class="fa-solid fa-fire"></i>

    Popular Topics

</div>



<?php


while($row=mysqli_fetch_assoc($result))
{


$title=$row['topicTitle'];


$titleHighlight=preg_replace(

"/(".preg_quote($q,"/").")/i",

"<mark>$1</mark>",

htmlspecialchars($title)

);



?>



<div class="suggestion-item"

data-id="<?php echo $row['topicID']; ?>">



    <div class="suggestion-icon">

        <i class="fa-solid fa-comments"></i>

    </div>



    <div class="suggestion-content">


        <div class="suggestion-title">

            <?php echo $titleHighlight; ?>

        </div>



        <div class="suggestion-meta">


            <span class="category">

                <i class="fa-solid fa-layer-group"></i>

                <?php echo $row['categoryName'] ?? "General"; ?>

            </span>



            <span>

                <i class="fa-solid fa-eye"></i>

                <?php echo $row['views']; ?>

            </span>


        </div>


    </div>



    <div class="suggestion-arrow">

        <i class="fa-solid fa-chevron-right"></i>

    </div>



</div>



<?php

}

?>