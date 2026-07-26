document.querySelectorAll(".dropdown-toggle")
.forEach(menu => {


    menu.addEventListener("click",function(){


        let parent = this.parentElement;


        parent.classList.toggle("active");


    });


});