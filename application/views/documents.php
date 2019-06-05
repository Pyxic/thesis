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
#docHead{
  text-align: center;
    margin-top: 20px;
    margin-bottom: 30px;
}
    </style>
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
                    <span class="circleHead">
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
              <div class="col-md-11" style="border-radius:1%;">
                <h2 id="docHead">ДОКУМЕНТЫ</h2>
                <div class="menu1">
                <?php if(count($documents)!=0): ?>
                    <div class="document">
                                <?php foreach($documents as $doc):?>
                                <?php if($doc['fileAccess']!='head'||$access==2):?>
                                <div class="doc">
                                    <a href="" class="ext">
                                        <u></u>
                                        <i><?php list($name,$extend) = preg_split("[\.]",$doc['fileTask'],2); echo $extend;?></i>
                                    </a>
                                    <b><?=$name?></b>
                                    <em>Прикреплен к задаче <span class="task"><?=$doc['name']?></span></em>
                                    <span class="download" data-taskId="<?=$doc['taskId']?>">
                                        <span class="ico ico_dload_new"><i class="fa fa-download"></i></span>
                                    </span>
                                    <span class="accessStyle">доступ</span>
                                    <b class="fileAccess">
                                        <span><?php if($doc['fileAccess']=='all'){echo "все";}else{echo "личный";}?></span>
                                        <div class="chooseAccess">
                                            <span class="all">все</span>
                                            <span class="head">личный</span>
                                        </div>
                                    </b>
                                    <strong data-nameTask="<?=$doc['fileTask']?>" class="deleteFile"><i class="fa fa-times"></i></strong>
                                </div>
                                <?php endif;?>
                                <?php endforeach;?>
                    </div>
                    <?php else: ?>
                            <div class="noDocument">
                              <p>На данный момент в проекте нет документов</p>
                            </div>
                <?php endif;?>
              </div>
            </div>
        </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="<?=base_url()?>js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>datepicker/dist/datepicker.js"></script>
    <?php if($access==2):?>
    <script>
        $(".fileAccess").on("click",function(){
            if($(this).attr('class')=="fileAccess disabled") return false;
            $(this).children('.chooseAccess').slideDown(0);
        });
    </script>
    <?php endif;?>
    <script>
      $('.download').on("click",function(){
        let taskId = $(this).attr("data-taskId");
        document.location.href = "/diplom/index.php/documents/downloadFile/"+taskId;
      });
    </script>
    <?php if($access==2):?>
      <script>
        $('.all').on("click",function(){
          let taskId = $(this).parents('.doc').children('.download').attr('data-taskId');
          let Data = {"taskId":taskId,"access":'all'};
          $.ajax({
              url:"/diplom/index.php/documents/changeAccessFile",
              method:"POST",
              contentType:"application/x-www-form-urlencoded; charset=UTF-8",
              data:Data,
              success:function(data){
                  if(data==1){
                    document.location.reload();
                  }
              }

            });
        });
        $('.head').on("click",function(){
          let taskId = $(this).parents('.doc').children('.download').attr('data-taskId');
          let Data = {"taskId":taskId,"access":'head'};
          $.ajax({
              url:"/diplom/index.php/documents/changeAccessFile",
              method:"POST",
              contentType:"application/x-www-form-urlencoded; charset=UTF-8",
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
        $('.deleteFile').on("click",function(){
          let confir = confirm("Вы действительно хотите удалить файл "+$(this).attr("data-nameTask")+"?");
          if(confir==true){
            let file = $(this).attr("data-nameTask");
            let taskId = $(this).parents('.doc').children('.download').attr('data-taskId');
            let idProject = <?=$idProject?>;
            let Data = {"file":file,"taskId":taskId};
            $.ajax({
              url:"/diplom/index.php/documents/deleteFile",
              method:"POST",
              contentType:"application/x-www-form-urlencoded; charset=UTF-8",
              data:Data,
              success:function(data){
                  document.location.reload();
              }

            });
          }
        });
      </script>
    <?php endif;?>
    <script src="<?=base_url()?>js/common.js"></script>
    <script src="<?=base_url()?>js/main.js"></script>
  </body>
</html>