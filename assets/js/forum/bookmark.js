$(document).ready(function(){

    $(document).on("click",".bookmark-btn",function(e){

        e.preventDefault();

        let btn=$(this);

        if(btn.hasClass("loading"))
            return;

        btn.addClass("loading");

        $.post(

            "processes/forum/bookmarkTopic.php",

            {

                topicID:btn.data("id")

            },

            function(response){

                let data=JSON.parse(response);

                btn.closest("span")
                    .find(".bookmark-count")
                    .text(data.total);

                if(data.status==="added")
                {

                    btn.find("i")
                        .removeClass("fa-bookmark-o")
                        .addClass("fa-bookmark");

                }
                else
                {

                    btn.find("i")
                        .removeClass("fa-bookmark")
                        .addClass("fa-bookmark-o");

                }

            }

        ).always(function(){

            btn.removeClass("loading");

        });

    });

});