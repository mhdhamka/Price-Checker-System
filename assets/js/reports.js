Chart.defaults.font.family = "Poppins";
Chart.defaults.color = "#64748B";
Chart.defaults.plugins.legend.labels.usePointStyle = true;
Chart.defaults.plugins.legend.labels.boxWidth = 10;

/* ==========================================
   PRODUCT CATEGORY DISTRIBUTION
========================================== */

const categoryCtx =
document.getElementById("categoryChart").getContext("2d");

new Chart(categoryCtx, {

    type: "doughnut",

    data: {

        labels: categoryLabels,

        datasets: [{

            data: categoryData,

            backgroundColor: [

                "#2563EB",
                "#ED563B",
                "#22C55E",
                "#F59E0B",
                "#8B5CF6",
                "#06B6D4",
                "#EC4899",
                "#14B8A6"

            ],

            borderWidth: 0,
            hoverOffset: 18

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        cutout: "72%",

        animation: {

            animateRotate: true,
            duration: 1800,
            easing: "easeOutQuart"

        },

        plugins: {

            legend: {

                position: "bottom",

                labels: {

                    padding: 22,
                    font: {

                        size: 13,
                        weight: "600"

                    }

                }

            },

            tooltip: {

                backgroundColor: "#111827",

                padding: 12,

                cornerRadius: 10

            }

        }

    }

});


/* ==========================================
   STORE INVENTORY
========================================== */

const storeCtx =
document.getElementById("storeChart").getContext("2d");

const storeGradient =
storeCtx.createLinearGradient(0,0,0,350);

storeGradient.addColorStop(0,"#2563EB");
storeGradient.addColorStop(1,"#60A5FA");

new Chart(storeCtx,{

    type:"bar",

    data:{

        labels:storeLabels,

        datasets:[{

            label:"Products",

            data:storeData,

            backgroundColor:storeGradient,

            borderRadius:10,

            borderSkipped:false,

            maxBarThickness:45

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{
                display:false
            }

        },

        scales:{

            x:{
                grid:{
                    display:false
                }
            },

            y:{
                beginAtZero:true,

                ticks:{
                    precision:0
                }
            }

        }

    }

});


/* ==========================================
   MONTHLY REGISTRATIONS
========================================== */

const registrationCtx =
document.getElementById("registrationChart").getContext("2d");

const registrationGradient =
registrationCtx.createLinearGradient(0,0,0,350);

registrationGradient.addColorStop(0,"rgba(37,99,235,.45)");
registrationGradient.addColorStop(1,"rgba(37,99,235,.02)");

new Chart(registrationCtx,{

    type:"line",

    data:{

        labels:registrationLabels,

        datasets:[{

            label:"Students",

            data:registrationData,

            fill:true,

            borderColor:"#2563EB",

            backgroundColor:registrationGradient,

            pointBackgroundColor:"#2563EB",

            pointBorderColor:"#fff",

            pointRadius:5,

            pointHoverRadius:8,

            borderWidth:3,

            tension:.45

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{
                display:false
            }

        },

        scales:{

            y:{

                beginAtZero:true,

                ticks:{
                    precision:0
                }

            }

        }

    }

});


/* ==========================================
   RATING DISTRIBUTION
========================================== */

const ratingCtx =
document.getElementById("ratingChart").getContext("2d");

new Chart(ratingCtx,{

    type:"polarArea",

    data:{

        labels:ratingLabels,

        datasets:[{

            data:ratingData,

            backgroundColor:[

                "#22C55E",
                "#4ADE80",
                "#FACC15",
                "#FB923C",
                "#EF4444"

            ],

            borderWidth:0

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{

                position:"bottom"

            }

        },

        scales:{

            r:{

                ticks:{

                    display:false

                }

            }

        }

    }

});