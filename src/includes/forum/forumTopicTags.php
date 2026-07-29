<?php

if(empty($post['topicTags']))
{
    return;
}


$tags = explode(",", $post['topicTags']);

?>


<div class="topic-tags">


<?php foreach($tags as $tag){ 

    $tag = trim($tag);

    if($tag=="")
    {
        continue;
    }

?>


    <span class="topic-tag">

        <i class="fa-solid fa-tag"></i>

        <?php echo htmlspecialchars($tag); ?>

    </span>


<?php } ?>


</div>