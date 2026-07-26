
/* ==========================================
   DELETE CATEGORY RECORD
========================================== */

document.addEventListener("DOMContentLoaded", function () {

    const deleteButtons = document.querySelectorAll(".delete-btn");
    const deleteModal = document.getElementById("deleteModal");
    const confirmDelete = document.getElementById("confirmDelete");
    const cancelDelete = document.getElementById("cancelDelete");

    deleteButtons.forEach(button => {

        button.addEventListener("click", function (event) {

            event.preventDefault();

            const categoryID = this.dataset.id;

            confirmDelete.href =
                "../admin/processes/deleteCategoryProcess.php?id=" + categoryID;

            // Show modal
            deleteModal.classList.add("show");

        });

    });

    // Hide when Cancel is clicked
    cancelDelete.addEventListener("click", function () {

        deleteModal.classList.remove("show");

    });

});



/* ==========================================
   CATEGORY SEARCH SUGGESTION
========================================== */


$(document).ready(function(){


    $("#categorySearchBox").keyup(function(){


        let search=$(this).val();



        if(search.length < 2)
        {

            $("#categorySuggestion").hide();

            return;

        }



        $.ajax({

            url:"categorySuggestion.php",

            type:"GET",

            data:{
                search:search
            },


            success:function(data)
            {

                $("#categorySuggestion")
                .html(data)
                .fadeIn();

            },


            error:function(xhr)
            {

                console.log(xhr.responseText);

            }


        });



    });




    // Select suggestion

    $(document).on(
    "click",
    ".category-suggestion-item",
    function(){


        let name=$(this).data("name");


        $("#categorySearchBox")
        .val(name);



        $("#categorySuggestion")
        .fadeOut();


    });




    // Click outside

    $(document).click(function(e){


        if(!$(e.target).closest(".category-search-input").length)
        {

            $("#categorySuggestion").fadeOut();

        }


    });



});