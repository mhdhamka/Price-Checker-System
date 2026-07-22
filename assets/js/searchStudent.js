// Ensure form submission with Enter key works
document.getElementById("searchtextbox").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("search-btn").click();
    }
});

// Validate search form
function validateSearch() {
    const searchInput = document.getElementById('searchtextbox').value.trim();
    if (searchInput === "") {
        alert("Please enter a search term.");
        return false;
    }
    return true;
}


$(document).ready(function(){


let selectedRating=0;



$(".rate-btn").click(function(){


let id=$(this).data("id");


$("#itemID").val(id);


$("#ratingModal").fadeIn();


loadReviews(id);


});



$(".close-modal,.cancel-btn").click(function(){

$("#ratingModal").fadeOut();

});



$(".star-rating i").click(function(){


selectedRating=$(this).data("rate");


$(".star-rating i").each(function(){


if($(this).data("rate") <= selectedRating)

$(this).addClass("active");


else

$(this).removeClass("active");


});


});



$(".submit-rating").click(function(){



let data={

itemID:$("#itemID").val(),

rating:selectedRating,

comment:$("#comment").val()

};



$.post(
"addRating.php",
data,

function(response){


alert("Rating submitted");


$("#ratingModal").fadeOut();


}

);



});



function loadReviews(id)
{


$("#reviews").load(
"loadReviews.php?itemID="+id
);


}


});
