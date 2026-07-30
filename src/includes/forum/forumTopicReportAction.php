<?php

$topicID = $topicData['topicID'] ?? 0;

?>

<button 
    type="button" 
    class="topic-action-btn report-topic-btn"
    data-id="<?php echo $topicID; ?>">

    <span class="report-icon">

        <i class="fa-solid fa-flag"></i>

    </span>

    <span>
        Report
    </span>

</button>

