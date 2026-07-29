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



    /* ===========================
       DELETE
    =========================== */

    const del=e.target.closest(".delete-topic");

    if(del){

        e.preventDefault();

        if(!confirm("Delete this topic?")) return;

        fetch("../student/processes/forum/deleteTopicAdmin.php",{

            method:"POST",

            headers:{
                "Content-Type":"application/x-www-form-urlencoded"
            },

            body:"topicID="+del.dataset.id

        })
        .then(r=>r.text())
        .then(res=>{

            if(res.trim()=="success"){

                del.closest(".topic-card").remove();

            }

        });

    }

});