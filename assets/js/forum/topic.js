$(document).ready(function(){


/* ==========================
   ALERT MESSAGE
========================== */


const alert=$("#forumAlert");


if(alert.length)
{

setTimeout(function(){

alert.fadeOut(800);

},5000);

}







/* ==========================
   OPEN CREATE TOPIC MODAL
========================== */


$(document).on(
"click",
".create-topic-btn",
function(){


$("#createTopicModal")
.css({
    display:"flex",
    opacity:0
})
.animate({
    opacity:1
},200);


});









/* ==========================
   OPEN EDIT TOPIC MODAL
========================== */


$(document).on(
"click",
".edit-topic-btn",
function(e){


e.preventDefault();


let topicID=$(this).attr("data-id");

console.log("EDIT TOPIC ID:", topicID);



$.ajax({


url:"processes/forum/loadTopic.php",

type:"POST",

data:{
   topicID:topicID
},


beforeSend:function(){

    console.log("Sending:", topicID);

},

dataType:"json",


success:function(response){

    console.log(response);

    if(response.status !== "success")
    {

        showTopicToast(
            response.message,
            "error"
        );

        return;

    }


    let topic=response.data;


    $("#editTopicID")
    .val(topic.topicID);


    $("#editTopicTitle")
    .val(topic.topicTitle);


    $("#editTopicContent")
    .val(topic.topicContent);


    $("#editCategoryID")
    .val(topic.categoryID);


    $("#editTopicTags")
   .val(topic.topicTags ?? "");


    $("#editTopicModal")
    .css({
        display:"flex",
        opacity:0
    })
    .animate({
        opacity:1
    },200);


},




error:function(){


showTopicToast(
"Unable to load discussion",
"error"
);


}



});



});









/* ==========================
   CLOSE CREATE TOPIC MODAL
========================== */


$(document).on(
"click",
".close-create-topic",
function(){



$("#createTopicModal")
.fadeOut(200,function(){


$(this)
.css("display","none");


});


});









/* ==========================
   CLOSE EDIT TOPIC MODAL
========================== */


$(document).on(
"click",
".close-edit-topic",
function(){


$("#editTopicModal")
.fadeOut(200,function(){


$(this)
.css("display","none");


});


});









/* ==========================
   GENERAL CANCEL BUTTON
========================== */


$(document).on(
"click",
".topic-cancel-btn",
function(){



$(".topic-modal")
.fadeOut(200,function(){


$(this)
.css("display","none");


});


});









/* ==========================
   CLICK OUTSIDE CLOSE
========================== */


$(document).on(
"click",
".topic-modal",
function(e){



if(e.target === this)
{


$(this)
.fadeOut(200)
.css("display","none");


}


});









/* ==========================
   UPDATE TOPIC
========================== */


$("#editTopicForm").submit(function(e){


e.preventDefault();



let form=$(this);



$.ajax({


url:"processes/forum/updateTopic.php",

type:"POST",

data:form.serialize(),



success:function(){



$("#editTopicModal")
.fadeOut(200);



showTopicToast(
"Discussion updated successfully",
"success"
);



setTimeout(function(){


location.reload();


},1000);



},



error:function(){


showTopicToast(
"Update failed",
"error"
);


}



});



});









/* ==========================
   DELETE TOPIC MODAL
========================== */


$(document).on(
"click",
".delete-topic-btn",
function(){


let id=$(this).data("id");



$("#deleteTopicModal")
.data("id",id)
.css({
display:"flex",
opacity:0
})
.animate({
opacity:1
},200);



});









/* ==========================
   CONFIRM DELETE
========================== */


$("#confirmDelete").click(function(){



let topicID=$("#deleteTopicModal")
.data("id");




$.ajax({


url:"processes/forum/deleteTopic.php",

type:"POST",

data:{
topicID:topicID
},



success:function(){



showTopicToast(
"Discussion deleted",
"success"
);



setTimeout(function(){


window.location.href="forum.php";


},1000);



}



});



});









/* ==========================
   DELETE CANCEL
========================== */


$(document).on(
"click",
".delete-cancel-btn",
function(){



$("#deleteTopicModal")
.fadeOut(200);



});









/* ==========================
   ESC CLOSE
========================== */


$(document).keydown(function(e){


if(e.key==="Escape")
{
    $(".topic-modal")
    .fadeOut(200)
    .css("display","none");
}


});



/* ==========================
   CHARACTER COUNTER
========================== */


$("#editTopicTitle,#editTopicContent")
.on("input",function(){



let max=$(this).attr("maxlength");


let current=$(this).val().length;



$(this)
.closest(".topic-form-group")
.find(".topic-counter")
.text(
current+" / "+max
);



});



});









function showTopicToast(message,type){



let toast=$(

`
<div class="forum-toast ${type}">

${message}

</div>
`

);



$("body").append(toast);



setTimeout(function(){


toast.fadeOut(300,function(){

$(this).remove();

});


},2500);



}


/* ==========================
   TOPIC TAG LIMIT
========================== */


$(document).on(
"input",
"#topicTagsInput",
function(){


    let input=$(this);


    let tags=input.val()
    .split(",")
    .map(tag=>tag.trim())
    .filter(tag=>tag.length>0);



    if(tags.length > 3)
    {

        tags=tags.slice(0,3);


        showTopicToast(
            "Maximum 3 tags allowed",
            "error"
        );

    }



    $("#topicTags")
    .val(
        tags.join(",")
    );



});


/* ==========================
   EDIT TOPIC TAG LIMIT
========================== */


$(document).on(
"input",
"#editTopicTags",
function(){


    let tags=$(this)
    .val()
    .split(",")
    .map(tag=>tag.trim())
    .filter(tag=>tag!="");



    if(tags.length > 3)
    {

        tags=tags.slice(0,3);


        showTopicToast(
            "Maximum 3 tags allowed",
            "error"
        );

    }



    $(this).val(
        tags.join(",")
    );


});



/* ==========================
   OPEN REPORT MODAL
========================== */


$(document).on(
"click",
".report-topic-btn",
function(){


let topicID=$(this).data("id");


$("#reportTopicID").val(topicID);


$("#reportReplyID").val("");



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
".close-report-modal",
function(){


$("#reportModal")
.fadeOut(200);


});


$("#reportForm").submit(function(e){

e.preventDefault();


$.ajax({

url:"processes/forum/reportTopic.php",

type:"POST",

data:$(this).serialize(),


success:function(response){


$("#reportModal")
.fadeOut(200);



showTopicToast(
"Report submitted successfully",
"success"
);



},


error:function(){


showTopicToast(
"Failed to submit report",
"error"
);


}


});


});