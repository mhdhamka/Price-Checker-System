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


let topicID=$(this).data("id");



$.ajax({


url:"processes/forum/loadTopic.php",

type:"POST",

data:{
topicID:topicID
},


dataType:"json",



success:function(topic){



if(topic.error)
{

showTopicToast(
topic.error,
"error"
);

return;

}





$("#editTopicID")
.val(topic.topicID);



$("#editTopicTitle")
.val(topic.topicTitle);



$("#editTopicContent")
.val(topic.topicContent);



$("#editCategoryID")
.val(topic.categoryID);






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



$(".forum-modal")
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
".forum-modal",
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


if(e.key==="Escape"){


$(".forum-modal")
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