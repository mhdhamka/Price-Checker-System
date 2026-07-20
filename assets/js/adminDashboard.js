// CATEGORY PIE
new Chart(

document.getElementById("categoryChart"),

{

type:"pie",

data:{

labels:
categoryLabels,

datasets:[{
data:categoryData

}]


}


}

);


// STORE BAR


new Chart(

document.getElementById("storeChart"),

{

type:"bar",
data:{
labels:storeLabels,
datasets:[{
label:"Items",
data:storeData

}]


}


}

);