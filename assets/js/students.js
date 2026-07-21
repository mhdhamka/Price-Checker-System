
/* ==========================================
   VIEW STUDENT MODAL
========================================== */

$(function(){

    $(".view-btn").on("click", function(){

        const studentID = $(this).data("id");

        $("#studentDetails").html("<p>Loading...</p>");

        $("#studentModal").fadeIn();

        $.ajax({

            url: "viewStudent.php",
            type: "GET",
            data: {
                studentID: studentID
            },

            success: function(response){

                $("#studentDetails").html(response);

            },

            error: function(){

                $("#studentDetails").html(
                    "<p>Unable to load student.</p>"
                );

            }

        });

    });

    $(".close-modal").click(function(){

        $("#studentModal").fadeOut();

    });

    $("#studentModal").click(function(e){

        if(e.target===this){

            $(this).fadeOut();

        }

    });

});


/* ==========================================
   RESET PASSWORD
========================================== */

$(document).on("click", ".reset-btn", function () {

    let id = $(this).data("id");
    let name = $(this).data("name");

    $("#confirmIcon")
        .removeClass()
        .addClass("confirm-icon reset")
        .html('<i class="fa-solid fa-key"></i>');

    $("#confirmTitle").text("Reset Password");

    $("#confirmMessage").text(
        "Are you sure you want to reset the password for"
    );

    $("#confirmStudent").text(name);

    $("#confirmNote").text(
        "The student's password will be reset to the default password (12345678). The student should change it after logging in."
    );

    $("#confirmStudentID").val(id);

    $("#confirmBtn")
        .text("Reset Password")
        .removeClass()
        .addClass("confirm-btn reset-confirm");

    $("#confirmForm").attr(
        "action",
        "processes/resetPassword.php"
    );

    $("#confirmModal").fadeIn();

});


/* ==========================================
   ENABLE STUDENT
========================================== */

$(document).on("click", ".enable-btn", function () {

    let id = $(this).data("id");
    let name = $(this).data("name");

    $("#confirmIcon")
        .removeClass()
        .addClass("confirm-icon enable")
        .html('<i class="fa-solid fa-user-check"></i>');

    $("#confirmTitle").text("Enable Student");

    $("#confirmMessage").text(
        "Are you sure you want to enable this student account?"
    );

    $("#confirmStudent").text(name);

    $("#confirmNote").text(
        "The student will immediately be able to log into the system again."
    );

    $("#confirmStudentID").val(id);

    $("#confirmBtn")
        .text("Enable Student")
        .removeClass()
        .addClass("confirm-btn enable-confirm");

    $("#confirmForm").attr(
        "action",
        "../admin/processes/enableStudent.php"
    );

    $("#confirmModal").fadeIn();

});


/* ==========================================
   DISABLE STUDENT
========================================== */

$(document).on("click", ".disable-btn", function () {

    let id = $(this).data("id");
    let name = $(this).data("name");

    $("#confirmIcon")
        .removeClass()
        .addClass("confirm-icon disable")
        .html('<i class="fa-solid fa-user-slash"></i>');

    $("#confirmTitle").text("Disable Student");

    $("#confirmMessage").text(
        "Are you sure you want to disable this student account?"
    );

    $("#confirmStudent").text(name);

    $("#confirmNote").text(
        "The student will no longer be able to log into the system until the account is enabled again."
    );

    $("#confirmStudentID").val(id);

    $("#confirmBtn")
        .text("Disable Student")
        .removeClass()
        .addClass("confirm-btn disable-confirm");

    $("#confirmForm").attr(
        "action",
        "../admin/processes/disableStudent.php"
    );

    $("#confirmModal").fadeIn();

});


/* ==========================================
   CLOSE MODAL
========================================== */

$(".close-modal, .cancel-btn").click(function () {

    $("#confirmModal").fadeOut();

});

$("#confirmModal").click(function (e) {

    if (e.target === this) {

        $(this).fadeOut();

    }

});