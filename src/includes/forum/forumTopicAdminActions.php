<!-- ADMIN ACTIONS -->
<!-- PIN -->
<span class="stat-chip admin-chip">

    <a href="#" class="pin-topic <?php echo $topic['isPinned'] ? 'active':''; ?>"
    data-id="<?php echo $topic['topicID']; ?>">

        <i class="fa-solid fa-thumbtack"></i>

    </a>

    <span class="pin-label">

        <?php echo $topic['isPinned'] ? "Pinned":"Pin"; ?>

    </span>

</span>


<!-- LOCK -->
<span class="stat-chip admin-chip">

    <a href="#" class="lock-topic"
    data-id="<?php echo $topic['topicID']; ?>">

        <i class="fa-solid fa-lock"></i>

    </a>

    <span class="lock-label">

        <?php echo $topic['isLocked'] ? "Locked":"Lock"; ?>

    </span>


</span>



<!-- DELETE -->
<span class="stat-chip admin-chip delete-chip">

    <a href="#" class="delete-topic"
    data-id="<?php echo $topic['topicID']; ?>">

        <i class="fa-solid fa-trash-can"></i>

    </a>

    <span>

        Delete

    </span>


</span>