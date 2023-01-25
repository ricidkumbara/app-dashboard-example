@extends('dashboard._layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
<style>
  .ff-lato {
    font-family: 'Lato', sans-serif;
  }
  .ff-montserrat {
    font-family: 'Montserrat', sans-serif;
  }
  .border {
    border: 1px solid #ccc;
  }
  .pointer {
    cursor: pointer;
  }
  .d-header {
    border: 1px solid #ddd;
    border-top: 2px solid #58ab0d;
    background-color: #fff;
    padding: 3px;
    margin-bottom: 6px;
    /*font-family: 'Lato', sans-serif;*/
  }
  .d-body {
    border: 1px solid #ddd; background-color: #fff; padding-bottom: 15px; padding-top: 15px;
    /*border-top: 2px solid #58ab0d;*/
    /*font-family: 'Lato', sans-serif;*/
  }
  .d-row {
    margin-left: 0;
    margin-right: 0;
  }
  .d-header-title {
    font-size: 28px;
    font-weight: 600;
    /*font-family: 'Source sans pro';*/
    color: #4a4a4a;
    text-shadow: 1px 2px 3px #c9c9c9;
  }
  .logo-and {
    height: 33px;
    position: absolute;
    top: 6px;
    left: 7px;
  }
  @media (min-width: 768px) {
    .form-horizontal .control-label {
      padding-top: 9px;
      margin-bottom: 0;
      text-align: right;
      font-size: 18px;
    }
  }
  .date-area {
    position: absolute; text-align: right; right: 10px;
  }
  #toast-container > div {
    opacity:1;
  }

  /* ====================== Custom Scroll ====================== */
  .custom-scroll::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #eee;
  }
  .custom-scroll::-webkit-scrollbar {
    width: 6px;
    height: 6px;
    background-color: #eee;
  }
  .custom-scroll::-webkit-scrollbar-thumb {
    border-radius: 4px;
    background-color: #999;
  }

  /* ====================== Footer ====================== */
  .btn-no-color {
    background: transparent; border: transparent;
  }
  .footer-nav {
    position: fixed; bottom: 20px; left: 50%; transform: translate(-50%, 0);
  }
  .footer-watermark {
    position: fixed; bottom: 10px; right: 15px; font-family: 'Segoe UI';
  }

  /* ====================== Datatable ====================== */
  #table-master>thead>tr>th, #table-detail>thead>tr>th {
    background-color: #778899;
    color: white;
  }
  #table-master {
    /*font-family: 'Calibri';*/
  }
  #table-master>tbody {
    cursor: pointer;
  }

  /* ====================== Icon Checklist ====================== */
  .Button.Checkbox .SvgIconDiv {
    width: calc((1.5em) + (2px) + (2px));
    height: calc((1.5em) + (0px) + (0px));
    margin-left: 0;
  }
  .DataGrid .Row .Checkbox .SvgIconDiv {
    margin: 0;
  }
  .Button.Checkbox.Checkmark .SvgIconDiv {
    padding: 2px;
  }
  .Button.Checkbox.Checkmark.Button-checked>div>svg>.SvgCheckmarkCircle {
    fill: #66A140;
  }
  .Button.Checkbox.Button-checked>div>svg>.SvgCheckboxCheckmark, .Button.Checkbox.Button-partial>div>svg>.SvgCheckboxPartial, .Button.Checkbox.Checkmark.Button-checked>div>svg>.SvgCheckmarkCheck {
    fill: #ffffff;
  }

  /* ====================== Custom ====================== */
  .current-active {
    animation:blinkingText 0.8s infinite;
  }
  @keyframes blinkingText{
    0% {
      color: white; background-color: red;
    } 49% {
      color: white; background-color: red; 
    } 60% {
      color: black; background-color: transparent;
    } 99% { 
      color: black; background-color: transparent; 
    } 100% {
      color: white; background-color: red;
    }
  }
  .info-box {
    border: 1px solid #f0f0f0;
    box-shadow: 0 1px 1px rgb(0 0 0 / 20%);
  }
  .info-box-number {
    font-size: 32px;
  }
</style>
<div class="content-wrapper" style="padding: 10px 10px;">
  <div class="row d-row" style="margin-bottom: 200px;">
    <div class="col-xs-12 d-header text-center">
      <img src="{{ asset('images/logo.png') }}" class="logo-and">
      <span class="d-header-title">DASHBOARD SALES YTD</span>
      <span class="date-area">
        <div style="border-bottom: 1px solid #bbb;" id="datetime">01 Januari 1945</div>
        <div id="clocktime">00:00:00 WIB</div>
      </span>
    </div>
    <div class="col-xs-12 d-body form-horizontal">
      <div class="row">
        <div class="col-sm-12">
          <div class="box box-widget" style="border: 1px solid #c0c0c0;">
            <div class="box-header with-border">
              <div class="user-block">
                <span><a><strong>GRAFIK</strong></a></span>
              </div>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-sm-12 form-horizontal">
                  <div class="form-group">
                    <div class="col-sm-2">
                      <label>Tanggal Awal</label>
                      <input type="date" name="tgl_awal" name="tgl_awal" class="form-control">
                    </div>
                    <div class="col-sm-2">
                      <label>Tanggal Akhir</label>
                      <input type="date" name="tgl_akhir" name="tgl_akhir" class="form-control">
                    </div>
                    <div class="col-sm-2">
                       <label>Action</label>
                      <button id="display2" type="button" class="form-control btn btn-primary" data-toggle="tooltip" data-placement="top" title="Display">Display</button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <canvas id="chart-1" height="70"></canvas>
                </div>
                <div class="col-sm-12" style="padding: 20px 0 10px 0;">
                  <div class="text-center"><strong>Plan vs Actual</strong></div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <div><canvas id="chart-2" width="100" height="60"></canvas></div>
                  <div class="text-center">CUSTOMER 1</div>
                </div>
                <div class="col-sm-3">
                  <div><canvas id="chart-3" width="100" height="60"></canvas></div>
                  <div class="text-center">CUSTOMER 2</div>
                </div>
                <div class="col-sm-3">
                  <div><canvas id="chart-4" width="100" height="60"></canvas></div>
                  <div class="text-center">CUSTOMER 3</div>
                </div>
                <div class="col-sm-3">
                  <div><canvas id="chart-5" width="100" height="60"></canvas></div>
                  <div class="text-center">CUSTOMER 4S</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-watermark">
    <small style="color: #aaa; letter-spacing: 1px;">Powered By </small>
    <b style="font-size:16px;"><i style="color:red;"> Ricid </i><span style="color:blue;">Kum</span>bara</b>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('chartjs/Chart.bundle.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script>
  var d = new Date()
  var weekday=new Array(7)
  var weekday=["Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"]
  var monthname=new Array(12)
  var monthname=["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]
  var dayname=weekday[d.getDay()]
  var day=d.getDate()
  var month=monthname[d.getMonth()]
  var year=d.getFullYear();

  setInterval(function() {
      d.setSeconds(d.getSeconds() + 1)
      $('#datetime').text(( day + " " + month + " " + year ))
      $('#clocktime').text(((d.getHours() < 10 ? '0' : '') + d.getHours() +':' + (d.getMinutes() < 10 ? '0' : '') + d.getMinutes() + ':' + (d.getSeconds() < 10 ? '0' : '') + d.getSeconds() + " WIB"))
  }, 1000);

  /* -------------------- Variable Initialize -------------------- */
  var ctx_1 = document.getElementById("chart-1").getContext('2d');
  var ctx_2 = document.getElementById("chart-2").getContext("2d");
  var ctx_3 = document.getElementById("chart-3").getContext("2d");
  var ctx_4 = document.getElementById("chart-4").getContext("2d");
  var ctx_5 = document.getElementById("chart-5").getContext("2d");
  var chart1 = null;
  var chart2 = null;
  var chart3 = null;
  var chart4 = null;
  var chart5 = null;

  Chart.pluginService.register({
    beforeDraw: function(chart) {
      if (chart.config.options.elements.center) {
        // Get ctx from string
        var ctx = chart.chart.ctx;
        
        // Get options from the center object in options
        var centerConfig = chart.config.options.elements.center;
        var fontStyle = centerConfig.fontStyle || 'Arial';
        var txt = centerConfig.text;
        var color = centerConfig.color || '#000';
        var maxFontSize = centerConfig.maxFontSize || 75;
        var sidePadding = centerConfig.sidePadding || 20;
        var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
        // Start with a base font of 30px
        ctx.font = "30px " + fontStyle;
        
        // Get the width of the string and also the width of the element minus 10 to give it 5px side padding
        var stringWidth = ctx.measureText(txt).width;
        var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;
        
        // Find out how much the font can grow in width.
        var widthRatio = elementWidth / stringWidth;
        var newFontSize = Math.floor(30 * widthRatio);
        var elementHeight = (chart.innerRadius * 2);
        
        // Pick a new font size so it will not be larger than the height of label.
        var fontSizeToUse = Math.min(newFontSize, elementHeight, maxFontSize);
        var minFontSize = centerConfig.minFontSize;
        var lineHeight = centerConfig.lineHeight || 25;
        var wrapText = false;
        
        if (minFontSize === undefined) {
          minFontSize = 20;
        }
        
        if (minFontSize && fontSizeToUse < minFontSize) {
          fontSizeToUse = 18;
          wrapText = true;
        }
        
        // Set font settings to draw it correctly.
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
        var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
        ctx.font = fontSizeToUse + "px " + fontStyle;
        ctx.fillStyle = color;
        
        if (!wrapText) {
          ctx.fillText(txt, centerX, centerY);
          return;
        }
        
        var words = txt.split(' ');
        var line = '';
        var lines = [];
        
        // Break words up into multiple lines if necessary
        for (var n = 0; n < words.length; n++) {
          var testLine = line + words[n] + ' ';
          var metrics = ctx.measureText(testLine);
          var testWidth = metrics.width;
          if (testWidth > elementWidth && n > 0) {
            lines.push(line);
            line = words[n] + ' ';
          } else {
            line = testLine;
          }
        }
        
        // Move the center up depending on line height and number of lines
        centerY -= (lines.length / 2) * lineHeight;
        
        for (var n = 0; n < lines.length; n++) {
          ctx.fillText(lines[n], centerX, centerY);
          centerY += lineHeight;
        }
        //Draw text in center
        ctx.fillText(line, centerX, centerY);
      }
    }
  });
  
  /* -------------------- Define Function -------------------- */
  function initChart() {
    let url = '{{ route('dashboard.detail') }}';

    $.get(url, function(response) {
      console.log(response.salesSumary);

      chart1 = new Chart(ctx_1, {
        type : "bar",
        data : {
          labels : response.header,
          datasets : [
            { 
              label : "Plan", 
              backgroundColor : "#fa5711",
              borderColor : "#fa5711",
              borderWidth : 3,
              fill: false,
              pointRadius: 2,
              data : response.plan
            } , { 
              label : "Actual", 
              backgroundColor : "#00c0ef",
              borderColor : "#00c0ef",
              borderWidth : 3,
              fill: false,
              pointRadius: 2,
              data : response.actual
            }
          ]
        },
        options : {
          title: {
            display: true,
            text: 'Sales YTD'
          },
          responsive: true,
          spanGaps: false,
          elements: {
            line: {
              tension: 0.001001
            }
          },
          legend: {
            display: false
          },
          scales : { 
            yAxes : [{ 
              ticks : {
                beginAtZero : !0,
                fontColor : 'rgba(1,1,1, 0.9)',
                // stepSize : 2,
                // suggestedMax : 5,
                // suggestedMin : -5
              },
              gridLines : {
                zeroLineColor : 'rgba(169,236,238, 0.7)',
                color : "rgba(169,236,238, 0.4)"
              }
            }],
            xAxes : [{ 
              ticks : {
                beginAtZero : !0,
                fontColor : 'rgba(1,1,1, 0.9)',
                maxRotation: 90,
                minRotation: 45
              },
              gridLines : {
                zeroLineColor : 'rgba(169,236,238, 0.7)',
                // color : "rgba(169,236,238, 0.4)"
              }
            }]
          },
          "hover": {
            "animationDuration": 15
          },
          animation: {
            onComplete: function () {
              var ctx = this.chart.ctx;
              ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
              ctx.font = "11px 'Helvetica Neue', Helvetica, Arial, sans-serif";
              ctx.fillStyle = 'rgba(1,1,1,0.6)';
              ctx.textAlign = 'center';
              ctx.textBaseline = 'bottom';
              this.data.datasets.forEach(function (dataset)
              {
                for (var i = 0; i < dataset.data.length; i++) {
                  for(var key in dataset._meta) {
                    var model = dataset._meta[key].data[i]._model;
                    ctx.fillText(dataset.data[i], model.x, model.y - 5);
                  }
                }
              });
            }
          } 
        }
      });

      chart2 = new Chart(ctx_2, {
        type: 'doughnut',
        data: {
          labels: ["Actual","Plan"],
          datasets: [{
            data: [90, 10],
            // borderColor: '#222', 
            borderWidth: [1,1,1,1],
            backgroundColor: ["#449d44","#bfbfbf"]
          }]
        },
        options: {
          legend: { 
            display: false 
          },
          tooltips: {
            enabled: false
          },
          elements: {
            center: {
              text: '90%',
              color: 'black',
              fontStyle: 'Arial',
              sidePadding: 20,
              minFontSize: 15,
              lineHeight: 25
            }
          }
        }
      });

      chart3 = new Chart(ctx_3, {
        type: 'doughnut',
        data: {
          labels: ["Actual","Plan"],
          datasets: [{
            data: [85, 15],
            // borderColor: '#222', 
            borderWidth: [1,1,1,1],
            backgroundColor: ["#449d44","#bfbfbf"]
          }]
        },
        options: {
          legend: { 
            display: false 
          },
          tooltips: {
            enabled: false
          },
          elements: {
            center: {
              text: '85%',
              color: 'black',
              fontStyle: 'Arial',
              sidePadding: 20,
              minFontSize: 15,
              lineHeight: 25
            }
          }
        }
      });

      chart4 = new Chart(ctx_4, {
        type: 'doughnut',
        data: {
          labels: ["Actual","Plan"],
          datasets: [{
            data: [95, 5],
            // borderColor: '#222', 
            borderWidth: [1,1,1,1],
            backgroundColor: ["#449d44","#bfbfbf"]
          }]
        },
        options: {
          legend: { 
            display: false 
          },
          tooltips: {
            enabled: false
          },
          elements: {
            center: {
              text: '95%',
              color: 'black',
              fontStyle: 'Arial',
              sidePadding: 20,
              minFontSize: 15,
              lineHeight: 25
            }
          }
        }
      });

      chart5 = new Chart(ctx_5, {
        type: 'doughnut',
        data: {
          labels: ["Actual","Plan"],
          datasets: [{
            data: [60, 40],
            // borderColor: '#222', 
            borderWidth: [1,1,1,1],
            backgroundColor: ["#ffff00","#bfbfbf"]
          }]
        },
        options: {
          legend: { 
            display: false 
          },
          tooltips: {
            enabled: false
          },
          elements: {
            center: {
              text: '60%',
              color: 'black',
              fontStyle: 'Arial',
              sidePadding: 20,
              minFontSize: 15,
              lineHeight: 25
            }
          }
        }
      });
    }).fail(function() {
      alert('Internal Server Error, please refresh your browser');
    });
  }

  /* -------------------- Call Function -------------------- */
  initChart();
</script>
@endsection