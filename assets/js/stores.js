
/* ==========================================
   DELETE STORE RECORD
========================================== */

document.addEventListener("DOMContentLoaded", function () {

    const deleteButtons = document.querySelectorAll(".delete-btn");
    const deleteModal = document.getElementById("deleteModal");
    const confirmDelete = document.getElementById("confirmDelete");
    const cancelDelete = document.getElementById("cancelDelete");

    deleteButtons.forEach(button => {

        button.addEventListener("click", function (event) {

            event.preventDefault();

            const storeID = this.dataset.id;

            confirmDelete.href =
                "../admin/processes/deleteStoreProcess.php?id=" + storeID;

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
   STORE SEARCH SUGGESTION
========================================== */

$(document).ready(function(){



$("#storeSearchBox").keyup(function(){



let search=$(this).val();



if(search.length < 2)
{

$("#storeSuggestion").hide();

return;

}



$.ajax({

url:"storeSuggestion.php",

type:"GET",

data:{
    search:search
},


success:function(data){


$("#storeSuggestion")

.html(data)

.fadeIn();



},


error:function(xhr){

console.log(xhr.responseText);

}


});



});





// Click suggestion
$(document).on(
"click",
".store-suggestion-item",
function(){


let store=$(this).data("name");



$("#storeSearchBox")

.val(store);



$("#storeSuggestion")

.fadeOut();



});






// Click outside
$(document).click(function(e){


if(!$(e.target).closest(".store-search-input").length)
{


$("#storeSuggestion").fadeOut();


}


});



});