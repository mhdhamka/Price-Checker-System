
/* =====================================================
   PROFILE
===================================================== */

const profileDropdown = document.querySelector(".dropdown");

const profileImage = document.querySelector(".profile-avatar");


profileImage.addEventListener("click", function(e){

    e.stopPropagation();

    profileDropdown.classList.toggle("active");

});



document.addEventListener("click", function(){

    profileDropdown.classList.remove("active");

});



/* =====================================================
   SCROLL
===================================================== */

const sections = document.querySelectorAll("section[id]");
const navLinks = document.querySelectorAll(".nav-link");


window.addEventListener("scroll", () => {

    let current = "";


    if(window.scrollY < 100)
    {
        current = "top";
    }


    sections.forEach(section => {

        const sectionTop = section.offsetTop - 150;
        const sectionHeight = section.offsetHeight;


        if(window.scrollY >= sectionTop &&
           window.scrollY < sectionTop + sectionHeight)
        {

            current = section.getAttribute("id");

        }

    });



    navLinks.forEach(link => {

        link.classList.remove("active");


        const linkTarget = link.getAttribute("href").split("#")[1];


        if(linkTarget === current)
        {
            link.classList.add("active");
        }


    });


});