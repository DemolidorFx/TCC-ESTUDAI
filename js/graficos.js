
var data = 1;
const chart = document.getElementById('canvas')
var realChartType = 'bar'
const add = document.getElementById('addcollum')
var canvas = document.getElementById("myChart")
var ctx = canvas.getContext("2d");
var realValue = document.getElementById('data').value

const colors = ["blue", "red", "purple", "yellow", "green","orange","brown","black"];



const pie = document.getElementById('pie')
const bar = document.getElementById('bar')
const line = document.getElementById('line')

var config = {
    type: 'line',
    data: {
      labels: ["First"],
      datasets: [{
        label: "company1",
        data: [2],
        borderColor: ["purple"],
        backgroundColor: ["purple"]
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
            beginAtZero: true
        }
    }
    }
  };
  
  var myChart;



pie.addEventListener('click', e=>{
    const chartType = 'pie'
    const labels = 'empty'
    realChartType = 'pie'
    const data = ['']
    const bgColor = ['']
    const bdColor = ['']
    change(labels,data,bgColor,bdColor,chartType)
})

bar.addEventListener('click', e=>{
    const chartType = 'bar'
    realChartType = 'bar'
    const labels = 'empty'
    const data = ['']
    const bgColor = ['']
    const bdColor = ['']
    change(labels,data,bgColor,bdColor,chartType)
})

line.addEventListener('click', e=>{
    const chartType = 'line'
    realChartType ='line'
    const labels = 'empty'
    const data = ['']
    const bgColor = ['']
    const bdColor = ['']
    change(labels,data,bgColor,bdColor,chartType)
})

function changeValue(thisValue){
    realValue = thisValue
    console.log(realValue)
}



function change(labels, data, bgColor, bdColor, chartType) {
    if (myChart) {
      myChart.destroy();
    }

    config.type = chartType;
    if(labels !== 'empty'){
        config.data.labels.push(labels)
        config.data.datasets[0].data.push(data)
        config.data.datasets[0].borderColor.push(bdColor)
        config.data.datasets[0].backgroundColor.push(bgColor)
    }
    
    myChart = new Chart(ctx, config);
  };

add.addEventListener('click', e=>{
    const random = Math.floor(Math.random() * colors.length);
    console.log(colors[random]);
    const labels = colors[random]
    data = realValue
    const chartType = realChartType 
    const bgColor = colors[random]
    const bdColor = colors[random]
    if(e.code == 'Space'){
        change(labels, data, bgColor, bdColor, chartType)
    }
    change(labels,data,bgColor,bdColor,chartType)
});
