<?php $this->load->helper('url');?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>WD Tree Data 16</title>
  <link href="https://playground.anychart.com/qrutZZlw/iframe" rel="canonical">
  <meta content="Gantt Chart,Gantt Project Chart,Project Management" name="keywords">
  <meta content="AnyChart - JavaScript Charts designed to be embedded and integrated" name="description">
  <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css?hcode=a0c21fc77e1449cc86299c5faa067dc4" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>css/style1.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?=base_url()?>css/metisMenu.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/mm-folder.css">
    <link  href="<?=base_url()?>datepicker/dist/datepicker.css" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
}
button {
    margin: 10px 0 0 10px;
}
#container {
    position: absolute;
    width: 100%;
    top: 55px;
    bottom: 0;
}</style>
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
                    <span class="circleHead">
                    <?php
                         $initial = mb_substr($currentUser->name,0,1).mb_substr($currentUser->serName,0,1);          
                              echo $initial;
                                ?>
                    </span>
                </li>
                <li class="nav-item  nav-mr" style="margin: auto auto;">
                    <span class="nameHead"><?php echo $currentUser->name?>
                    <?php if($access==2) echo "<span class='statusPart'>Руководитель</span>";else{echo "<span class='statusPart'>Исполнитель</span>";}?>
                  </span>
                </li>
              </ul>
            </div>
          </nav>
        </header>
        <div class="">
            <div class="row">
              <header class="col-md-1" style="height: 100vh">
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
                      <?php if($access==2 or $idUserHead==$userId):?>
                      <li class="nav-item">
                        <a href="/diplom/index.php/reports/index/<?php echo $idProject?>" class="nav-link">
                          <img src="<?=base_url()?>photo/report.png" alt="">
                          Отчет
                        </a>
                      </li>
                      <?php endif;?>
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
              <div class="col-md-11 gantt">
                  <div class="menu1">
                    <?php if($access==2 or $idUserHead==$userId): ?> 
                    <button class="btn btn-primary btn-sm" onclick="addItem()">Добавить</button> 
                    <button class="btn btn-danger btn-sm" onclick="removeItem()">Удалить</button>
                    <button class="btn btn-success btn-sm" onclick="changeItem()">Изменить</button>
                    <!-- <div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary btn-sm active">
    <input type="radio" name="options" id="option1" autocomplete="off" checked> Ничего
  </label>
  <label class="btn btn-secondary btn-sm">
    <input type="radio" name="options" id="option2" onclick="changeItem()" autocomplete="off"> Изменить
  </label>
  <label class="btn btn-secondary btn-sm">
    <input type="radio" name="options" id="option3" onclick="removeItem()" autocomplete="off"> Удалить
  </label>
</div> -->
                    <?php endif;?>
                    <div id="container" style="padding-right:24px;"></div>
                    </div>
                </div>
                </div>
             </div>
        </div> 
  <div class="overlay js-overlay-campaign">
            <div class="popup js-popup-campaign">
            <form id="crProject" method="POST" action="/diplom/index.php/projects/createTask/<?php echo $idProject?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                                <h4>Создать задачу</h4>
                                <input type="hidden" name="taskIdUp" id="taskIdUpdate">
                                <label for="text">Имя задачи</label>
                                <input class="form-control" id="taskName" name="nameTask" type="text" placeholder="введите имя задачи">
                                <label for="dataImportance">Приоритет задачи</label>
                                <input type="number" min="1" max="10" name="importance" class="form-control noImportant" id="dataImportance">
                        </div>
                        <div class="col-md-7">
                            <h5>Настройки</h5>
                            <b>Исполнитель задачи</b><br>
                            <span class="circle photoEmployee"></span>
                            <input type="hidden" id="nameHeadInput" name="Head">
                            <a href="#js-button-leader" class="js-button-leader">
                              <span name="head" id="nameHead">Выбрать</span><span class="fa fa-cogs"></span>
                            </a>
                            <div class="row">
                                <div class="col">
                                        <label for="datepickerStart">Дата начала</label>
                                        <input type="text" name="stDate" class="form-control datepicker" placeholder="дата начала задачи" data-toggle="datepicker" id="datepickerStart">
                                </div>
                                <div class="col">
                                        <label for="datepickerEnd">Дата окончания</label>
                                        <input type="text" name="endDate" class="form-control datepicker" placeholder="дата завершения задачи" data-toggle="datepicker2" id="datepickerEnd">
                                </div>
                            </div>
                            <div class="access">
                                <h6>Статус задачи</h6>
                                <div class="form-select ">
                                <select class="form-control" id="statusTask" name="statusTask">
                                  <option value="В_работе">В работе</option>
                                  <option value="Приостановлена">Приостановлена</option>
                                  <option value="Выполнена">Выполнена</option>
                                </select>
                                      </div>
                            </div>  
                            <div class="descriptionTask">
                              <div class="form-group">
                                <label for="descripTask">Описание задачи</label>
                                <textarea class="form-control" id="descripTask" name="description" rows="3"></textarea>
                              </div>
                            </div> 
                        </div>
                        <input type="hidden" name="gantt" id="gantHid" value="">
                        <div>
                        <input class="btn btn-primary l changeTask" id="pop" type="submit" value="Создать"> 
                        <input class="btn btn-light" type="reset" value="Отменить">
                        </div>
                    </div>
                </div>
                            </form>
                <div class="close-popup js-close-campaign"></div>
            </div>
        </div>
        <div class="overlay js-overlay-leader">
                <div class="popup js-popup-leader">
                    <div class="container mt-2"> 
                        <h6>Выберите пользователя</h6>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                          </form>
                        <div class="row">
                            <div class="col-md-12">
                            <nav class="nav">
                                    <ul class="metisFolder metismenu width">
                                    <?php foreach($departments as $depart):?>
                                        <li class="flex">
                                            <a href="">
                                                <span class="fa fa-folder-o"><?=$depart['name']?></span>                                
                                            </a>
                                            <ul>
                                              <?php foreach ($users as $user):?>
                                                <?php if($depart['departId']==$user['departId']):?>
                                                <li class="employ">
                                                    <a href=""style="pointer-events: none;">
                                                        <span class="fa fa-tasks nameEmploy" data-userId ="<?php echo $user['userID']?>"><?php echo $user['name']." ".$user['serName'] ?></span>
                                                    </a>
                                                </li>
                                                <?php endif;?>
                                              <?php endforeach; ?>
                                              <!--  <li class="employ">
                                                        <a href="" style="pointer-events: none;">
                                                            <span class="fa fa-tasks nameEmploy">file 2</span>
                                                            <span class="nameEmployee">Ген директор</span>
                                                        </a>
                                                </li>
                                                <li class="employ">
                                                    <a href="" style="pointer-events: none;">
                                                        <span class="fa fa-tasks nameEmploy">file 3</span>
                                                        <span class="nameEmployee">Ген директор</span>
                                                    </a>
                                                </li>
                                                <li class="employ">
                                                        <a href="">
                                                            <span class="fa fa-tasks nameEmploy">file 4</span>
                                                            <span class="nameEmployee">Ген директор</span>
                                                        </a>
                                                    </li>-->
                                            </ul>
                                        </li>
                                      <?php endforeach;?>
                                        <li class="flex">
                                                <a href=""><span class="fa fa-fw fa-folder-o">Другие участники</span></a>
                                                <ul>
                                                  <?php foreach($users as $user):?>
                                                  <?php if($user['departId']==0):?>
                                                        <li class="employ">
                                                            <a href="" style="pointer-events: none;">
                                                                <span class="fa fa-tasks nameEmploy" data-userId ="<?php echo $user['userID']?>"><?php echo $user['name']." ".$user['serName'] ?></span>
                                                            </a>
                                                        </li>
                                                  <?php endif;?>
                                                  <?php endforeach;?> 
                                                </ul>
                                        </li>
                                        </div>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    <div class="close-popup js-close-leader"></div>
                </div>
            </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-gantt.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="<?=base_url()?>js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>datepicker/dist/datepicker.js"></script>
    <script>
        $('.metisFolder').metisMenu({
            toggle: false
        });
        $('.flex ul').each(function(i,elem) {
            if($(elem).children("li").length==0){
              $(elem).parents(".flex").remove();
            }
          });
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
            $('#datepickerStart').on("change",function(){
              let startTask = $('#datepickerStart').val();
              let startProject = "<?=$dateProject->startDate?>";
              console.log(startProject);
              let date = startProject.split("-");
              //date.format("yyyy-mm-dd");
              startProject= new Date(date[0],parseInt(date[1],10)-1,parseInt(date[2],10));
              date = startTask.split('/');
              startTask = new Date(date[2],parseInt(date[0],10)-1,date[1]);
              console.log("proj "+startProject);
              console.log("task "+startTask);
              if(startTask<=startProject-1){
                console.log("work");
                alert("Дата начала задачи должна быть больше, чем дата начала проекта");
                $('#datepickerStart').val("");
              }
            });
            $('#datepickerEnd').on("change",function(){
              let endTask = $('#datepickerEnd').val();
              let endProject = "<?=$dateProject->endDate?>";
              console.log(endProject);
              let date = endProject.split("-");
              //date.format("yyyy-mm-dd");
              endProject= new Date(date[0],parseInt(date[1],10)-1,parseInt(date[2],10));
              date = endTask.split('/');
              endTask = new Date(date[2],parseInt(date[0],10)-1,date[1]);
              console.log("proj "+endProject);
              console.log("task "+endTask);
              if(endTask-1>endProject){
                let conf = confirm("Дата окончания срока задачи больше даты окончания срока проекта! Перенести дату окончания проекта?");
                if(conf==false){
                  $('#datepickerEnd').val("");
                }else{
                  let year = endTask.getFullYear();
                  let month = endTask.getMonth();
                  let day = endTask.getDate();
                  let dateSend = year+"-"+(parseInt(month,10)+1)+"-"+day;
                  let Data={date:dateSend,id:<?=$idProject?>};
                  console.log(Data);
                  $.ajax({
                    url:"/diplom/index.php/projects/changeEndProjectDate",
                    method:"POST",
                    data:Data,
                    success:function(data){
                      console.log(data);
                      if(data==1){
                        alert("Дата изменена");
                      }
                    }
                  });
                }
              }
            });
            $('.l').click(function(e){
                e.defaultPrevented();
            });
          </script>
    	<script src="<?=base_url()?>js/main.js"></script>
  <script type="text/javascript">
    function getData(){
        var json = <?php echo $jsonTasks?>;
        console.log(Array.isArray(json));
        if(Array.isArray(json)==false){
          json = [json];
        }
        console.log(json);
        var result = json.map(function(a){
            let date = a.actualStart.split("-");
            // date.format("yyyy-mm-dd");
            a.actualStart= new Date(date[0],parseInt(date[1],10)-1,parseInt(date[2],10)+1);
            date = a.actualEnd.split("-");
            a.actualEnd=new Date(date[0],parseInt(date[1],10)-1,parseInt(date[2],10)+1);
            return a;
        });
        console.log(result);
        return json;
    }
    let remove = false;
    let change = false;
  anychart.onDocumentReady(function () {
    // create data
    var data = getData();
  // create a data tree
  treeData = anychart.data.tree(data, "as-tree");

    // create a gantt chart
    chart = anychart.ganttProject();

            // set the data
    chart.data(treeData);

    var dataGrid = chart.dataGrid();
    chart.splitterPosition(900);

    anychart.format.inputDateTimeFormat('MM/dd/yyyy');
    anychart.format.outputDateTimeFormat('MM/dd/yyyy');

    var firstColumn = dataGrid.column(0);
  firstColumn.labels().hAlign("center");
  firstColumn.width(35);

  var secondColumn = dataGrid.column(1);
  secondColumn.labels().hAlign("left");
  secondColumn.width(200);
  secondColumn.labels().format("{%name}");

    var thirdColumn = dataGrid.column(2);
  thirdColumn.title("Начало");
  thirdColumn.width(100);
  thirdColumn.labels().format("{%actualStart}");

  // set fourth column settings
  var fourthColumn = dataGrid.column(3);
  fourthColumn.title().text("Конец работы");
  fourthColumn.width(100);
  fourthColumn.labels().format("{%actualEnd}");
  
  
  var fifthColumn = dataGrid.column(4);
  fifthColumn.title().text("Исполнитель");
  fifthColumn.width(130);
  fifthColumn.labels().format("{%serName}");

    <?php if($access==2 or $idUserHead==$userId): ?>
    // allow editing the chart
    var edit = chart.edit();

    // Enable live edit.
    edit.enabled(true);
    <?php endif;?>
    // Set text for the input.
    dataGrid.onEditStart(function () {
        if (this.columnIndex <= 1|| this.columnIndex >3)
            return {cancelEdit: false};
        else {
            var parsed = anychart.format.parseDateTime(this.value);
            return {value: anychart.format.dateTime(parsed, 'yyyy-MM-dd')};
        }
    });

        // Set end text.
        dataGrid.onEditEnd(function () {
        var parsed = anychart.format.parseDateTime(this.value, 'yyyy-MM-dd');
        var localized = anychart.format.dateTime(parsed);
        if (this.columnIndex == 2)
            return {itemMap: {actualStart: localized}};
        else if (this.columnIndex == 3)
            return {itemMap: {actualEnd: localized}};
        else if( this.columnIndex ==1)
            return {itemMap: {name: this['value']}};
        else if (this.columnIndex == 4){
            return {itemMap: {serName: this['value']}};
        }
    });



    // set the chart title
    // update the chart title when an item is updated
    // treeData.listen("treeItemUpdate", function (e) {
    //   let itemName = e.item.get("taskId");
    //   console.log(itemName);
    //   chart.title().useHtml(true);
    //   chart.title("Tree Data Model: Events<br><br>< " +
    //               "<span style = 'color:#990000'>" +
    //               itemName + "</span> updated >");
    // });
    // treeData.listen("treeItemUpdate",function(e){
    //   console.log('eee');
    //   let itemName = e.item.get("Начало");
    //   chart.title().useHtml(true);
    //   chart.title("Tree Data Model: Events<br><br>< " +
    //               "<span style = 'color:#990000'>" +
    //               itemName + "</span> updated >");
    // });

    // update the chart title when an item is added
    // treeData.listen("treeItemCreate", function (e) {
    //   var itemName = e.item.get("name");
    //   chart.title().useHtml(true);
    //   chart.title("Tree Data Model: Events<br><br>< " +
    //               "<span style = 'color:#990000'>" +
    //               itemName + "</span> added >");
    // });


    chart.listen('rowSelect', function(e) {
      console.log(remove);
      if(remove == true){
        let confirm1 = confirm("Вы уверены, что хотите удалить задачу?");
        if(confirm1==false){
          return;
        }
        let taskId = e.item.get("taskId");
        document.location.href = "/diplom/index.php/gant/updateGant/"+taskId+"/<?php echo $idProject?>";
        e.item.remove();
        remove = false;
      }else if(change == true){
        $('#addSub').attr('id','addTask'); 
	    $('.js-overlay-campaign').fadeIn();
        $('.js-overlay-campaign').addClass('disabled');
        $('#pop').val("изменить");
        $('#gantHid').val("изменить");
        $('#pop').addClass("changeTask");
        console.log($('#descripTask'));
        $('#taskName').val(e.item.get("name"));
        $('#descripTask').text(e.item.get("descrip"));
        $('#taskName').attr('readonly', true);
        $('#dataImportance').val(e.item.get("importance"));
        $('#nameHead').text(e.item.get("nameHead")+' '+e.item.get("serName"));
        $('#nameHeadInput').val(e.item.get("nameHead")+' '+e.item.get("serName"));
        $('#statusTask').val(e.item.get("statusTask"));
        console.log(e.item.get('taskId'));
        let date = new Date(e.item.get("actualStart"));
        let year = date.getFullYear();
        let month = date.getMonth()+1;
        let day = date.getDate()-1;
        $('#datepickerStart').val(month+"/"+day+"/"+year);
        date = new Date(e.item.get("actualEnd"));
        year = date.getFullYear();
        month = date.getMonth()+1;
        day = date.getDate()-1;
        $('#datepickerEnd').val(month+"/"+day+"/"+year);
        $('#taskIdUpdate').val(e.item.get("taskId"));
        console.log(e.item.get(e.item.get("importance")));
      }
    });
    // set the container id
    chart.container("container");

    // initiate drawing the chart
    chart.draw();
    // fit items to the width of the timeline
    chart.fitAll();
    var htmlTable = chart.toHtmlTable('Chart table');

    chart.title('Диаграмма ганта');
    chart.splitterPosition(570);
    chart.container('container');
    chart.draw();
    chart.fitAll();

    zoomIn();
});

var itemCount = 1;

// add a new data item
// function addItem() {
//   var name = "New Child " + itemCount++;
//   treeData.getChildAt(0).addChild({
//                                     "name": name,
//                                     actualStart: Date.UTC(2018, 1, 31),
//                                     actualEnd: Date.UTC(2018, 1, 31) 
//                                   });
// }
// let remove = false;
// function removeItem(){
//   remove =true;
//   console.log(remove);
// }
function addItem(){
    change = false;
  $('#addSub').attr('id','addTask'); 
	$('.js-overlay-campaign').fadeIn();
	$('.js-overlay-campaign').addClass('disabled');
}
function removeItem(){
    remove = true;
    change = false;
}
function changeItem(){
    remove = false;
    change = true;
}
function confirmSave(){
    confirm("Сохранить изменения?");
}
function zoomIn(){
    chart.zoomIn(1.5);
}
</script>
<script>
    $('#pop').on("click",function(e){
    e.preventDefault();
    console.log($('#pop').val());
    // if($('#pop').val()=="Создать")return;
    // let confirm = confirm("Сохранить изменения");
    // if(confirm==true){
    //     document.location.href = "/diplom/index.php/projects/createTask/<?php echo $idProject?>/1";
    // }else{
    //     document.location.href ="/diplom/index.php/projects/createTask/<?php echo $idProject?>/0";
    // }
});
</script>
<script src="<?=base_url()?>js/common.js"></script>
 </body>
</html>