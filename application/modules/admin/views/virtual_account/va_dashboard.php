<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<link href='<?php echo base_url(); ?>assets/frontend/css/common.css' rel='stylesheet'  media="screen" id="color">

<div>
<div class="row">
<div class="margin-left">

    <div class="card_style" style="width:24%">
   <p>Total Amount Collected</p>
   <p class="count">987887</p>
   </div>
   <div class="card_style" style="width:24%">
   <p>Total Due Amount</p>
   <p class="count">7887</p>
   </div>
   <div class="card_style" style="width:24%">
   <p>Total Delinquent Amount(1-65 days)</p>
   <p class="count">887</p>
   </div>
    <div class="card_style" style="width:24%">
   <p>Total Delinquent Amount(65 days more)</p>
   <p class="count">65434</p>
   </div>

 </div>
 </div>
  
    <div class="row panel-default main_wrap_form margin-left g-mt-2rem">
    <form> 
    <div class="form-group" style="width: 30%">
            <label for="heading"> Scheme ID</label>
             <select id="Scheme" name="Scheme">
                 <option value="0" >Select Scheme ID</option>
            </select>
    </div>
    <div class="form-group" style="width: 15%">
                <label for="heading">Date</label>
             <input class="form-control space" id="client" name="client" type="date" >
        </div>
   </form>
  </div>

</div>
<div class="row">
<section class="spacing">
    <div class="row space-get margin_10">
        <div class="col-md-6">
            <div class="panel panel-default main_wrap_form">
                <div class="panel-heading">
                Collection Statistics
                </div>
                <div class="panel-body">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
           </div>
       </div>
       <div class="col-md-6">
            <div class="panel panel-default main_wrap_form">
                <div class="panel-heading">
                Monthly Collection Statistics
                </div>
                <div class="panel-body">
                <div id="chartdiv"></div>
                </div>
           </div>
       </div>
   </div>
</section>
</div>
</div>

<!--pie chat-->
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}%</strong>",
		indexLabel: "{name} - {y}%",
		dataPoints: [
			{ y: 40, name: "Pending Amount" },
			{ y: 10, name: "Partially Collected Amount" },
			{ y: 50, name: "Collected Amount" },
		]
	}]
});
chart.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!--pie chat-->
<!--line graph-->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Generate random data
var value = 100;

function generateChartData() {
  var chartData = [];
  var firstDate = new Date();
  firstDate.setDate(firstDate.getDate() - 1000);
  firstDate.setHours(0, 0, 0, 0);

  for (var i = 0; i < 50; i++) {
    var newDate = new Date(firstDate);
    newDate.setSeconds(newDate.getSeconds() + i);

    value += (Math.random() < 0.5 ? 1 : -1) * Math.random() * 10;

    chartData.push({
      date: newDate.getTime(),
      value: value
    });
  }
  return chartData;
}

var data = generateChartData();


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  focusable: true,
  panX: true,
  panY: true,
  wheelX: "panX",
  wheelY: "zoomX",
  pinchZoomX:true
}));

var easing = am5.ease.linear;


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
  maxDeviation: 0.5,
  groupData: false,
  extraMax:0.1, // this adds some space in front
  extraMin:-0.1,  // this removes some space form th beginning so that the line would not be cut off
  baseInterval: {
    timeUnit: "second",
    count: 1
  },
  renderer: am5xy.AxisRendererX.new(root, {
    minGridDistance: 50
  }),
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererY.new(root, {})
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.LineSeries.new(root, {
  name: "Series 1",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  valueXField: "date",
  tooltip: am5.Tooltip.new(root, {
    pointerOrientation: "horizontal",
    labelText: "{valueY}"
  })
}));

// tell that the last data item must create bullet
data[data.length - 1].bullet = true;
series.data.setAll(data);


// Create animating bullet by adding two circles in a bullet container and
// animating radius and opacity of one of them.
series.bullets.push(function(root, series, dataItem) {  
  // only create sprite if bullet == true in data context
  if (dataItem.dataContext.bullet) {    
    var container = am5.Container.new(root, {});
    var circle0 = container.children.push(am5.Circle.new(root, {
      radius: 5,
      fill: am5.color(0xff0000)
    }));
    var circle1 = container.children.push(am5.Circle.new(root, {
      radius: 5,
      fill: am5.color(0xff0000)
    }));

    circle1.animate({
      key: "radius",
      to: 20,
      duration: 1000,
      easing: am5.ease.out(am5.ease.cubic),
      loops: Infinity
    });
    circle1.animate({
      key: "opacity",
      to: 0,
      from: 1,
      duration: 1000,
      easing: am5.ease.out(am5.ease.cubic),
      loops: Infinity
    });

    return am5.Bullet.new(root, {
      locationX:undefined,
      sprite: container
    })
  }
})


// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
  xAxis: xAxis
}));
cursor.lineY.set("visible", false);


// Update data every second
// setInterval(function () {
//   addData();
// }, 1000)


function addData() {
  var lastDataItem = series.dataItems[series.dataItems.length - 1];

  var lastValue = lastDataItem.get("valueY");
  var newValue = value + ((Math.random() < 0.5 ? 1 : -1) * Math.random() * 5);
  var lastDate = new Date(lastDataItem.get("valueX"));
  var time = am5.time.add(new Date(lastDate), "second", 1).getTime();
  series.data.removeIndex(0);
  series.data.push({
    date: time,
    value: newValue
  })

  var newDataItem = series.dataItems[series.dataItems.length - 1];
  newDataItem.animate({
    key: "valueYWorking",
    to: newValue,
    from: lastValue,
    duration: 600,
    easing: easing
  });

  // use the bullet of last data item so that a new sprite is not created
  newDataItem.bullets = [];
  newDataItem.bullets[0] = lastDataItem.bullets[0];
  newDataItem.bullets[0].get("sprite").dataItem = newDataItem;
  // reset bullets
  lastDataItem.dataContext.bullet = false;
  lastDataItem.bullets = [];


  var animation = newDataItem.animate({
    key: "locationX",
    to: 0.5,
    from: -0.5,
    duration: 600
  });
  if (animation) {
    var tooltip = xAxis.get("tooltip");
    if (tooltip && !tooltip.isHidden()) {
      animation.events.on("stopped", function () {
        xAxis.updateTooltip();
      })
    }
  }
}


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart.appear(1000, 100);

}); // end am5.ready()
</script>
<!--line graph-->

<style type="text/css">
    #chartdiv {
  width: 100%;
  height: 370px;
  max-width:100%;
}
    .panel {
    margin-bottom: 20px;
    background-color: #fff;
    border-radius: 4px;
    width: 100%;
    -webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
    box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
}
  .card_style{ float: left; width: 100%; margin-top: 15px; padding: 15px 20px 5px 20px; border-radius: 6px; box-shadow: 0px 1px 12px rgba(0, 0, 0, 0.30); color: #23023b; position: relative; overflow: hidden; font-size: 17px; border-bottom: 4px solid rgba(0, 0, 0, 0.25);margin-right:1% };
  .left_space{
      margin-left:1.5rem;
  }
  .count{
    font-family: 'Roboto';
    font-size: 28px;
  }
  form select{
        width: 26.3vw;
        border:1px solid #b7b2b0;
        height: 2rem;
        border-radius: 3px;
    }
    .button {
        color: #FFFFFF;
        padding: 10px;
        border-radius: 10px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
    }

    .form-group {
    /*width: 49%;*/
    margin-bottom: 20px;
    float: left;
    margin-right:2%
}
.main_wrap_form .form-group label {
    font-weight: 500;
    font-size: 15px;
    }

    .margin_20{
    margin-top: 14px;
    }
    .main_wrap_form .panel-heading{
    font-weight: 500;
    font-size: 16px;
    }
    .main_wrap_form .form-group label{
    font-weight: 500;
    font-size: 15px;
    }
    .main_wrap_form .form-control {
    box-shadow: 0px 0px 0px #fff;
    border-radius: 3px;
    font-size: 13px;
    padding: 6px 12px;
    border: 1px solid #aaaaaa;
    height: 40px;
    line-height: 40px;
    border-radius: 100px;
}
    .main_wrap_form .form-control:focus{
    border: 1px solid #bdbcbc;
    }
    .chosen-container-single .chosen-single {
border-radius: 100px;
    background: #fff;
    box-shadow: 0px 0px 0px;
}
</style>


