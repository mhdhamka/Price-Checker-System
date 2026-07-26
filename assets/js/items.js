/* ==========================================
   ITEMS MANAGEMENT JAVASCRIPT
========================================== */


/* ==========================================
   DELETE ITEMS
========================================== */

document.addEventListener("DOMContentLoaded", function(){


    const deleteButtons = document.querySelectorAll(".delete-btn");

    const deleteModal = document.getElementById("deleteModal");

    const confirmDelete = document.getElementById("confirmDelete");

    const cancelDelete = document.getElementById("cancelDelete");



    if(deleteButtons.length > 0 && deleteModal)
    {


        deleteButtons.forEach(button => {


            button.addEventListener("click", function(event){


                event.preventDefault();



                let itemID = this.dataset.id;



                if(confirmDelete)
                {

                    confirmDelete.href =
                    "../admin/processes/deleteItemProcess.php?id=" + itemID;

                }



                deleteModal.classList.add("show");



            });


        });




        if(cancelDelete)
        {

            cancelDelete.addEventListener("click", function(){


                deleteModal.classList.remove("show");


            });


        }


    }



});





/* ==========================================
   ITEM SEARCH SUGGESTION
========================================== */


$(document).ready(function(){



    console.log("items.js loaded");



    let searchBox = $("#itemSearchBox");

    let suggestionBox = $("#itemSuggestion");




    console.log(searchBox);



    if(searchBox.length === 0)
    {

        console.log("itemSearchBox not found");

        return;

    }





    searchBox.on("keyup", function(){



        let search = $(this).val();



        console.log("Searching:", search);




        if(search.length < 2)
        {

            suggestionBox.hide();

            return;

        }





        $.ajax({


            url:"itemSuggestion.php",


            method:"GET",


            data:{
                search:search
            },



            beforeSend:function(){

                console.log("Sending request...");

            },



            success:function(response){



                console.log("Response:", response);



                suggestionBox
                .html(response)
                .fadeIn();



            },



            error:function(xhr,status,error){


                console.log("AJAX ERROR");

                console.log(xhr.responseText);


            }


        });



    });







    // Click suggestion


    $(document).on(
        "click",
        ".item-suggestion-item",
        function(){


            let name=$(this).data("name");



            searchBox.val(name);



            suggestionBox.fadeOut();



        }
    );







    // Click outside


    $(document).on("click",function(e){



        if(
            !$(e.target).closest(".item-search-input").length
        )
        {

            suggestionBox.fadeOut();

        }



    });




});