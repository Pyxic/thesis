<?php $this->load->helper('url')?>;
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=base_url()?>css/metisMenu.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/mm-folder.css">
    <link  href="<?=base_url()?>datepicker/dist/datepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>css/style1.css">
</head>
<body class="bg-color">
    <?php  echo $this->session->userdata('userId');?>
                <header>
                  <!--<div style="width:100%; background: green; min-height: 40px; ">входящие</div>-->
                  <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow" style="background-color:#FFFFFF;">
                    <a class="navbar-brand" href="#">MIProject</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="#">проекты</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/diplom/index.php/participants">команда</a>
                        </li>
                      </ul>
                      <ul class="navbar-nav justify-content-end nav-fill">
                        <!-- <li class="nav-item  nav-mr">
                            <img src="envelope-solid.svg" alt="" width="20" height="20" class="countMes">
                        </li> -->
                        <li class="nav-item  nav-mr">
                            <span class="circleHead">
                                <?php 
                                foreach($head as $header){
                                    $initial = mb_substr($header['name'],0,1).mb_substr($header['serName'],0,1);
                                }
                                echo $initial;
                                ?>
                            </span>
                            <!-- <img src="misha.jpg" alt="photo" class="photoEmployee"> -->
                        </li>
                        <li class="nav-item  nav-mr">
                            <span class="nameHead"><?php 
                             foreach($head as $header){
                                echo $header['name'];
                                if($access==2) echo "<span class='statusPart'>Руководитель</span>";else{echo "<span class='statusPart'>Исполнитель</span>";}
                            } ?></span>
                        </li>
                      </ul>
                    </div>
                  </nav>
                </header>
                  <div class="buttonCreateProject" style="padding-bottom:0;margin-bottom:0; color:white;">
                      <span class="hProjects">ПРОЕКТЫ КОМПАНИИ</span>
                  </div>
                  <?php if($access==2):?>
                      <form method="POST" action="" style="margin:0; padding:0;">
                          <input type="button" value="создать проект" class="btn btn-info js-button-campaign" id="createProject">
                      </form>
                <?php endif;?>
                <?php if(count($projects)!=0): ?>
                <div class="projects" <?php if($access!=2) echo "style='margin-top:100px;'"?>>
                <?php foreach($projects as $project):?>
                <?php if($project['statusProject']!='archive'||$access==2):?>
                  <div class="project" data-id="<?=$project['projectId']?>">
                  <span class="statusProject <?php if($project['statusProject']=="active") echo "active"?>"><?php if($project['statusProject']=="active"){ echo "активный";} else echo "архив";?></span>
                  <a class="linkOff" href="/diplom/index.php/projects/structure/<?php echo $project['projectId']?>">
                    <h5 style="font-size: 1.1rem;"><?php echo $project['nameProject']?></h5>
                    
                    <div style="padding-top:10px">
                      <span style="color:gray">начат</span>
                      <span><?php echo $project['startDate']?></span>
                    </div>
                    <div>
                      <span style="color:gray">Финиш</span>
                      <span><?php echo $project['endDate']?></span>
                    </div>
                    <div>
                      Задачи <span class="persante"><?php if(array_key_exists($project['projectId'], $completed)) echo $completed[$project['projectId']]; else echo '0';?>%</span>
                      <div class="progress">
                          <div class="progress-bar" style="width: <?php if(array_key_exists($project['projectId'], $completed)) echo $completed[$project['projectId']]; else echo '0';?>%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    </a>
                    <?php if($project['statusProject']!='archive'&&$access==2):?>
                    <button type="button" class="btn btn-outline-primary btn-sm addToArchive" data-persent="<?php if(array_key_exists($project['projectId'], $completed)) echo $completed[$project['projectId']]; else echo '0';?>" style="margin:5px auto 0px auto;">Добавить в архив</button>
                    <?php endif;?>
                    <?php if($project['statusProject']!='active'&&$access==2):?>
                    <button type="button" class="btn btn-outline-primary btn-sm addToActive" style="margin:5px auto 0px auto;">Активировать</button>
                    <?php endif;?>
                  </div>
                  <?php endif;?>
                  <?php endforeach; ?>
                </div>
                <?php else: ?>
                            <div class="noProject">
                              <p>На данный момент вы не участвуете в никаких проектах</p>
                            </div>
                <?php endif;?>



<div class="overlay js-overlay-campaign">
            <div class="popup js-popup-campaign">
            <form id="crProject" method="POST" action="/diplom/index.php/projects/createProject">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                                <h4>Создать проект</h4>
                                <div class="form-group">
                                <label for="text">Название проекта</label>
                                <input class="form-control" name="nameProject" type="text" placeholder="название проекта">
                                </div>
                        </div>
                        <div class="col-md-7">
                            <br>
                            <h5>Настройки</h5>
                            <b>Руководитель проекта</b><br>
                            <span class="circle photoEmployee"></span>
                            <input type="hidden" id="nameHeadInput" name="Head">
                            <a href="#js-button-leader" class="js-button-leader">
                                <span name="head" id="nameHead">Выбрать</span> <span class="fa fa-cogs"></span>
                            </a>
                            <div class="row">
                                <div class="col">
                                        <label for="datepickerStart">Дата начала</label>
                                        <input type="text" name="stDate" class="form-control datepicker" placeholder="дата начала проекта" data-toggle="datepicker" id="datepickerStart">
                                </div>
                                <div class="col">
                                        <label for="datepickerEnd">Дата окончания</label>
                                        <input type="text" name="endDate" class="form-control datepicker" placeholder="дата завершения проекта" data-toggle="datepicker2" id="datepickerEnd">
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
                            <input class="form-control mr-sm-2 searchUser" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="button">Search</button>
                          </form>
                        <div class="row">
                            <div class="col-md-12">
                                <nav class="nav">
                                    <ul class="metisFolder metismenu width" id="result">
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
                                                <a href=""><span class="fa fa-fw fa-folder-o">Другие</span></a>
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

                                    </ul>
                                    <ul class="metisFolder metismenu width" id="result2">
                                    </u>
                                </nav>
                            </div>
                        </div>
                    <div class="close-popup js-close-leader"></div>
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
            $('.l').click(function(e){
                e.defaultPrevented();
            });
            $('.buttonCreateProject').css({"justify-content":"center"});
          </script>
          <script>
            $('.addToArchive').on("click",function(){
              console.log($(this).attr('data-persent'));
              if($(this).attr('data-persent')!="100"){
                let conf = confirm("В проекте выполнены не все задачи! Вы уверены, что хотите добавить проект в архив?");
                if(conf==false)return false;
              }
              let id = $(this).parents('.project').attr('data-id');
              document.location.href = "/diplom/index.php/projects/addToArchive/"+id;
            });

            $('.addToActive').on("click",function(){
              let id = $(this).parents('.project').attr('data-id');
              document.location.href = "/diplom/index.php/projects/addToActive/"+id;
            });
            $('.searchUser').keyup(function(){
              console.log(1);
              let query = $('.searchUser').val();
              if(query!=""){
                $('#result2').slideDown(0);
                $.ajax({
                  url:"<?php echo base_url(); ?>/index.php/projects/searchUser",
                  method:"POST",
                  data:{query:query},
                  success:function(data){
                    console.log(data);
                    $('#result').slideUp(0);
                    $('#result2').html(data);
                  }
                  });
              }
              if(query==""){
                $('#result').slideDown(0);
                $('#result2').slideUp(0);
              }
            });
          </script>
    	<script src="<?=base_url()?>js/main.js"></script>
      <script src="<?=base_url()?>js/common.js"></script>
</body>
</html>