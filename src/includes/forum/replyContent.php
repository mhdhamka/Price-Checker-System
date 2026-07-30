<div class="reply-content">

    <?php

    echo nl2br(

        htmlspecialchars($reply['replyContent'])

    );

    ?>

</div>


<?php

if(
    isset($studentID) &&
    $reply['studentID'] != $studentID
)
{

    include(__DIR__ . "/replyReportAction.php");

}

?>