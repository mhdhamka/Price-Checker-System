/* ==========================================
VIEW RATING
========================================== */

$(function(){

    $(".view-btn").click(function(){

        const ratingID=$(this).data("id");

        $("#ratingDetails").html("<p>Loading...</p>");

        $("#ratingModal").fadeIn();

        $.ajax({

            url:"viewRating.php",

            type:"GET",

            data:{
                ratingID:ratingID
            },

            success:function(response){

                $("#ratingDetails").html(response);

            },

            error:function(){

                $("#ratingDetails").html(
                    "<p>Unable to load rating.</p>"
                );

            }

        });

    });


    $(".close-modal").click(function(){

        $("#ratingModal").fadeOut();

    });


    $("#ratingModal").click(function(e){

        if(e.target===this){

            $(this).fadeOut();

        }

    });

});


/* ==========================================
DELETE RATING
========================================== */

$(document).on("click",".delete-btn",function(){

    let id=$(this).data("id");

    let item=$(this).data("item");

    let student=$(this).data("student");


    $("#confirmIcon")
        .removeClass()
        .addClass("confirm-icon delete")
        .html('<i class="fa-solid fa-trash"></i>');


    $("#confirmTitle").text("Delete Rating");


    $("#confirmMessage").text(
        "Are you sure you want to permanently delete this rating?"
    );


    $("#confirmStudent").html(

        "<strong>"+item+"</strong><br><small>Rated by "+student+"</small>"

    );


    $("#confirmNote").text(

        "This action cannot be undone. The rating and review comment will be permanently removed from the system."

    );


    $("#confirmRatingID").val(id);


    $("#confirmBtn")
        .removeClass()
        .addClass("confirm-btn delete-confirm")
        .text("Delete Rating");


    $("#confirmForm").attr(

        "action",
        "../admin/processes/deleteRating.php"

    );


    $("#confirmModal").fadeIn();

});