const body = document.body;
const button = document.getElementById("themeToggle");

if(localStorage.getItem("theme") === "dark")
{
    body.classList.add("dark");

    button.innerHTML =
    '<i class="fa-solid fa-sun"></i>';
}



button.addEventListener("click",()=>{

    body.classList.toggle("dark");

    if(body.classList.contains("dark"))
    {
        localStorage.setItem("theme","dark");

        button.innerHTML =
        '<i class="fa-solid fa-sun"></i>';
    }

    else
    {
        localStorage.setItem("theme","light");

        button.innerHTML =
        '<i class="fa-solid fa-moon"></i>';
    }

});