$(document).ready(function(){

    $(document).on("click",".bookmark-btn",function(e){

        e.preventDefault();

        let btn=$(this);

        if(btn.hasClass("loading")) return;

        btn.addClass("loading");

        $.post(

            "processes/forum/bookmarkTopic.php",

            {
                topicID:btn.data("id")
            },

            function(response){

                let data=JSON.parse(response);

                let icon=btn.find("i");

                btn.closest(".stat-chip")
                    .find(".bookmark-count")
                    .text(data.total);

                if(data.status==="added")
                {

                    icon
                        .removeClass("fa-regular")
                        .addClass("fa-solid");

                    btn.addClass("active");

                }
                else
                {

                    icon
                        .removeClass("fa-solid")
                        .addClass("fa-regular");

                    btn.removeClass("active");

                }

            }

        ).always(function(){

            btn.removeClass("loading");

        });

    });

});