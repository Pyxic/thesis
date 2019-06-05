<?php $this->load->helper('url');?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <style>
    .attach{
    background: none;
    outline: none;
    border: none;
    text-transform: uppercase;
}
.custom-file-upload:hover, .custom-file-upload:focus {
    color: hsla(108, 12%, 0%, 1);
    box-shadow: -1px 1px 2px hsla(108, 62%, 42%, 1);
    background-color: hsla(108, 62%, 92%, 1)
}
.custom-file-upload:active {
    color: hsla(108, 42%, 32%, 1);
    box-shadow: -2px 4px 8px hsla(64, 64%, 42%, 1);
    background-color: hsla(64, 64%, 92%, 1);
}
input[type="file"] {
    display: none;
}
.custom-file-upload {
    display: inline-block;
    margin: 0;
    cursor: pointer;
}
#chartWorkload{
  width:600px;
  height:400px;
}
#chartStatus{
  width:600px;
  height:400px;
}
.charts{
  display:flex;
}
    </style>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
      <link rel="stylesheet" href="<?=base_url()?>css/style1.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?=base_url()?>css/metisMenu.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/mm-folder.css">
    <link  href="<?=base_url()?>datepicker/dist/datepicker.css" rel="stylesheet">
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet">
      <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
</head>
<body class="bg-color">
    <div class="grid">
        <header>
          <!--<div style="width:100%; background: green; min-height: 40px; ">входящие</div>-->
          <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#FFFFFF;">
            <a class="navbar-brand" href="">MIProject</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                  <a class="nav-link" href="/diplom/index.php/projects">проекты</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/diplom/index.php/participants">команда</a>
                </li>
              </ul>
              <ul class="navbar-nav justify-content-end nav-fill">
                <li class="nav-item  nav-mr">
                    <img src="envelope-solid.svg" alt="" width="20" height="20" class="countMes">
                </li>
                <li class="nav-item  nav-mr">
                    <span class="circleHead ">
                    <?php
                          $initial = mb_substr($fullName->name,0,1).mb_substr($fullName->serName,0,1);          
                                echo $initial;
                                ?>
                    </span>
                </li>
                <li class="nav-item  nav-mr" style="margin:auto auto;">
                    <span class="nameHead"><?php echo $currentUser?>
                    <?php if($access==2) echo "<span class='statusPart'>Руководитель</span>";else{echo "<span class='statusPart'>Исполнитель</span>";}?>
                  </span>
                </li>
              </ul>
            </div>
          </nav>
        </header>
        <div class="">
            <div class="row">
              <header class="col-md-1">
                <nav class="sidebar-sticky navbar-expand-md">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto flex-column">
                    <li class="nav-item">
                          <a href="/diplom/index.php/projects/structure/<?=$idProject?>" class="nav-link">
                          <img src="https://img.icons8.com/ios/50/000000/project-management.png">
                          Обший вид
                          </a>
                        </li>
                        <li class="nav-item">
                            <a href="/diplom/index.php/gant/index/<?php echo $idProject?>" class="nav-link">
                            <img src="<?=base_url()?>photo/project.png" alt="">
                              диаграмма Ганта 
                            </a>
                          </li>
                      <li class="nav-item projects2">
                        <a href="/diplom/index.php/documents/index/<?=$idProject?>" class="nav-link">
                        <img src="https://img.icons8.com/ios/50/000000/product-documents.png"> 
                        Документы
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/diplom/index.php/reports/index/<?php echo $idProject?>" class="nav-link">
                          <img src="<?=base_url()?>photo/report.png" alt="">
                          Отчеты
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/diplom/index.php/projects/myTasks/<?php echo $idProject?>" class="nav-link">
                          <img src="<?=base_url()?>photo/tasks.png" alt="">
                          Мои задачи
                        </a>
                      </li>
                    </ul>
                  </div>
                </nav>
              </header>
              <div class="col-md-11" style="border-radius:1%;">
                <div class="menu1">
                  <div class="reprotButton">
                    <button class="btn btn-primary" id="createReport">Сформировать отчет</button>
                  </div>
                  <div class="charts">
                    <div id="chartWorkload"></div>
                    <div id="chartStatus"></div>
                  </div>
                </div>
                  <h5 style="margin-left:30px;">Таблица 1 - задачи проекта</h5>
                <table class="table">
                  <thead class="thead-dark">
                  <tr>
                    <th scope="col">Задача</th>
                    <th scope="col">Исполнитель</th>
                    <th scope="col">Выполнена на, %</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($tasks as $task):?>
                    <tr>
                      <td><?=$task['name']?></td>
                      <td><?=$task['fullname']?></td>
                      <td><?=$task['persent']?></td>
                    </tr>
                  <?php endforeach;?>
                  <tr class="table-dark">
                    <td colspan='2'><b>Проект выполнен на, %</b></td>
                    <td><b><?=$persent?></b></td>
                  </tr>
                  </tbody>
                </table>
                <h5 style="margin-left:30px;">Таблица 2 - Невыполненные вовремя задачи</h5>
                <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Задача</th>
                    <th scope="col">Исполнитель</th>
                    <th scope="col">Просрочена на, дн</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($overdue as $o):?>
                      <tr>
                        <td><?=$o['nameTask']?></td>
                        <td><?=$o['fullname']?></td>
                        <td><?=$o['countDays']?></td>
                      </tr>
                    <?php endforeach;?>      
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="<?=base_url()?>js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>datepicker/dist/datepicker.js"></script>
    <script src="<?=base_url()?>js/pdfmake.min.js"></script>
    <script src="<?=base_url()?>js/vfs_fonts.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-pie.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
    <script>
      anychart.onDocumentReady(function () {

      // create data
      var data = [
        <?php
          foreach($participants as $part){
            echo "{x: '".$part['fullname']."', value: ".$part['countTasks']."},";
          }
        ?>
      ];
      var data2 = [
        <?php
          foreach($chartStatus as $part){
            echo "{x: '".$part['x']."', value: ".$part['value']."},";
          }
        ?>   
      ];
      var chart2 = anychart.pie(data2);
      chart2.title("Диаграмма выполнения задач");
      chart2.legend().itemsLayout("vertical");
      chart2.legend().position("right");
      chart2.legend().align("top");
      chart2.labels().position("outside");
      chart2.connectorStroke({color: "#595959", thickness: 2, dash:"2 2"});
      chart2.container("chartStatus");

      // initiate drawing the chart
      chart2.draw();

      // create a chart and set the data
      var chart = anychart.pie(data);

      // set the chart title
      chart.title("Диаграмма загруженности учасников");
      chart.legend().itemsLayout("vertical");
      chart.legend().position("right");
      chart.legend().align("top");
      chart.labels().position("outside");
      chart.connectorStroke({color: "#595959", thickness: 2, dash:"2 2"});

      // set the container id
      chart.container("chartWorkload");

      // initiate drawing the chart
      chart.draw();
      });
    </script>
    <script>
        $('.metisFolder').metisMenu({
            toggle: false
        })
    </script>
    <script>
            $(function() {
              $('[data-toggle="datepicker"]').datepicker({
                dateFormat: 'yy/mm/dd',
                autoHide: true,
              });
            });

            $(function() {
              $('[data-toggle="datepicker2"]').datepicker({
                autoHide: true,
              });
            });
      </script>
      <script>
      $('#createReport').on("click",function(){
        let d = new Date();
        var day=d.getDate();
        var month=d.getMonth() + 1;
        var year=d.getFullYear();
          let docInfo = {
            info:{
              tittle: "Отчет pdf",
              author: "victor",
              subject: "Theme",
              keywords: "Ключевые слова"
            },

            pageSize: 'A4',
            pageOrientation: 'portrait',
            pageMargins:[50,50,30,60],

            content: [
              {
                text: "ОТЧЕТ",
                fontSize: "24",
                alignment: "center",
                normal: 'Times-Roman',
                bold:true,
                margin:[0,3]
              },
              {
                text: 'по выполнению проекта "<?=$projectName?>" на '+day+'/'+month+'/'+year,
                fontSize: '16',
                alignment: "center",
                normal: 'Times-Roman',
                bold:true,
                margin:[0,3]
              },
              {
                style: 'basic',
                text:'Таблица 1 - Задачи проекта',
                margin: [40,20,0,3]
              },
              {
                style:'basic',
                table:{
                  widths:[200,190,30],
                  body:[
                    [{text:'Задача',bold:true},{text:'Исполнитель',bold:true},{text:'%',bold:true}],
                    <?php
                      foreach($tasks as $task){
                        echo "['".$task['name']."','".$task['fullname']."','".$task['persent']."'],";
                      }
                    ?>
                    [{text:'Проект выполнен на %',colSpan:2},{},{text:'<?=$persent?>'}]
                  ]
                },
                margin: [40,0,0,0],
              },
              {
                style: 'basic',
                text:'Таблица 2 - Сотрудники проекта',
                margin: [40,20,0,3]
              },
              {
                style:'basic',
                table:{
                  widths:[190,130,100],
                  body:[
                    [{text:'Сотрудник',bold:true},{text:'Кол-во задач',bold:true},{text:'% выполнения',bold:true}],
                    <?php
                      foreach($participants as $part){
                        echo "['".$part['fullname']."','".$part['countTasks']."','".$part['persent']."'],";
                      }
                    ?>

                  ]
                },
                margin: [40,0,0,0]
              },
              {
                style: 'basic',
                text:'Таблица 3 - Невыполненные вовремя задачи',
                margin: [40,20,0,3]
              },
              {
                style: 'basic',
                table:{
                  widths:[190,130,100],
                  body:[
                    [{text:'Задача',bold:true},{text:'Сотрудник',bold:true},{text:'Просрочена на, дн.',bold:true}],
                    <?php
                        foreach($overdue as $o){
                          echo "['".$o['nameTask']."','".$o['fullname']."','".$o['countDays']."'],";
                        }
                    ?>
                  ]
                },
                margin: [40,0,0,0]
              }
            ],
            styles:{
              basic:{
                fontSize:"14",
                normal: 'Times-Roman',
                alignment: 'justify',
                margin:[0,3]
              }
            }
          }
          pdfMake.createPdf(docInfo).download("Отчет");
      });
//         $('#createReport').on("click",function(){
//           $.confirm({
//     title: 'Prompt!',
//     content: '' +
//     '<form action="" class="formName">' +
//     '<div class="form-group">' +
//     '<label>Enter something here</label>' +
//     '<input type="text" placeholder="Your name" class="name form-control" required />' +
//     '</div>' +
//     '</form>',
//     buttons: {
//         formSubmit: {
//             text: 'Submit',
//             btnClass: 'btn-blue',
//             action: function () {
//                 var name = this.$content.find('.name').val();
//                 if(!name){
//                     $.alert('provide a valid name');
//                     return false;
//                 }
//                 $.alert('Your name is ' + name);
//             }
//         },
//         cancel: function () {
//             //close
//         },
//     },
//     onContentReady: function () {
//         // bind to events
//         var jc = this;
//         this.$content.find('form').on('submit', function (e) {
//             // if the user submits the form by pressing enter in the field.
//             e.preventDefault();
//             jc.$$formSubmit.trigger('click'); // reference the button and click it
//         });
//     }
// });
//         });
      </script>
          <script src="<?=base_url()?>js/main.js"></script>
  </body>
</html>


<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <div class="analiz">
          <h6>Анализ загрузки сотрудников</h6>
          <canvas id="myChart"></canvas>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script>
            var densityCanvas = document.getElementById("myChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var densityData = {
  label: 'Выполнено',
  data: <?php echo $finished ?>,
  backgroundColor: 'rgba(99, 132, 0, 0.6)',
  borderWidth: 0,
  yAxisID: "y-axis-gravity"
};

var gravityData = {
  label: 'В ожидании',
  data: <?php echo $work?>,
  backgroundColor: 'rgba(242, 229, 36, 0.6)',
  borderWidth: 0,
  yAxisID: "y-axis-gravity"
};

var overdue = {
    label: 'Просроченные',
    data: <?php echo $overdue?>,
    backgroundColor: 'rgba(224, 18, 18, 0.6)',
    borderWidth: 0,
    yAxisID: "y-axis-gravity"
};

var planetData = {
  labels: ["Калита М.","Кикоть А.","Огродюк Р."],
  datasets: [densityData, gravityData,overdue]
};

var chartOptions = {
  scales: {
    xAxes: [{
      barPercentage: 1,
      categoryPercentage: 0.6
    }],
    yAxes: [{
      id: "y-axis-gravity"
    }]
  }
};

var barChart = new Chart(densityCanvas, {
  type: 'bar',
  data: planetData,
  options: chartOptions
});
        </script>
</body>
</html> --> 