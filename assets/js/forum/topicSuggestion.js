$(document).ready(function(){


let timer;


$("#topicSearch").on(
"keyup",
function(){


clearTimeout(timer);


let keyword=$(this).val();


if(keyword.trim()=="")
{

    $(".search-suggestions")
    .hide()
    .html("");

    return;

}



timer=setTimeout(function(){


$.ajax({

url:"processes/forum/topicSuggestion.php",

type:"GET",

data:{
    q:keyword
},


success:function(data){


$(".search-suggestions")
.html(data)
.fadeIn(150);


}


});



},300);



});





// CLICK SUGGESTION

$(document).on(
"click",
".suggestion-item",
function(){


let id=$(this).data("id");



window.location.href=
"viewTopic.php?id="+id;



});





// close when clicking outside

$(document).click(function(e){


if(
!$(e.target).closest(".forum-search").length
)
{

$(".search-suggestions")
.hide();

}


});



});