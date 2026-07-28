$(document).ready(function(){


/* ==================================================
OPEN EDIT REPLY MODAL
================================================== */


$(document).on("click",".edit-reply-btn",function(){


let replyID=$(this).data("id");


$("#editReplyID").val(replyID);



$.ajax({

url:"processes/forum/loadReply.php",

type:"POST",

data:{
replyID:replyID
},


success:function(data){


try{


let reply=JSON.parse(data);



$("#editReplyContent")
.val(reply.replyContent)
.trigger("input");



$("#editReplyModal")
.css("display","flex")
.hide()
.fadeIn(200);



}

catch(error){

showToast(
"Unable to load reply",
"error"
);

}



}


});



});







/* ==================================================
CLOSE MODALS
================================================== */


$(document).on(
"click",
".close-edit-reply,.edit-cancel",
function(){


$("#editReplyModal")
.fadeOut(200,function(){

$(this).css("display","none");

});


});





$(document).on(
"click",
"#editReplyModal",
function(e){


if(e.target.id==="editReplyModal")
{


$(this)
.fadeOut(200)
.css("display","none");


}


});









/* ==================================================
UPDATE REPLY
================================================== */


$("#editReplyForm").submit(function(e){


e.preventDefault();



let id=$("#editReplyID").val();



$.ajax({


url:"processes/forum/updateReply.php",

type:"POST",

data:$(this).serialize(),


success:function(response){



if(response.trim()=="success"){



$("#editReplyModal")
.fadeOut(200,function(){

$(this).css("display","none");

});



$(".reply-card[data-id='"+id+"']")
.find(".reply-content")
.text(
$("#editReplyContent").val()
);



showToast(
"Reply updated successfully",
"success"
);



}


else{


showToast(
"Update failed",
"error"
);


}



}



});



});








/* ==================================================
OPEN DELETE MODAL
================================================== */


$(document).on(
"click",
".delete-reply-btn",
function(){



let id=$(this).data("id");



$("#deleteReplyID")
.val(id);



$("#deleteReplyModal")
.css("display","flex")
.hide()
.fadeIn(200);



});








/* ==================================================
DELETE REPLY
================================================== */


$(document).on(
"click",
".btn-delete-reply",
function(){



let id=$("#deleteReplyID").val();




$.ajax({


url:"processes/forum/deleteReply.php",

type:"POST",

data:{
replyID:id
},



success:function(response){



if(response.trim()=="success"){



$(".reply-card[data-id='"+id+"']")
.fadeOut(300,function(){

$(this).remove();

});




$("#deleteReplyModal")
.fadeOut(200,function(){

$(this).css("display","none");

});



showToast(
"Reply deleted",
"success"
);



}

else{


showToast(
"Delete failed",
"error"
);


}



}



});



});









/* ==================================================
CLOSE DELETE MODAL
================================================== */


$(document).on(
"click",
"#deleteReplyModal",
function(e){


if(e.target.id==="deleteReplyModal")
{


$(this)
.fadeOut(200)
.css("display","none");


}



});









/* ==================================================
ADD REPLY AJAX
================================================== */


$("#replyForm").submit(function(e){


e.preventDefault();



$.ajax({


url:"processes/forum/addReply.php",

type:"POST",

data:$(this).serialize(),



success:function(data){



if(data.trim()=="empty"){


showToast(
"Reply cannot be empty",
"error"
);


return;


}



try{


let reply=JSON.parse(data);




let html=`


<div class="reply-card new-reply"
data-id="${reply.replyID}">



<div class="reply-avatar">


<img src="../../assets/images/student/${reply.studentIMG}">


</div>





<div class="reply-body">



<div class="reply-header">


<strong>

${escapeHTML(reply.fullName)}

</strong>



<span>

Just now

</span>


</div>





<p class="reply-content">

${escapeHTML(reply.replyContent)}

</p>





<div class="reply-tools">



<button
class="edit-reply-btn"
data-id="${reply.replyID}">

<i class="fa fa-edit"></i>
Edit

</button>





<button
class="delete-reply-btn"
data-id="${reply.replyID}">

<i class="fa fa-trash"></i>
Delete

</button>




</div>



</div>



</div>


`;




$(".reply-list")
.prepend(html);




$("#replyContent")
.val("")
.trigger("input");




showToast(
"Reply posted",
"success"
);




}



catch(error){


showToast(
"Something went wrong",
"error"
);


}



}



});



});










/* ==================================================
CHARACTER COUNTER
================================================== */


$("#editReplyContent,#replyContent")
.on("input",function(){



let length=$(this).val().length;



$(this)
.closest(".reply-input-area,.reply-editor")
.find(".char-count")
.text(length+"/1000");



});







/* ==================================================
ESCAPE CLOSE
================================================== */


$(document).keydown(function(e){


if(e.key==="Escape"){


$(".forum-reply-modal")
.fadeOut(200)
.css("display","none");


}


});




});








/* ==================================================
TOAST
================================================== */


function showToast(message,type){



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






/* ==================================================
HTML ESCAPE SECURITY
================================================== */


function escapeHTML(text){


return $("<div>")
.text(text)
.html();


}