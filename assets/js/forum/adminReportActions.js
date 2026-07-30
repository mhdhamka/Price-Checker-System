document.addEventListener("DOMContentLoaded",function(){


let selectedReportID=null;



/*
=================================
OPEN APPROVE MODAL
=================================
*/


document.querySelectorAll(".approve-btn").forEach(btn=>{


    btn.addEventListener("click",function(){


        selectedReportID=this.dataset.id;


        document
        .getElementById("approveReportModal")
        .classList.add("active");


    });


});




/*
=================================
OPEN REJECT MODAL
=================================
*/


document.querySelectorAll(".reject-btn").forEach(btn=>{


    btn.addEventListener("click",function(){


        selectedReportID=this.dataset.id;


        document
        .getElementById("rejectReportModal")
        .classList.add("active");


    });


});






/*
=================================
APPROVE ACTION
=================================
*/


document
.getElementById("confirmApproveBtn")
.addEventListener("click",function(){


    processReport(
        "../student/processes/forum/approveReport.php"
    );


});






/*
=================================
REJECT ACTION
=================================
*/


document
.getElementById("confirmRejectBtn")
.addEventListener("click",function(){


    processReport(
        "../student/processes/forum/rejectReport.php"
    );


});







function processReport(action){



    fetch(action,
    {

        method:"POST",

        headers:
        {
            "Content-Type":
            "application/x-www-form-urlencoded"
        },

        body:
        "reportID="+selectedReportID


    })

    .then(response=>response.text())

    .then(data=>{


        if(data.trim()=="success")
        {

            location.reload();

        }
        else
        {

            alert(data);

        }


    })

    .catch(error=>{

        console.error(error);

        alert("Something went wrong");

    });


}



});







function closeApproveModal(){

document
.getElementById("approveReportModal")
.classList.remove("active");

}



function closeRejectModal(){

document
.getElementById("rejectReportModal")
.classList.remove("active");

}