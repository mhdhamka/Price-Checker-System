$(document).ready(function(){

    /* ==========================
       ALERT
    ========================== */

    const alert=$("#forumAlert");

    if(alert.length)
    {

        setTimeout(function(){

            alert.fadeOut(800);

        },5000);

    }



    /* ==========================
       LOAD TOPIC
    ========================== */

    $(document).on("click",".edit-topic-btn",function(e){

        e.preventDefault();

        console.log("Edit clicked");

        $.post(

            "processes/forum/loadTopic.php",

            {
                topicID:$(this).data("id")
            },

            function(topic){

                $("#editTopicID").val(topic.topicID);

                $("#editTopicTitle").val(topic.topicTitle);

                $("#editTopicContent").val(topic.topicContent);

                $("#editCategoryID").val(topic.categoryID);

                $("#editTopicModal").addClass("active");

            },

            "json"

        );

    });



    /* ==========================
       UPDATE TOPIC
    ========================== */

    $("#editTopicForm").submit(function(e){

        e.preventDefault();

        console.log("topic.js loaded");

        $.post(

            "processes/forum/updateTopic.php",

            $(this).serialize(),

            function(){

                window.location.href="forum.php?updated=1";

            }

        );

    });



    /* ==========================
       DELETE TOPIC
    ========================== */

    $("#confirmDelete").click(function(){

        $.post(

            "processes/forum/deleteTopic.php",

            {
                topicID:$("#deleteTopicModal").data("id")
            },

            function(){

                window.location.href="forum.php?deleted=1";

            }

        );

    });

});