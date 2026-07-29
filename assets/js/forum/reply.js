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

dataType:"json",

data:{
    replyID:replyID
},


success:function(response){


if(response.status !== "success")
{

    showToast(
        response.message || "Unable to load reply",
        "error"
    );

    return;

}



let reply=response.data;



$("#editReplyContent")
.val(reply.replyContent)
.trigger("input");



$("#editReplyModal")
.css("display","flex")
.hide()
.fadeIn(200);



},


error:function(){

showToast(
"Server error loading reply",
"error"
);

}


});


});






/* ==================================================
CLOSE EDIT MODAL
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


response=response.trim();



if(response==="success")
{


$("#editReplyModal")
.fadeOut(200)
.css("display","none");



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

else
{

showToast(
"Update failed",
"error"
);


}


},


error:function(){

showToast(
"Server error",
"error"
);

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


response=response.trim();



if(response==="success")
{


$(".reply-card[data-id='"+id+"']")
.fadeOut(300,function(){

$(this).remove();

});



$("#deleteReplyModal")
.fadeOut(200)
.css("display","none");



showToast(
"Reply deleted",
"success"
);



}

else
{


showToast(
"Delete failed",
"error"
);


}


},


error:function(){

showToast(
"Server error",
"error"
);

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



let form=$(this);



let button=form.find("button");

button.prop("disabled",true);



$.ajax({

url:"processes/forum/addReply.php",

type:"POST",

data:form.serialize(),



success:function(data){



data=data.trim();



// Topic locked

if(data==="locked")
{

showToast(
"This topic is locked",
"error"
);


button.prop("disabled",false);

return;

}




if(data==="empty")
{

showToast(
"Reply cannot be empty",
"error"
);


button.prop("disabled",false);

return;

}




try{


let reply=JSON.parse(data);



let html=`

<div class="reply-card new-reply"
data-id="${reply.replyID}">


<div class="reply-avatar">

<img src="${reply.studentIMG 
? '../../assets/images/student/'+reply.studentIMG 
: '../../assets/images/profile/default.png'}">

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

catch(error)
{

showToast(
"Something went wrong",
"error"
);


}



},


error:function(){

showToast(
"Server error",
"error"
);


},


complete:function(){

button.prop("disabled",false);

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
ESC CLOSE
================================================== */


$(document).keydown(function(e){


if(e.key==="Escape")
{
    $(".reply-modal")
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