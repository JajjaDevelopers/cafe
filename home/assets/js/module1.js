  // function to handle coffee received vs coffee moved out graph
 var graph1= function plotInAndOut()
  {
    var request= new XMLHttpRequest();
    request.open("GET","inAndOut.php");
    request.onload=function(){
    if(this.status ==200)
    {
      var ourData=JSON.parse(this.responseText);
      extractData(ourData);
    }

  }
  request.send();

  //function to extract json data
  function extractData(data)
  {
    var dateData=data[0];
    var receivedCoffee=data[1];
    var dispatchedCoffee=data[2];
    plotGraph(dateData,receivedCoffee,dispatchedCoffee);
  }

  //function to plot graph
  function plotGraph(data1,data2,data3)
  {

    var x1Data=data1;//dates
    var y1Data=data2;//coffeereceived
    var y2Data=data3;//coffeeout

    var trace1={
        x:x1Data,
        y:y1Data,
        type:"scatter",
        mode:"lines",
        line:{shape:"spline"},
        name:"Received"
    }
  
    var trace2=
      {
        x:x1Data,
        y:y2Data,
        type:"scatter",
        mode:"lines",
        line:{shape:"spline"},
        name:"Moved Out",
        // line:{
        //   color:'rgb(0,255,0)',
        //   width:3
        // }
      };
    
    var layout={
      title:"Weigh Bridge Coffee In and Out",
      xaxis: {
        tickangle: -45,
        type:"date",
        title:{text:'Date',standoff:20},
        showgrid:false,
        zeroline:false,
        showline:true,
        // mirror:'ticks',
        gridcolor:'#bdbdbd',
        gridwidth:1,
        zerolinecolor:'#969696',
        zerolinewidth:1,
        linecolor:'#636363',
        linewidth:1,
        showdividers:true
      },
      // width:300,
      height:300,
      yaxis:{
        title:"Daily Volume (MT)",
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

    var dataPlot=[trace1,trace2];
    var config={responsive:true, displaylogo:false};
    Plotly.newPlot("coffeeInAndOut",dataPlot,layout,config);
  }
  
  }

  export default graph1;


  // var eleGrap=document.getElementById("coffeeInAndOut").getElementsByTagName("svg").getElementsByTagName("main-svg");
  // console.log(eleGrap);
