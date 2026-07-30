Chart.defaults.font.family = "'Poppins', sans-serif";
Chart.defaults.color = getComputedStyle(document.body)
    .getPropertyValue('--text-muted');

const primary = "#ED563B";

new Chart(document.getElementById("reportChart"),{

    type:"doughnut",

    data:{

        labels:["Approved","Rejected","Pending"],

        datasets:[{

            data:[
                <?php echo $approvedReports;?>,
                <?php echo $rejectedReports;?>,
                <?php echo $pendingReports;?>
            ],

            backgroundColor:[
                "#22c55e",
                "#ef4444",
                "#f59e0b"
            ],

            borderWidth:0,

            hoverOffset:18,

            cutout:"72%"

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{

                position:"bottom",

                labels:{

                    padding:20,

                    usePointStyle:true,

                    pointStyle:"circle"

                }

            }

        }

    }

});

new Chart(document.getElementById("contentChart"),{

    type:"bar",

    data:{

        labels:[
            "Topics",
            "Hidden Topics",
            "Replies",
            "Hidden Replies"
        ],

        datasets:[{

            data:[
                <?php echo $activeTopics;?>,
                <?php echo $hiddenTopics;?>,
                <?php echo $activeReplies;?>,
                <?php echo $hiddenReplies;?>
            ],

            backgroundColor:[
                "#22c55e",
                "#ef4444",
                "#3b82f6",
                "#f59e0b"
            ],

            borderRadius:12,

            borderSkipped:false,

            maxBarThickness:48

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{display:false}

        },

        scales:{

            y:{

                beginAtZero:true,

                grid:{
                    color:"rgba(150,150,150,.12)"
                }

            },

            x:{

                grid:{
                    display:false
                }

            }

        }

    }

});