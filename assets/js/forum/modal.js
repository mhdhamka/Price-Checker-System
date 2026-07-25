$(function(){

    /* ===========================
       CREATE MODAL
    =========================== */

    $("#openCreateTopic").click(function(){

        $("#createTopicModal").addClass("active");

    });

    $(".close-create-topic").click(function(){

        $("#createTopicModal").removeClass("active");

    });


    /* ===========================
       EDIT MODAL
    =========================== */

    $(".close-edit-topic").click(function(){

        $("#editTopicModal").removeClass("active");

    });


    /* ===========================
       DELETE MODAL
    =========================== */

    $(".btn-cancel").click(function(){

        $(".forum-modal").removeClass("active");

    });

    $(document).on("click",".delete-topic-btn",function(e){

        e.preventDefault();

        $("#deleteTopicModal")
            .data("id",$(this).data("id"))
            .addClass("active");

    });

    $(".forum-modal").click(function(e){

        if(e.target===this)
        {
            $(this).removeClass("active");
        }

    });

});