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
                      <?php if($access==2 or $headProject->userID==$userId):?>
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
              <div class="col-md-11" style="border-radius:1%;">
              <div class="menu1">
                <div class="create">
                    <div class="nameProject"><?php echo $nameProject?></div>
                    <div>Руководитель проекта</div>
                    <span class="circle">
                    <?php
                          $initial = mb_substr($headProject->name,0,1).mb_substr($headProject->serName,0,1);          
                                echo $initial;
                                ?>
                    </span>
                    <span><?php echo  $headProject->name." ".$headProject->serName?></span>
                </div>
                <?php if(($overdues!=0 or $checkTasks!=0) and ($access==2 or $headProject->userID==$userId)):?>
                <div class="messages">
                <h5>Уведомления</h5>
                <form method="POST" id="update" action="/diplom/index.php/projects/updateActualEnd">
                <table width="100%">
                <?php foreach($checkTasks as $task):?>
                  <tr>
                    <input type="hidden" class="taskId" value="<?php echo $task['taskId']?>">
                    <td width="80%">
                      <?php echo $task['name']." ".$task['serName']?> Подал задачу <b><?php echo $task['nameTask']?></b> на проверку
                      <?php if($task['fileTask']!=NULL):?>
                      К задаче прилагается файл 
                      <form method="POST" action="diplom/index.php/documents/downloadFile/<?php echo $task['taskId']?>">
                                      <label class="custom-file-upload">
                                        <input type="hidden" name="taskId" class="taskId" value="<?php echo $task['taskId']?>">
                                        <input type="text" style="display:none" class="output-file" value="<?php echo $task['fileTask']?>">
                                        <?php echo $task['fileTask']?>
                                      </label>
                      </form>
                      <?php endif;?>
                    </td>
                    <td width='10%'><button type="submit" name="good" value="good" class="done btn btn-primary">Согласен</button></td>
                    <td width='10%'><button type="button" class="reject btn btn-light">Отклонить</button></td>
                  </tr>
                <?php endforeach;?>
                <?php foreach($overdues as $over):?>
                  <tr>
                    <td width='80%'>Задача <b><?php echo $over['name'];?></b> была не сделана в срок. Перенести срок на 3 дня?</td>
                    <td width='10%'><button name="update" formaction="/diplom/index.php/projects/updateActualEnd/<?php echo $over['taskId']?>/<?php echo $idProject ?>" type="submit" class="btn btn-primary extendTask">Согласен</button></td>
                  </tr>
                <?php endforeach;?>
                </table>
                </form>
                </div>
                <?php endif;?>
                <div class="tasks">
                                <h6>Задачи</h6>
                      <?php if($access==2 or $headProject->userID==$userId):?>
                      <div class="buttonCreateTask">
                      <form method="POST" action="">
                        <input type="button" value="создать задачу" class="btn btn-primary js-button-campaign" id="createProject">
                      </form><br>
                    </div>
                    <?php endif?>
                                <div class="task">
                                <table class="table">
                                <thead>
                                  <tr>
                                  <th scope="col">Название задачи</th>
                                  <th scope="col">Кол-во дней</th>
                                  <th scope="col">Приоритет</th>
                                  <th scope="col">Окончание</th>
                                  <th scope="col" >Исполнитель</th>
                                  <th scope="col">Статус</th>
                                 </tr>
                                </thead>
                                <tbody>
                                <?php foreach($tasks as $task):?>
                              <tr>
                                <td><span class="nameTask"><?php echo $task['nameTask'];?></span></td>
                                <td class="cellStyle"> <span class="countDay"><?php
                                  $date1 =date_create($task['actualStart']);
                                  $date2 =date_create($task['actualEnd']);
                                  $interval =  $date2->diff($date1);
                                  echo $interval->d;
                                    ?></span></td>
                                    <td> <span class="ratingTask"><?php echo $task['importance'] ?></span>  </td>
                                    <td><?php echo $task['actualEnd'];?></td>
                                    <!-- <td>
                                    <?php //if($task['fileTask']!=NULL):?>
                                      <form method="POST" action="diplom/index.php/projects/downloadFile/<?php //echo $task['fileTask']?>">
                                        <label class="custom-file-upload">
                                          <input type="text" style="display:none" class="output-file" value="<?php //echo $task['fileTask']?>">
                                            <?php //echo $task['fileTask']?>
                                          </label>
                                      </form>
                                    <?php //endif;?>
                                    </td> -->
                                    <td>       <span class="employeeTask"><?php echo $task['nameEmployee']." ".$task['serName']?></span></td>
                                <td><?php $today = date("Y-m-d"); if($today>$task['actualEnd'] and $task['statusTask']!="Выполнена") echo "Просрочена"; else echo $task['statusTask']?></td>
                                </tr>
                                <?php endforeach;?>
                                <?php foreach($withoutUser as $task):?>
                                <tr>
                                <td><span class="nameTask"><?php echo $task['name'];?></span></td>
                                <td class="cellStyle"> <span class="countDay"><?php
                                  $date1 =date_create($task['actualStart']);
                                  $date2 =date_create($task['actualEnd']);
                                  $interval =  $date2->diff($date1);
                                  echo $interval->d;
                                    ?></span></td>
                                    <td> <?php if($task['importance']!=NULL):?><span class="ratingTask"><?php echo $task['importance'] ?></span><?php endif?>  </td>
                                    <td><?php echo $task['actualEnd'];?></td>
                                    <!-- <td>
                                    <?php //if($task['fileTask']!=NULL):?>
                                      <form method="POST" action="diplom/index.php/projects/downloadFile/<?php //echo $task['fileTask']?>">
                                        <label class="custom-file-upload">
                                          <input type="text" style="display:none" class="output-file" value="<?php //echo $task['fileTask']?>">
                                            <?php //echo $task['fileTask']?>
                                          </label>
                                      </form>
                                    <?php //endif;?>
                                    </td> -->
                                    <td></td>
                                <td><?php $today = date("Y-m-d"); if($today>$task['actualEnd'] and $task['statusTask']!="Выполнена") echo "Просрочена"; else echo $task['statusTask']?></td>
                                </tr>
                                <?php endforeach;?>
                                </tbody>
                                </table>
                    </div>
</div>
                <div class="addPartners">
                    <h6>Участники</h6>
                    <?php if($access==2 or $headProject->userID==$userId):?>
                      <div class="buttonCreateTask">
                        <form method="POST" action="">
                          <input type="button" value="Добавить участника" class="btn btn-primary js-button-part" id="addPart">
                        </form>
                        <div class="overlay2 js-overlay-part">
                          <div class="popup js-popup-part">
                              <div class="container mt-2"> 
                                <h6>Выберите пользователя</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                      <ul class="metisFolder metismenu width">
                                      <?php foreach($departments as $depart):?>
                                        <li class="flex">
                                            <a href="">
                                                <span class="fa fa-folder-o"><?=$depart['name']?></span>                                
                                            </a>
                                            <ul>
                                                <?php foreach ($addPart as $user):?>
                                                <?php if($depart['departId']==$user["departId"]):?>
                                                  <li class="part">
                                                      <a href=""style="pointer-events: none;">
                                                          <span class="fa fa-tasks nameEmploy" data-projectId =<?=$idProject?> data-userId ="<?php echo $user['userID']?>"><?php echo $user['name']." ".$user['serName'] ?></span>
                                                      </a>
                                                  </li>
                                                  <?php endif;?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <?php endforeach; ?>
                                        <li class="flex">
                                                <a href=""><span class="fa fa-fw fa-folder-o">Другие участники</span></a>
                                                <ul>
                                                  <?php foreach($addPart as $user):?>
                                                  <?php if($user['departId']==0):?>
                                                        <li class="part">
                                                            <a href="" style="pointer-events: none;">
                                                              <span class="fa fa-tasks nameEmploy" data-projectId =<?=$idProject?> data-userId ="<?php echo $user['userID']?>"><?php echo $user['name']." ".$user['serName'] ?></span>
                                                            </a>
                                                        </li>
                                                  <?php endif;?>
                                                  <?php endforeach;?> 
                                                </ul>
                                        </li>
                                      </ul>
                                </div>
                            </div>
                            <div class="close-popup js-close-part"></div>
                          </div>
                      </div>
                    </div>
                    </div>
                    <br>
                    <?php endif?>
                    <table class="table table-sm table-striped">
                        <thead class="thead-dark">
                            <th scope="col">Имя</th>
                            <th scope="col">E-Mail</th>
                            <th scope="col">Отдел</th>
                            <th scope="col">Телефон</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                        <?php foreach($usersProject as $user):?>
                            <tr data-userID="<?=$user['userID']?>">
                                <td><?php echo $user['name']." ".$user['serName']?></td>
                                <td><a href=""><?php echo $user['email']?></a></td>
                                <td><?=$user['nameDepart']?></td>
                                <td><?php echo $user['phone']?></td>
                                <td class="deleteMember">удалить</td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
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
                                <label for="text">Имя задачи</label>
                                <input class="form-control" name="nameTask" type="text" placeholder="введите имя задачи">
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
                                <select class="form-control" name="statusTask">
                                  <option value="В_работе">В работе</option>
                                  <option value="Приостановлена">Приостановлена</option>
                                  <option value="Выполнена">Выполнена</option>
                                </select>
                                      </div>
                            </div>   
                            <div class="descriptionTask">
                              <div class="form-group">
                                <label for="exampleFormControlTextarea1">Описание задачи</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                              </div>
                            </div>
                        </div>
                        <div>
                        <input class="btn btn-primary l" type="submit" value="Создать"> 
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

      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="<?=base_url()?>js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>datepicker/dist/datepicker.js"></script>
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
            $('.l').click(function(e){
                e.defaultPrevented();
            });
          </script>
      <script src="<?=base_url()?>js/main.js"></script> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="<?=base_url()?>js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>datepicker/dist/datepicker.js"></script>
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
            // $('.l').click(function(e){
            //     e.defaultPrevented();
            // });
          </script>
          <script>
              $('.output-file').on('click',function(e){
                let temp = this;
                let taskId = $(this).parent().find('.taskId').val();
                console.log(taskId);
                document.location.href = "/diplom/index.php/documents/downloadFile/"+taskId;
                //document.location.href = "/diplom/index.php/projects/downloadFile/"+temp.value;
                // e.preventDefault();
                // $.ajax({
                //   url:"/diplom/index.php/documents/downloadFile/"+taskId,
                //   method:"POST",
                //   contentType:"application/x-www-form-urlencoded; charset=UTF-8",
                //   success:function(data){
                //     console.log(data);
                //   },
                //   error:function(XMLHttpRequest, textStatus, errorThrown) { 
                //     alert("Status: " + textStatus); alert("Error: " + errorThrown);
                // } 
                // });
              }); 
            // $('.output-file').on('click',function(e){
            //     let temp = this;
            //     console.log(temp.value);
            //     document.location.href = "/diplom/index.php/projects/downloadFile/"+temp.value;
            //     //e.preventDefault();
            //     // $.ajax({
            //     //   url:"/diplom/index.php/projects/downloadFile/"+temp.value,
            //     //   method:"POST",
            //     //   contentType: false,
            //     //   cache:false,
            //     //   processData:false
            //     // });
            //   }); 
          </script>
          <script>
            $('.reject').on('click',function(e){
              let id = $(this).parent().parent().find('.taskId').val();
              let name = "";
              let persent = 0;
              console.log(id);
              $.confirm({
                title: 'Введите причину отказа!',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<input type="text" class="name form-control" required />' +
                '</div>' +
                '<label for="customRange1">Введите процент выполнения задачи</label>'+
                '<input type="range" class="custom-range" id="persentRange" onchange="changeRange(this.value)">'+
                '<span id="rangeValue">5</span>%'+
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Отправить',
                        btnClass: 'btn-blue',
                        action: function () {
                            name = this.$content.find('.name').val();
                            if(!name){
                                $.alert('Введите причину отказа');
                                return false;
                            }
                            persent = this.$content.find('#persentRange').val();
                            $.ajax({  
                              url:"<?php echo base_url(); ?>index.php/projects/reject", 
                              method:"POST",  
                              data:{reason : name,taskId : id,persent : persent},  
                              dataType: "json",     
                              success:function(data)  
                              { 
                                if(data==1){
                                  location.reload();
                                } 
                              }  
                            });  
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
              });
            });
            function changeRange(val){
              console.log($('#rangeValue').text());
              $("#rangeValue").text(val);
            }
            // $('.reject').on('click',function(e){
            //   e.preventDefault();
            //   let reject = prompt("Напишите причину отказа!","");
            //   if(reject!=null){
            //     let id = $(this).parent().parent().find('.taskId').val();
            //   console.log(id);
            //   let myData = {
            //     reason : reject,
            //     taskId : id
            //   }
            //   console.log(myData);
            //                 $.ajax({  
            //                 url:"<?php echo base_url(); ?>index.php/projects/reject", 
            //                 method:"POST",  
            //                 data:{reason : reject,taskId : id},  
            //                 dataType: "json",     
            //                 success:function(data)  
            //                 { 
            //                   if(data==1){
            //                      location.reload();
            //                   } 
            //                 }  
            //             });  
            //   }
            // });
            $('.done').on('click',function(e){
              e.preventDefault();
              let id = $(this).parent().parent().find('.taskId').val();
              console.log(id);
              $.ajax({
                url:"/diplom/index.php/projects/read/"+id+"/<?php echo $idProject ?>",
                method:"GET",
                success:function(data){
                  console.log(data);
                    document.location.reload();
                }
              });
            });



            $('.deleteMember').on("click",function(){
              let Data= {userID:$(this).parents('tr').attr('data-userID'),
                          projectId:"<?=$idProject?>"};
              $.ajax({
                url:"/diplom/index.php/projects/deleteMember",
                method:"POST",
                data:Data,
                success:function(data){
                  if(data==1){
                    document.location.reload();
                  }
                }
              });
            });
          </script>
          <script>
          $('.flex ul').each(function(i,elem) {
            if($(elem).children("li").length==0){
              $(elem).parents(".flex").remove();
            }
          });
            $('.extendTask').on("click",function(){
              let href = $(this).attr('formaction');
              document.location.href = href;
            });
          </script>
            <?php if(count($tasks)>10):?>
            <script>
              $('.tasks').css({"max-height":"400px","overflow":"scroll"});
            </script>
          <?php endif; ?>
    <script src="<?=base_url()?>js/common.js"></script>
    	<script src="<?=base_url()?>js/main.js"></script>
  </body>
</html>