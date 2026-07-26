$(document).ready(function () {

    let selectedRating = 0;

    /* ==========================================================
       WISHLIST AJAX
    ========================================================== */

    function setupWishlist() {

        $(document).on("click", ".wishlist", function (e) {

            e.preventDefault();

            let icon = $(this);

            $.post(
                "processes/toggleWishlist.php",
                {
                    itemID: icon.data("id")
                },
                function (response) {

                    response = response.trim();

                    if (response === "added") {

                        icon
                            .removeClass("fa-heart-o")
                            .addClass("fa-heart active");

                    }
                    else if (response === "removed") {

                        icon
                            .removeClass("fa-heart active")
                            .addClass("fa-heart-o");

                    }

                }

            );

        });

    }

    // Initialize wishlist
    setupWishlist();



    /* ==========================================
       OPEN RATING MODAL
    ========================================== */

    $(".rate-btn").click(function () {

        let itemID = $(this).data("id");

        let itemName = $(this).data("name");

        $("#itemID").val(itemID);

        $("#ratingTitle").text(
            "Rate " + itemName
        );

        $("#comment").val("");

        selectedRating = 0;

        $(".star-rating i").removeClass("active");

        // Check if student already rated
        $.get(
            "processes/getRating.php",
            {
                itemID: itemID
            },
            function (response) {

                if (response !== "") {

                    let data = JSON.parse(response);

                    selectedRating = parseFloat(data.rating);

                    $("#comment").val(data.comment);

                    $(".star-rating i").each(function () {

                        if ($(this).data("rate") <= selectedRating) {

                            $(this).addClass("active");

                        }

                    });

                    $(".submit-rating").text("Update Rating");

                }
                else {

                    $(".submit-rating").text("Submit Rating");

                }

                $("#ratingModal").fadeIn();

                loadReviews(itemID);

            }

        );

    });



    /* ==========================================
       CLOSE MODAL
    ========================================== */

    $(".close-modal, .cancel-btn").click(function () {

        $("#ratingModal").fadeOut();

    });



    /* ==========================================
       STAR CLICK
    ========================================== */

    $(".star-rating i").click(function () {

        selectedRating = $(this).data("rate");

        $(".star-rating i").removeClass("active");

        $(".star-rating i").each(function () {

            if ($(this).data("rate") <= selectedRating) {

                $(this).addClass("active");

            }

        });

    });



    /* ==========================================
       SAVE RATING
    ========================================== */

    $(".submit-rating").click(function () {

        if (selectedRating == 0) {

            alert("Please select a rating.");

            return;

        }

        $.post(

            "processes/saveRating.php",

            {

                itemID: $("#itemID").val(),

                rating: selectedRating,

                comment: $("#comment").val()

            },

            function (response) {

                if (response.trim() == "success") {

                    alert("Rating saved successfully.");

                    $("#ratingModal").fadeOut();

                    loadReviews($("#itemID").val());

                }
                else {

                    alert(response);

                }

            }

        );

    });



    /* ==========================================
       LOAD REVIEWS
    ========================================== */

    function loadReviews(itemID) {

        $("#reviews").load(
            "processes/loadReviews.php?itemID=" + itemID
        );

    }

});



    /* ==========================================
       SEARCH SUGGESTION
    ========================================== */

    $("#searchtextbox").keyup(function(){

    let search=$(this).val();

    if(search.length<2)
    {

        $("#searchSuggestion").hide();

        return;

    }

    $.ajax({

        url:"searchSuggestion.php",

        type:"GET",

        data:{

            search:search

        },

        success:function(data){

            $("#searchSuggestion")

            .html(data)

            .fadeIn();

        }

    });

});

    $(document).on("click",".suggestion-item",function(){

        let item=$(this).data("name");

        $("#searchtextbox").val(item);

        $("#searchSuggestion").fadeOut();

    });

    $(document).click(function(e){

        if(!$(e.target).closest(".search-box").length){

            $("#searchSuggestion").fadeOut();

        }

    });