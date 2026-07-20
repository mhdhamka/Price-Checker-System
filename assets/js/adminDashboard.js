// Category Pie
new Chart(

    document.getElementById("categoryChart"),
    {
        type:"doughnut",
        data:{
            labels:categoryLabels,
            datasets:[{
                data:categoryData,
                    backgroundColor:[

                    "#ED563B",
                    "#36A2EB",
                    "#4CAF50",
                    "#FFC107",
                    "#9C27B0",
                    "#FF6384",
                    "#00BCD4"
                ],

                borderWidth:0,
                hoverOffset:20

            }]

        },

        options:{
            animation:{
            duration:1800,
            easing:"easeOutQuart"

            },
            responsive:true,
            cutout:"65%",
            plugins:{
                legend:{
                    position:"bottom",
                    labels:{
                        padding:20,
                        boxWidth:15,
                        font:{
                            size:13
                        }
                    }
                }
            }
        }
    }
);


// Store Bar
new Chart(
document.getElementById("storeChart"),

{

    type:"bar",
    data:{
        labels:storeLabels,
        datasets:[{
            label:"Total Items",
            data:storeData,
            backgroundColor:"#ED563B"           

        }]

    },

    options:{
        responsive:true,
        plugins:{
            legend:{
                display:false
            }
        }

    }

}

);