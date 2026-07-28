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

                let count=btn.closest(".stat-chip").find(".like-count");

                let total=parseInt(count.text()) || 0;

                let icon=btn.find("i");

                if(response==="added")
                {

                    icon
                        .removeClass("fa-regular")
                        .addClass("fa-solid");

                    btn.addClass("active");

                    count.text(total+1);

                }
                else
                {

                    icon
                        .removeClass("fa-solid")
                        .addClass("fa-regular");

                    btn.removeClass("active");

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