/* ==========================================
       RESET PASSWORD
========================================== */
$(document).on("click", ".reset-btn", function () {

    const id = $(this).data("id");
    const name = $(this).data("name");

    $("#confirmIcon")
        .removeClass()
        .addClass("confirm-icon reset")
        .html('<i class="fa-solid fa-key"></i>');

    $("#confirmTitle").text("Reset Password");

    $("#confirmMessage").text(
        "Are you sure you want to reset the password for"
    );

    $("#confirmName").text(name);

    $("#confirmNote").text(
        "The administrator's password will be reset to the default password (12345678)."
    );

    $("#confirmID").val(id);

    $("#confirmBtn")
        .text("Reset Password")
        .removeClass()
        .addClass("confirm-btn reset-confirm");

    $("#confirmForm").attr(
        "action",
        "../admin/processes/resetPasswordAdmin.php"
    );

    $("#confirmModal").fadeIn();

});


/* ==========================================
       ENABLE ADMIN
========================================== */

$(document).on("click", ".enable-btn", function () {

    const id = $(this).data("id");
    const name = $(this).data("name");

    $("#confirmIcon")
        .removeClass()
        .addClass("confirm-icon enable")
        .html('<i class="fa-solid fa-user-check"></i>');

    $("#confirmTitle").text("Enable Administrator");

    $("#confirmMessage").text(
        "Are you sure you want to enable this administrator account?"
    );

    $("#confirmName").text(name);

    $("#confirmNote").text(
        "The administrator will immediately be able to access the system again."
    );

    $("#confirmID").val(id);

    $("#confirmBtn")
        .text("Enable Administrator")
        .removeClass()
        .addClass("confirm-btn enable-confirm");

    $("#confirmForm").attr(
        "action",
        "../admin/processes/enableAdmin.php"
    );

    $("#confirmModal").fadeIn();

});



/* ==========================================
       DISABLE ADMIN
========================================== */
$(document).on("click", ".disable-btn", function () {

    const id = $(this).data("id");
    const name = $(this).data("name");

    $("#confirmIcon")
        .removeClass()
        .addClass("confirm-icon disable")
        .html('<i class="fa-solid fa-user-slash"></i>');

    $("#confirmTitle").text("Disable Administrator");

    $("#confirmMessage").text(
        "Are you sure you want to disable this administrator account?"
    );

    $("#confirmName").text(name);

    $("#confirmNote").text(
        "The administrator will no longer be able to access the system until the account is enabled again."
    );

    $("#confirmID").val(id);

    $("#confirmBtn")
        .text("Disable Administrator")
        .removeClass()
        .addClass("confirm-btn disable-confirm");

    $("#confirmForm").attr(
        "action",
        "../admin/processes/disableAdmin.php"
    );

    $("#confirmModal").fadeIn();

});



/* ==========================================
       CLOSE MODAL ADMIN
========================================== */

$(".close-modal, .cancel-btn").click(function () {

    $("#confirmModal").fadeOut();

});

$("#confirmModal").click(function (e) {

    if (e.target === this) {

        $(this).fadeOut();

    }

});



/* ==========================================
   ADMIN SEARCH SUGGESTION
========================================== */

$("#adminSearchBox").keyup(function(){

    let search = $(this).val();


    if(search.length < 2)
    {

        $("#adminSuggestion").hide();

        return;

    }



    $.ajax({

        url:"adminSuggestion.php",

        type:"GET",

        data:{
            search:search
        },


        success:function(data){

            $("#adminSuggestion")
            .html(data)
            .fadeIn();

        },


        error:function(){

            $("#adminSuggestion")
            .html("")
            .hide();

        }


    });


});




/* ==========================================
   SELECT ADMIN SUGGESTION
========================================== */

$(document).on(
"click",
".admin-suggestion-item",
function(){


    let name=$(this).data("name");


    $("#adminSearchBox")
    .val(name);



    $("#adminSuggestion")
    .fadeOut();



});




/* ==========================================
   CLOSE ADMIN SUGGESTION
========================================== */

$(document).click(function(e){


    if(!$(e.target).closest(".admin-search-input").length)
    {

        $("#adminSuggestion").fadeOut();

    }


});