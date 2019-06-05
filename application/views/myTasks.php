<?php $this->load->helper('url');
$this->load->helper('form');?>
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
    padding: 6px 12px;
    cursor: pointer;
}
    </style>
  <title>Sticky Navigation Menu With Smooth Scrolling</title>
      <link rel="stylesheet" href="<?=base_url()?>css/style1.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?=base_url()?>css/metisMenu.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/mm-folder.css">
    <link  href="<?=base_url()?>datepicker/dist/datepicker.css" rel="stylesheet">
    <link href="<?=base_url()?>css/jquery.fileupload.css" rel="stylesheet">
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
                    <span class="circleHead">
                    <?php
                         $initial = mb_substr($currentUser->name,0,1).mb_substr($currentUser->serName,0,1);          
                              echo $initial;
                                ?>
                    </span>
                </li>
                <li class="nav-item  nav-mr" style="margin:auto auto;">
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
              <header class="col-md-1" style="height:100vh">
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
                        <a href="/diplom/index.php/documents/index/<?php echo $idProject?>" class="nav-link">
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
              <div class="col-md-11" style="border-radius:1%;">
              <div class="menu1">
              <?php if($messages!=0 and $access!=2):?>
                <div class="messages">
                <h5>Уведомления</h5>
                <form method="POST" id="update" action="/diplom/index.php/projects/updateActualEnd">
                <table width="100%">
                <?php foreach($messages as $message):?>
                  <?php if($message['read']==0):?>
                  <tr>
                    <td width="80%">
                      Задача <b><?php echo $message['nameTask']?></b> была отклонена: <?php echo $message['message']?></b>
                    </td>
                    <td width='10%'><button type="submit" name="good" formaction="/diplom/index.php/projects/read/<?php echo $message['messageId']?>/<?=$idProject?>" class="btn btn-primary">Хорошо</button></td>
                  </tr>
                <?php endif;?>
                <?php endforeach;?>
                </table>
                </form>
                </div>
                <?php endif;?>
                <div class="myTasks">
                                <h6>Задачи</h6>
                            <div class="task">
                                <table class="table">
                                <thead>
                                  <tr>
                                  <th scope="col">Название задачи</th>
                                  <th scope="col">Кол-во дней</th>
                                  <th scope="col">Приоритет</th>
                                  <th scope="col">Окончание</th>
                                  <!-- <th scope="col" >Исполнитель</th> -->
                                  <th scope="col">Документ</th>
                                  <th scope="col">Статус</th>
                                 </tr>
                                </thead>
                                <tbody>
                                <?php foreach($tasks as $task):?>
                                <tr>
                                <td data-tooltip="<?=$task['descrip']?>"><span class="nameTask"><?php echo $task['nameTask'];?></span></td>
                                <td> <span class="countDay"><?php
                                  $date1 =date_create($task['actualStart']);
                                  $date2 =date_create($task['actualEnd']);
                                  $interval =  $date2->diff($date1);
                                  echo $interval->d;
                                    ?></span></td>
                                    <td> <?php if($task['importance']!=NULL):?><span class="ratingTask"><?php echo $task['importance'] ?></span>  <?php endif;?></td>
                                    <td><?php echo $task['actualEnd'];?></td>
                                    <!-- <td>       <span class="employeeTask"><?php echo $task['nameEmployee']." ".$task['serName']?></span></td> -->
                                    <td>
                                    <input type="hidden" name="taskId" class="taskId" value="<?php echo $task['taskId']?>">
                                    <?php if($task['fileTask']==NULL):?>
                                    <form class="upload_form" method="POST" enctype="multipart/form-data">
                                    <label class="custom-file-upload">
                                      <input class="input-file" name="doc_file" type="file"/>
                                      Прикрепить
                                      </label>
                                      <input style="display:none;" type="submit" name="upload" value="Upload" class="btn btn-info" />
                                    </form>
                                    <?php else:?>
                                      <form method="POST" action="">
                                      <label class="custom-file-upload">
                                        <input type="text" style="display:none" class="output-file" value="<?php echo $task['fileTask']?>">
                                        <?php echo $task['fileTask']?>
                                      </label>
                                      </form>
                                      <?php endif; ?>
                                    </td>
                                    <td>
                                        <select name="statusTask" class="form-control" class="selectStatus">
                                          <option <?php if($task['statusTask']=='Выполнена') echo 'selected'?> value="done"><?php if($task['notefication']==1) echo "Проверяется";else echo "Выполнена"?></option>
                                          <option <?php if($task['statusTask']=='В_работе') echo 'selected'?> value="inWork">В_работе</option>
                                          <option <?php if($task['statusTask']=='Просрочена') echo 'selected'?> value="Просрочена">Просрочена</option>
                                        </select>
                                    </td>
                                <!-- <td><button type="file" class="attach">Прикрепить</button></td> -->
                                </tr>
                                <?php endforeach;?>
                                </tbody>
                                </table>
                                <div id="tooltip"></div>
                            </div>

 
                        </div>
                </div>
              </div>
            </div>
            </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
            $('.l').click(function(e){
                e.defaultPrevented();
            });
            $(function(){
      $("[data-tooltip]").mousemove(function (eventObject) {
        console.log($(this).attr("data-tooltip"));
        if($(this).attr("data-tooltip")!=""){
          $data_tooltip = $(this).attr("data-tooltip");
        }else return false;
          $("#tooltip").html($data_tooltip)
              .css({ 
                "top" : eventObject.pageY,
                "left" : eventObject.pageX
              })
              .show();
          }).mouseout(function () {
            $("#tooltip").hide()
              .html("")
              .css({
                  "top" : 0,
                  "left" : 0
              });
      });
});
          </script>

          <script>
          $(document).ready(function(){  
            $('select').on('change', function() {

                let val = $(this).val();

                
                let id = $(this).parent().parent().find('.taskId').val();
                console.log(val);
                document.location.href = "/diplom/index.php/projects/changeStatus/"+id+"/"+val+"/"+<?=$idProject?>+"/"+<?=$access?>;
            });
              $('.upload_form').on('change', function(e){ 
                e.preventDefault(); 
                let id = $(this).parent().parent().find('.taskId').val(); 
                let Data = new FormData(this);
                console.log(Data); 
                        $.ajax({  
                            url:"/diplom/index.php/projects/upload/"+id, 
                            method:"POST",  
                            data:Data,  
                            contentType:"application/x-www-form-urlencoded; charset=UTF-8",  
                            processData: false,
                            contentType: false,  
                            success:function(data)  
                            {  
                              if(data==1){
                                document.location.reload();
                              }
                            }  
                        });  
              }); 
              $('.output-file').on('click',function(e){
                let temp = this;
                let taskId = $(this).parent().parent().parent().find('.taskId').val();
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
          });
          </script>
            <script>
            //   $('.file-input').change(function() {
            //     $('.upload_form').submit();
	          //   });
             </script>
      <script src="<?=base_url()?>js/main.js"></script>
      <script src="<?=base_url()?>js/jquery.fileupload.js"></script>
      <script src="<?=base_url()?>js/jquery.fileupload-process.js"></script>
      <script src="<?=base_url()?>js/jquery.iframe-transport.js"></script>
      <script src="<?=base_url()?>js/upload.js"></script>
  </body>
</html>