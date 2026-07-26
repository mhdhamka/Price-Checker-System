const body = document.body;

const button = document.getElementById("themeToggle");

const icon = button.querySelector("i");



// LOAD SAVED THEME

if(localStorage.getItem("theme") === "dark")
{

    body.classList.add("dark");

    icon.classList.remove("fa-moon");

    icon.classList.add("fa-sun");

}
else
{

    icon.classList.remove("fa-sun");

    icon.classList.add("fa-moon");

}




// TOGGLE THEME

if(button)
{

    button.addEventListener("click",()=>{


        body.classList.toggle("dark");



        if(body.classList.contains("dark"))
        {

            localStorage.setItem(
                "theme",
                "dark"
            );


            icon.classList.remove("fa-moon");

            icon.classList.add("fa-sun");


        }

        else
        {

            localStorage.setItem(
                "theme",
                "light"
            );


            icon.classList.remove("fa-sun");

            icon.classList.add("fa-moon");

        }


    });

}