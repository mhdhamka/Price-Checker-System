document.addEventListener("DOMContentLoaded", function(){

    const itemImage = document.getElementById("itemImage");
    const previewImage = document.querySelector(".item-preview");


    if(itemImage && previewImage)
    {

        itemImage.addEventListener("change", function(){


            const file = this.files[0];


            if(file)
            {

                // Image size validation
                if(file.size > 2000000)
                {
                    alert("Image size must be less than 2MB");
                    this.value="";
                    return;
                }



                const reader = new FileReader();


                reader.onload = function(e)
                {

                    previewImage.src = e.target.result;

                }


                reader.readAsDataURL(file);

            }


        });

    }


});

previewImage.style.opacity = "0";

setTimeout(()=>{

    previewImage.src = e.target.result;

    previewImage.style.opacity = "1";

},200);