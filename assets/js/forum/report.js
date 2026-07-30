console.log("Report JS loaded");

console.log(
    "Modal:",
    $("#reportModal").length
);


/* ==========================
   OPEN TOPIC REPORT MODAL
========================== */

$(document).on(
"click",
".report-topic-btn",
function(e){

    e.preventDefault();


    let topicID=$(this).data("id");


    $("#reportTopicID").val(topicID);

    $("#reportReplyID").val("");



    // Change modal content

    $("#reportModalIcon")
    .attr(
        "class",
        "fa-solid fa-file-lines"
    );


    $("#reportModalTitle")
    .text(
        "Report Topic"
    );


    $("#reportModalDescription")
    .text(
        "Tell us why this topic should be reviewed."
    );



    $("#reportModal")
    .css({
        display:"flex",
        opacity:0
    })
    .animate({
        opacity:1
    },200);


});


/* ==========================
   OPEN REPLY REPORT MODAL
========================== */

$(document).on(
"click",
".report-reply-btn",
function(e){

    e.preventDefault();


    let replyID=$(this).data("id");


    $("#reportReplyID").val(replyID);

    $("#reportTopicID").val("");



    // Change modal content

    $("#reportModalIcon")
    .attr(
        "class",
        "fa-solid fa-comment-dots"
    );


    $("#reportModalTitle")
    .text(
        "Report Reply"
    );


    $("#reportModalDescription")
    .text(
        "Tell us why this reply should be reviewed."
    );



    $("#reportModal")
    .css({
        display:"flex",
        opacity:0
    })
    .animate({
        opacity:1
    },200);


});


/* ==========================
   CLOSE REPORT MODAL
========================== */

$(document).on(
"click",
".close-report-modal, .topic-cancel-btn",
function(){

    $("#reportModal").fadeOut(200);

    $("#reportForm")[0].reset();

    $("#reportTopicID").val("");
    $("#reportReplyID").val("");

});


/* ==========================
   SUBMIT REPORT
========================== */

$("#reportForm").submit(function(e){

    e.preventDefault();

    let url="";

    if($("#reportTopicID").val()!="")
    {

        url="processes/forum/reportTopic.php";

    }
    else if($("#reportReplyID").val()!="")
    {

        url="processes/forum/reportReply.php";

    }
    else
    {

        showTopicToast(
            "Invalid report request",
            "error"
        );

        return;

    }


    $.ajax({

        url:url,

        type:"POST",

        data:$(this).serialize(),

        dataType:"json",

        success:function(response){

            if(response.status=="success")
            {

                $("#reportModal").fadeOut(200);

                $("#reportForm")[0].reset();

                $("#reportTopicID").val("");
                $("#reportReplyID").val("");

                showTopicToast(
                    response.message,
                    "success"
                );

            }
            else
            {

                showTopicToast(
                    response.message,
                    "error"
                );

            }

        },

        error:function(){

            showTopicToast(
                "Failed to submit report",
                "error"
            );

        }

    });

});