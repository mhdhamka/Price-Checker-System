$(document).ready(function(){



function loadTopics(url)
{


    $(".forum-center").css("opacity","0.5");


    $.ajax({

        url:url,

        type:"GET",

        success:function(data)
        {

            $(".forum-center").html(data);

            $(".forum-center").css("opacity","1");

        },


        error:function()
        {

            alert("Failed loading topics");

        }


    });


}




// SEARCH WHILE TYPING

$("#topicSearch").on("keyup",function(){


    let keyword=$(this).val();


    $.ajax({

        url:"../student/processes/forum/searchTopic.php",

        type:"GET",

        data:{
            search:keyword
        },


        success:function(data)
        {

            $(".forum-center").html(data);

        }


    });



});





// FILTER BUTTON
$("#filterTopicBtn").click(function(){


    let category=$("#topicCategory").val();

    let sort=$("#topicSort").val();

        $.ajax({

            url:"../student/processes/forum/filterTopic.php",

            type:"GET",

            data:{

                category:category,
                sort:sort

            },

            success:function(data)
            {

            $(".forum-center").html(data);


            }


});



});





});




$("#topicSearch").keyup(function(){


let keyword=$(this).val();



if(keyword.length < 2)
{
    $(".search-suggestions").hide();
    return;
}



$.ajax({

url:"/pricechecker/src/student/processes/forum/suggestionTopic.php",

type:"GET",

data:{
q:keyword
},


success:function(data)
{

$(".search-suggestions")
.html(data)
.show();


}


});


});