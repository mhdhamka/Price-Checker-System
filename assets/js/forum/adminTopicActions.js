document.addEventListener("click", function(e){

    /* ===========================
       PIN
    =========================== */

    const pin = e.target.closest(".pin-topic");

    if(pin){

        e.preventDefault();

        fetch("../student/processes/forum/pinTopic.php",{

            method:"POST",

            headers:{
                "Content-Type":"application/x-www-form-urlencoded"
            },

            body:"topicID="+pin.dataset.id

        })
        .then(r=>r.text())
        .then(res=>{

            res=res.trim();

            const icon=pin.querySelector("i");
            const label=pin.closest(".admin-chip").querySelector(".pin-label");

            if(res==="pinned"){

                pin.classList.add("active");

                icon.classList.remove("fa-regular");
                icon.classList.add("fa-solid");

                label.textContent="Pinned";

            }

            else if(res==="unpinned"){

                pin.classList.remove("active");

                icon.classList.remove("fa-solid");
                icon.classList.add("fa-regular");

                label.textContent="Pin";

            }

        });

    }



    /* ===========================
       LOCK
    =========================== */

    const lock=e.target.closest(".lock-topic");

    if(lock){

        e.preventDefault();

        fetch("../student/processes/forum/lockTopic.php",{

            method:"POST",

            headers:{
                "Content-Type":"application/x-www-form-urlencoded"
            },

            body:"topicID="+lock.dataset.id

        })
        .then(r=>r.text())
        .then(res=>{

            res=res.trim();

            const label=lock.closest(".admin-chip").querySelector(".lock-label");

            if(res==="locked"){

                lock.classList.add("active");

                label.textContent="Locked";

            }

            else if(res==="unlocked"){

                lock.classList.remove("active");

                label.textContent="Lock";

            }

        });

    }


   /* ==========================================
    ADMIN DELETE TOPIC MODAL
    ========================================== */

    let selectedTopic = null;


    /* OPEN MODAL */

    document.addEventListener("click", function(e){


        const del = e.target.closest(".delete-topic");


        if(del){

            e.preventDefault();


            selectedTopic = del;


            const modal=document.getElementById("deleteTopicModal");


            if(modal){

                modal.classList.add("show");

            }

        }


    });





    document.addEventListener("DOMContentLoaded",function(){


        const modal=document.getElementById("deleteTopicModal");

        const cancel=document.getElementById("closeDeleteTopic");

        const confirm=document.getElementById("confirmDeleteTopic");



        if(!modal) return;



        /* CANCEL */


        cancel.addEventListener("click",function(){


            modal.classList.remove("show");

            selectedTopic=null;


        });





        /* CONFIRM DELETE */


        confirm.addEventListener("click",function(){


            if(!selectedTopic) return;



            let topicID=selectedTopic.dataset.id;



            fetch("../student/processes/forum/deleteTopicAdmin.php",{


                method:"POST",

                headers:{
                    "Content-Type":"application/x-www-form-urlencoded"
                },

                body:"topicID="+topicID


            })


            .then(res=>res.text())

            .then(result=>{


                if(result.trim()=="success"){


                    let card=selectedTopic.closest(".topic-card");


                    if(card){

                        card.style.opacity="0";

                        card.style.transform="translateY(-20px)";


                        setTimeout(()=>{

                            card.remove();

                        },300);

                    }


                    modal.classList.remove("show");

                    selectedTopic=null;


                }

                else{


                    alert("Delete failed");

                }


            });


        });






        /* CLICK OUTSIDE */


        modal.addEventListener("click",function(e){


            if(e.target===modal){


                modal.classList.remove("show");

                selectedTopic=null;


            }


        });



    });





    /* ESC CLOSE */


    document.addEventListener("keydown",function(e){


        if(e.key==="Escape"){


            const modal=document.getElementById("deleteTopicModal");


            if(modal){

                modal.classList.remove("show");

                selectedTopic=null;

            }

        }


    });

});