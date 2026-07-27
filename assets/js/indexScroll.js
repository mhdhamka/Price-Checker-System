document.addEventListener("DOMContentLoaded", () => {

    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".main-nav .nav a[href^='#']");


    function setActiveLink(id){

        navLinks.forEach(link => {

            link.classList.remove("active");

            if(link.getAttribute("href") === "#" + id){

                link.classList.add("active");

            }

        });

    }


    const observer = new IntersectionObserver((entries)=>{


        entries.forEach(entry=>{


            if(entry.isIntersecting){

                setActiveLink(entry.target.id);

            }


        });


    },{

        threshold:0.55

    });



    sections.forEach(section=>{

        observer.observe(section);

    });



    // FIX: when scrolling back to very top
    window.addEventListener("scroll",()=>{


        if(window.scrollY < 150){

            setActiveLink("top");

        }


    });


});