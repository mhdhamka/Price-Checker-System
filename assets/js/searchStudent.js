$(document).ready(function () {

    let selectedRating = 0;

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
        $.get("processes/getRating.php", { itemID: itemID }, function (response) {

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

        });

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