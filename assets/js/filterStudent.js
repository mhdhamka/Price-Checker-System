/* ==========================================================
LIMIT COMPARE CHECKBOXES
========================================================== */

function limitCheckboxes(max){

    const checkboxes = document.querySelectorAll(
        "input[name='compare[]']"
    );


    checkboxes.forEach(function(checkbox){

        checkbox.addEventListener("change",function(){

            const checkedCount = document.querySelectorAll(
                "input[name='compare[]']:checked"
            ).length;


            if(checkedCount >= max)
            {

                checkboxes.forEach(function(box){

                    if(!box.checked)
                    {
                        box.disabled = true;
                    }

                });

            }

            else
            {

                checkboxes.forEach(function(box){

                    box.disabled = false;

                });

            }


            updateCompareBar();

        });


    });


}



/* ==========================================================
SEARCH VALIDATION
========================================================== */

function validateSearch(){

    const searchBox=document.getElementById("searchtextbox");


    if(searchBox)
    {

        const searchInput=searchBox.value.trim();


        if(searchInput==="")
        {

            alert("Please enter a search term.");

            return false;

        }

    }


    return true;

}

/* ==========================================================
SEARCH SUGGESTION
========================================================== */

$("#searchtextbox").keyup(function(){

    let search=$(this).val();

    if(search.length<2)
    {

        $("#compareSuggestion").hide();

        return;

    }

    $.ajax({

        url:"filterSuggestion.php",

        type:"GET",

        data:{

            search:search

        },

        success:function(data){

            $("#compareSuggestion")

            .html(data)

            .fadeIn();

        }

    });

});

    $(document).on("click",".compare-suggestion-item",function(){

        let item=$(this).data("name");

        $("#searchtextbox").val(item);

        $("#compareSuggestion").fadeOut();

    });

    $(document).click(function(e){

        if(!$(e.target).closest(".search-box").length){

            $("#compareSuggestion").fadeOut();

        }

    });




/* ==========================================================
COMPARE VALIDATION
========================================================== */

function validateCompare(){

    const checkboxes=document.querySelectorAll(
        "input[name='compare[]']:checked"
    );


    if(checkboxes.length < 2 || checkboxes.length > 3)
    {

        alert(
        "Please select 2 or 3 items to compare."
        );


        return false;

    }


    return true;

}




/* ==========================================================
UPDATE COMPARE STICKY BAR
========================================================== */

function updateCompareBar(){


    const compareBar=document.querySelector(
        ".compare-sticky"
    );


    const counter=document.getElementById(
        "selectedCount"
    );


    const button=document.getElementById(
        "compareNow"
    );


    if(!compareBar || !counter || !button)
    {
        return;
    }


    const checked=document.querySelectorAll(
        "input[name='compare[]']:checked"
    );


    counter.innerHTML=checked.length;



    if(checked.length >= 2)
    {

        button.disabled=false;

        compareBar.classList.add("show");

    }

    else
    {

        button.disabled=true;

        compareBar.classList.remove("show");

    }


}





/* ==========================================================
WISHLIST AJAX
========================================================== */

function setupWishlist(){


    $(".wishlist").click(function(e){

    e.preventDefault();

    let icon=$(this);

    $.post(
        "processes/toggleWishlist.php",
        {
            itemID: icon.data("id")
        },
        function(response){

            response=response.trim();

            if(response=="added")
            {
                icon
                .removeClass("fa-heart-o")
                .addClass("fa-heart active");
            }
            else if(response=="removed")
            {
                icon
                .removeClass("fa-heart active")
                .addClass("fa-heart-o");
            }

        }
    );

});


}




/* ==========================================================
DOCUMENT READY
========================================================== */


$(document).ready(function(){


    // limit compare selection
    limitCheckboxes(3);



    // wishlist button
    setupWishlist();



    // update compare bar on page load
    updateCompareBar();



    // Search Enter key
    $("#searchtextbox").keypress(function(event){


        if(event.key==="Enter")
        {

            event.preventDefault();


            $("form").submit();

        }


    });



    // move dashboard button
    $(".custom-btn").css(
        "margin-right",
        "auto"
    );


});