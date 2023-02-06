  // function to handle coffee received vs coffee moved out graph
  var graded=function quarterlyCoffeeGraded()
  {
    var request= new XMLHttpRequest();
    request.open("GET","quartReceived.php");
    request.onload=function(){
    if(this.status ==200)
    {
      var ourData=JSON.parse(this.responseText);
      extractData(ourData);
      console.log(ourData);
    }

  }
  request.send();

  //function to extract json data
  function extractData(data)
  {
    //sorting data
    const xTitle=data[0][0];
    const nameNa=data[0][1];
    const nameWu=data[0][2];
    const nameDru=data[0][3];
    const nameWas=data[0][4];

    const q1=data[1][0];
    const q2=data[2][0];
    const q3=data[3][0];
    const q4=data[4][0];
    
    const q1Na=data[1][1];
    const q1Wu=data[1][2];
    const q1Dru=data[1][3];
    const q1Was=data[1][4];
    const q2Na=data[2][1];
    const q2Wu=data[2][2];
    const q2Dru=data[2][3];
    const q2Was=data[2][4];
    const q3Na=data[3][1];
    const q3Wu=data[3][2];
    const q3Dru=data[3][3];
    const q3Was=data[3][4];
    const q4Na=data[4][1];
    const q4Wu=data[4][2];
    const q4Dru=data[4][3];
    const q4Was=data[4][4];

    const y1Data=[q1Na,q2Na,q3Na,q4Na];
    const y2Data=[q1Wu,q2Wu,q3Wu,q4Wu];
    const y3Data=[q1Dru,q2Dru,q3Dru,q4Dru];
    const y4Data=[q1Was,q2Was,q3Was,q4Was];

    const xData=[q1,q2,q3,q4];//x axis data
    const titleData=[xTitle,nameNa,nameWu,nameDru,nameWas];
    const yData=[y1Data,y2Data,y3Data,y4Data];
    console.log();
    // console.log(graded)
    // console.log(colorSorted)
    // console.log(hulled)
    // console.log(dried)
    plotGraph(xData,titleData,yData);
  }

  //function to plot graph
  function plotGraph(data1,data2,data3,)
  {
    var trace1={
        y:data1,
        x:data3[0],
        type:"bar",
        name:data2[1],
        text:data3[0].map(String),
        textposition: 'auto',
        // hoverinfo: 'none'
        orientation:"h"
    }
  
    var trace2=
      {
        y:data1,
        x:data3[1],
        type:"bar",
        name:data2[2],
        text:data3[1].map(String),
        textposition: 'auto',
        // hoverinfo: 'none'
        orientation:"h"
      };

      
    var trace3=
    {
      y:data1,
      x:data3[2],
      type:"bar",
      name:data2[3],
      text:data3[2].map(String),
      textposition: 'auto',
      // hoverinfo: 'none'
      orientation:"h"
    };

    var trace4=
      {
        y:data1,
        x:data3[3],
        name:data2[4],
        type:"bar",
        text:data3[3].map(String),
        textposition: 'auto',
        // hoverinfo: 
        orientation:"h"
      };
    
    var layout={
      barmode: 'stack',
      title:"Coffee Graded per Quarter",
      xaxis: {
        title:"Values",
        // gridcolor:'#bdbdbd',
        // gridwidth:1,
        // zerolinecolor:'#969696',
        // zerolinewidth:1,
        // linecolor:'#636363',
        // linewidth:1,
        // showdividers:true
      },
      // width:300,
      height:300,
      yaxis:{
        title:{text:data2[0],standoff:20},
        // type: 'linear',
        showgrid:true,
        zeroline:true,
        showline:true,
        // mirror:'ticks',
        gridcolor:'#bdbdbd',
        gridwidth:1,
        zerolinecolor:'#969696',
        zerolinewidth:1,
        linecolor:'#636363',
        linewidth:1
      },
      showlegend:true,
      legend:{"orientation":"v"}

    };

    var dataPlot=[trace1,trace2,trace3,trace4];
    var config={responsive:true, displaylogo:false};
    Plotly.newPlot("quarterlyReceived",dataPlot,layout,config);
  }
  
  }

  export default graded;

// var graded=function quarterlyCoffeeGraded(){
//   var trace1 = {
//     x: ['giraffes', 'orangutans', 'monkeys'],
//     y: [20, 14, 23],
//     name: 'SF Zoo',
//     type: 'bar'
//   };
  
//   var trace2 = {
//     x: ['giraffes', 'orangutans', 'monkeys'],
//     y: [12, 18, 29],
//     name: 'LA Zoo',
//     type: 'bar'
//   };
  
//   var data = [trace1, trace2];
  
//   var layout = {barmode: 'stack'};
  
//   Plotly.newPlot('quarterlyReceived', data, layout);
// }
// export default graded;


