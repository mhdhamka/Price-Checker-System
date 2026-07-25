$(document).ready(function(){

    $(document).on("click",".like-btn",function(e){

        e.preventDefault();

        let btn=$(this);

        if(btn.hasClass("loading")) return;

        btn.addClass("loading");

        $.post(

            "processes/forum/likeTopic.php",

            {
                topicID:btn.data("id")
            },

            function(response){

                response=response.trim();

                let count=btn.closest("span").find(".like-count");
                let total=parseInt(count.text()) || 0;

                if(response==="added")
                {

                    btn.find("i")
                        .removeClass("fa-heart-o")
                        .addClass("fa-heart");

                    count.text(total+1);

                }
                else
                {

                    btn.find("i")
                        .removeClass("fa-heart")
                        .addClass("fa-heart-o");

                    count.text(Math.max(total-1,0));

                }

            }

        ).fail(function(){

            alert("Unable to update like.");

        }).always(function(){

            btn.removeClass("loading");

        });

    });

});