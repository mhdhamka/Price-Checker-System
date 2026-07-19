function preview(input){

if(input.files && input.files[0]){

let reader=new FileReader();

reader.onload=function(e){

document.getElementById("previewImage").src=e.target.result;

}

reader.readAsDataURL(input.files[0]);

}

}


function slideCategory(direction){

            const container = document.querySelector(".category-container");
            container.scrollLeft += direction * 350;

        }