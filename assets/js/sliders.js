document.querySelectorAll(".slider-wrapper").forEach(function(wrapper){

    const slider = wrapper.querySelector(".card-slider");
    const prev = wrapper.querySelector(".prev");
    const next = wrapper.querySelector(".next");

    next.addEventListener("click", function(){

        slider.scrollBy({

            left: 350,
            behavior: "smooth"

        });

    });

    prev.addEventListener("click", function(){

        slider.scrollBy({

            left: -350,
            behavior: "smooth"

        });

    });

});