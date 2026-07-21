
/* ==========================================
   VIEW STUDENT MODAL
========================================== */

$(document).ready(function(){

    $(".view-btn").click(function(e){

        e.preventDefault();

        let id = $(this).data("id");

        $("#studentDetails").html("Loading...");

        $("#studentDetails").load(
            "../admin/viewStudent.php?studentID=" + id
        );

        $("#studentModal").fadeIn();

    });

    $(".close-modal").click(function(){

        $("#studentModal").fadeOut();

    });

    $("#studentModal").click(function(e){

        if(e.target === this){

            $(this).fadeOut();

        }

    });

});