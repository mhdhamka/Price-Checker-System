<?php

session_start();

include("../../../config/db_cPCS.php");


if(!isset($_SESSION['studentID']))
{
    exit();
}


$studentID=$_SESSION['studentID'];

$isAdmin=false;

$pageType="student";



$search=$_GET['search'] ?? "";


$search=mysqli_real_escape_string($conn,$search);



$sql="

SELECT


t.*,

c.categoryName,

s.fullName,


COUNT(DISTINCT r.replyID) totalReplies,


COALESCE(fl.totalLikes,0) totalLikes,


COALESCE(fb.totalBookmarks,0) totalBookmarks,



CASE

WHEN ul.studentID IS NULL THEN 0

ELSE 1

END userLiked,



CASE

WHEN ub.studentID IS NULL THEN 0

ELSE 1

END userBookmarked



FROM forumtopic t



LEFT JOIN forumcategory c

ON t.categoryID=c.categoryID



LEFT JOIN student s

ON t.studentID=s.studentID



LEFT JOIN forumreply r

ON r.topicID=t.topicID




LEFT JOIN

(

SELECT

topicID,

COUNT(*) totalLikes

FROM forumlikes

GROUP BY topicID

) fl

ON fl.topicID=t.topicID





LEFT JOIN

(

SELECT

topicID,

COUNT(*) totalBookmarks

FROM forumbookmarks

GROUP BY topicID

) fb

ON fb.topicID=t.topicID





LEFT JOIN forumlikes ul

ON ul.topicID=t.topicID

AND ul.studentID='$studentID'




LEFT JOIN forumbookmarks ub

ON ub.topicID=t.topicID

AND ub.studentID='$studentID'



WHERE t.status='Active'

AND
(
    t.topicTitle LIKE '%$search%'

    OR

    t.topicContent LIKE '%$search%'

    OR

    c.categoryName LIKE '%$search%'

    OR

    s.fullName LIKE '%$search%'

    OR

    EXISTS
    (
        SELECT 1

        FROM forumreply fr

        WHERE fr.topicID=t.topicID

        AND fr.replyContent LIKE '%$search%'
    )
)


GROUP BY t.topicID


ORDER BY t.isPinned DESC, t.created_at DESC



";



$communityPosts=mysqli_query($conn,$sql);



include("../../../includes/forum/forumTopicList.php");


?>