  // function to handle coffee received vs coffee moved out graph
  var graph2=function plotProcessingActivities()
  {
    var request= new XMLHttpRequest();
    request.open("GET","processingActivities.php");
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
    var dateData=data[0];
    var graded=data[1];
    var colorSorted=data[2];
    var hulled=data[3];
    var dried=data[4];
    // console.log(dateData)
    // console.log(graded)
    // console.log(colorSorted)
    // console.log(hulled)
    // console.log(dried)
    plotGraph(dateData,graded,colorSorted,hulled,dried);
  }

  //function to plot graph
  function plotGraph(data1,data2,data3,data4,data5)
  {

    var x1Data=data1;//dates
    var y1Data=data2;//graded
    var y2Data=data3;//color sorted
    var y3Data=data4;//hulled
    var y4Data=data5;//graded

    var trace1={
        x:x1Data,
        y:y1Data,
        type:"scatter",
        mode:"lines",
        line:{shape:"spline"},
        name:"Grading"
    }
  
    var trace2=
      {
        x:x1Data,
        y:y2Data,
        type:"scatter",
        mode:"lines",
        line:{shape:"spline"},
        name:"Color Sorter",
        // line:{
        //   color:'rgb(0,255,0)',
        //   width:3
        // }
      };

      
    var trace3=
    {
      x:x1Data,
      y:y3Data,
      type:"scatter",
      mode:"lines",
      line:{shape:"spline"},
      name:"Hulling",
      // line:{
      //   color:'rgb(0,255,0)',
      //   width:3
      // }
    };

    var trace4=
      {
        x:x1Data,
        y:y4Data,
        type:"scatter",
        mode:"lines",
        line:{shape:"spline"},
        name:"Drying",
        // line:{
        //   color:'rgb(0,255,0)',
        //   width:3
        // }
      };
    
    var layout={
      title:"Daily Coffee Processing",
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

    var dataPlot=[trace1,trace2,trace3,trace4];
    var config={responsive:true, displaylogo:false};
    Plotly.newPlot("dailyCoffeeProcessing",dataPlot,layout,config);
  }
  
  }

  export default graph2;