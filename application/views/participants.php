<?php $this->load->helper('url');?>
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
    <style>
    .title {
  /* чтобы линии не выходили за ширину блока заголовка */
  overflow: hidden;
  color: lightyellow;
    font-family: arial;
    font-size: 16px;
}
.title:before,
.title:after {
  content: '';

  /* делаем линию строчно-блочной */
  display: inline-block;

  /* выравниваем вертикально по середине */
  vertical-align: middle;

  /* не позволяем ширине превысить 100% (будет добавлен бордюр) */
  box-sizing: border-box;

  /* установка ширины в 100% делает линию равной ширине тега заголовка
  ** благодаря этому линия заполнит все свободное пространство
  ** слева и справа от текста
  */
  width: 100%;
  height: 2px;
  background: lightslategrey;

  /* добавляем к линии левый и правый бордюр цветом основного фона заголовка
  ** благодаря этому создается нужный отступ между линиями и текстом
  */
  border: solid lightslategrey;
  border-width: 0 10px;
}
.title:before {
  /* смещаем левую линию влево отрицательным отступом, равным 100% ширины
  ** благодаря этому линия встает слева от текста
  */
  margin-left: -100%;
}
.title:after {
  /* смещаем правую линию вправо отрицательным отступом, равным 100% ширины
  ** благодаря этому линия встает справа от текста
  */
  margin-right: -100%;
}
</style>
</head>
<body class="bg-color">
    <?php  echo $this->session->userdata('userId');?>
                <header>
                  <!--<div style="width:100%; background: green; min-height: 40px; ">входящие</div>-->
                  <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow" style="background-color:#FFFFFF;">
                    <a class="navbar-brand" href="/diplom/index.php/projects">MIProject</a>
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
                            }?></span>
                             
                        </li>
                      </ul>
                    </div>
                  </nav>
                </header>
                <!-- <?php if($access==2):?>
                <div class="buttonCreateProject">
                      <div class="buttonStyle">
                        <div class="invite">
                        <input type="button" value="Пригласить пользователя" class="btn btn-primary js-button-campaign" id="inviteUser">
                        </div>
                        <div class="dep">
                        <input type="button" value="Создать отдел" class="btn btn-primary">
                        </div>
                        <div id="inputDep" style="position:relative; display:none;">
                          <input type="text" id = "inputDepartment"class="form-control" style="margin-left:10px;" placeholder="Введите название">
                          <div class="btnCreateDep" style="position:absolute;top: 0;left: 171px;">
                            <button class="btn btn-dark btnCreateDepartment">СОЗДАТЬ</button>
                          </div>
                        </div>
                      </div>
                </div>
                <?php endif;?> -->
                <div class="buttonCreateProject" style="display:block; text-align:center; color:white;">
                      <span class="hProjects">СОТРУДНИКИ КОМПАНИИ</span>
                      <?php if($access==2):?>
                      <div style="display:flex; justify-content:flex-start;">
                      <form method="POST" action="" style="margin:0 0 0 5px; padding:0;">
                      <input type="button" value=" Пригласить" style="margin-right:10px;" class="btn btn-primary js-button-campaign" id="inviteUser">
                      </form>
                <div class="dep">
                        <input type="button" value="Создать отдел" class="btn btn-primary">
                        </div>
                        <div id="inputDep" style="position:relative; display:none;">
                          <input type="text" id = "inputDepartment"class="form-control" style="margin-left:10px;" placeholder="Введите название">
                          <div class="btnCreateDep" style="position:absolute;top: 0;left: 171px;">
                            <button class="btn btn-dark btnCreateDepartment">СОЗДАТЬ</button>
                          </div>
                        </div>
                        </div>
                        <?php endif;?>
                  </div>
                <?php if($access!=2) echo "<div style='margin-top:100px'></div>"?>
                <?php foreach($departments as $depart):?>
                  <div class="title">
                      <?=$depart['name']?> <button class="btnAddUserDepart" data-departId=<?=$depart['departId']?>><?php if($access==2)echo"(+ добавить пользователя)"?></button>
                    </div>
                    <div class="participants">
                            <?php foreach($users as $user):?>
                              <?php if($depart['departId']==$user['departId']):?>
                                <div class="participant">
                                    <div class="fullNameParticipant">
                                        <span class="name"><?php echo $user['name']?></span>
                                        <span class="sername"><?php echo $user['serName']?></span>
                                        <span class="circle2"><?php
                                        $initial = mb_substr($user['name'],0,1).mb_substr($user['serName'],0,1);          
                                    echo $initial;
                                    ?></span>
                                    </div>
                                    <div class="email"><?php echo $user['email']?></div>
                                    <div class="phone"><span class="contacts">Моб.</span><?php echo $user['phone']?></div>
                                    <div class="link">
                                        <span class="countProjects">
                                        <img src="https://img.icons8.com/material-rounded/24/000000/shopping-bag.png">
                                        <?php echo $user['countProjects']?>
                                        </span>
                                        <span class="statusPart">
                                            <img src="https://img.icons8.com/material-rounded/24/000000/administrator-male.png">
                                            <?php
                                              if($user['status']==2) echo "Руководитель";
                                              elseif($user['status']==1) echo "Сотрудник";
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endif;?>
                          <?php endforeach;?>
                </div>
                <?php endforeach;?>
                <div class="title">
                    Остальные
                    </div>
                <div class="participants">
                            <?php foreach($users as $user):?>
                            <?php if($user['departId']==0):?>
                              <div class="participant">
                                  <div class="fullNameParticipant">
                                      <span class="name"><?php echo $user['name']?></span>
                                      <span class="sername"><?php echo $user['serName']?></span>
                                      <span class="circle2"><?php
                                      $initial = mb_substr($user['name'],0,1).mb_substr($user['serName'],0,1);          
                                  echo $initial;
                                  ?></span>
                                  </div>
                                  <div class="email"><?php echo $user['email']?></div>
                                  <div class="phone"><span class="contacts">Моб.</span><?php echo $user['phone']?></div>
                                  <div class="link">
                                      <span class="countProjects">
                                      <img src="https://img.icons8.com/material-rounded/24/000000/shopping-bag.png">
                                      <?php echo $user['countProjects']?>
                                      </span>
                                      <span class="statusPart">
                                          <img src="https://img.icons8.com/material-rounded/24/000000/administrator-male.png">
                                          <?php
                                            if($user['status']==2) echo "Владелец";
                                            elseif($user['status']==1) echo "Исполнитель";
                                          ?>
                                      </span>
                                  </div>
                              </div>
                          <?php endif;?>
                          <?php endforeach;?>
                </div>
                <div class="overlay js-overlay-partic" id="scrollPart">
                            <div class="popup js-popup-partic">
                              <div class="container centered">
                              <div class="row">
                                <div class="col-md-12">
                                  <nav class="nav">
                                    <ul class="metisFolder metismenu width">
                                      <li class="flex">
                                        <ul id="addPartic">

                                        </ul>
                                      </li>
                                </div>
                                <div class="close-popup js-close-partic"></div>
                              </div>
                              </div>
                            </div>
                </div>
                <div class="overlay js-overlay-campaign">
            <div class="popup js-popup-campaign" style="width:800px;">
            <form id="invUser" method="POST" action="/diplom/index.php/participants/inviteUser">
                <div class="container centered">
                <h2 style="margin-bottom:40px;">Пригласить в аккаунт</h2>
                      <input type="hidden" name="createBool" id="createBool" value="0">
                      <div class="container centered " style="width:600px;">
                      <div class="form-group row">
                        <label for="emailenvite" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="emailenvite" name="email" placeholder="Email сотрудника">
                        </div>
                        </div>
                        <div class="form-group row">
                          <label for="text" class="col-sm-2 col-form-label">Имя</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control noImportant" name="name" placeholder="Имя сотрудника">
                          </div>
                        </div>
                      </div>
                      <br>
                      <div>
                          <div class="btn btn-link department">БЕЗ ОТДЕЛА</div>
                          <input type="hidden" id="sendDepart" name="createDepart" value="no">
                          <div style="display:flex;justify-content:center;">
                          <div class="inputDepart">
                            <div style="display:flex; position:relative;">
                                <input type="text" class="form-control form-control-sm inputCreateDepart">
                                <input type="button" style="position:absolute;left:165px;" value="OK" class="btn btn-dark btn-sm buttonCreateDepart">
                            </div>
                          </div>
                              <div class="departmentSelect">
                                    <select style="overflow:hidden;" multiple name="department" class="form-control form-control-sm " id="departSelect">
                                      <option value="createDepart">Создать отдел</option>
                                      <?php foreach($departments as $depart):?>
                                      <option value="<?=$depart['departId']?>"><?=$depart['name']?></option>
                                      <?php endforeach;?>
                                    </select>
                                </div>
                          </div>
                      </div>
                      <br>
                      <div>
                      <input class="btn btn-primary l" type="submit" value="Пригласить пользователя"> 
                      </div>

                </div>
              </form>
                <div class="close-popup js-close-campaign"></div>
            </div>
        </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="<?=base_url()?>js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>datepicker/dist/datepicker.js"></script>
    <script>
      $('.buttonCreateProject').addClass("buttonCreateProject2");
    </script>
    <script>
      $('.department').on("click",function(){
        $('.department').fadeOut();
        $('.departmentSelect').fadeIn();
      });
      $('#departSelect').on("change",function(){
          if($('#departSelect').val()=="createDepart"){
            $('#departSelect option:selected').each(function(){
                this.selected=false;
            });
            $('.departmentSelect').fadeOut();
            $('.inputDepart').fadeIn();
          }else{
            $('#createBool').val('0');
            $('.department').text($('#departSelect option:selected').text());
            $('#sendDepart').val($('#departSelect option:selected').text());
            $('.departmentSelect').fadeOut();
            $('.department').fadeIn();
          }  
      });
      $('.buttonCreateDepart').on("click",function(){
        if($('.inputCreateDepart').val()==""){
          $('.inputDepart').fadeOut();
          $('.department').fadeIn();
        }else{
          $('.department').text($('.inputCreateDepart').val());
          $('#sendDepart').val($('.inputCreateDepart').val());
          $('#createBool').val('1');
          $('.inputDepart').fadeOut();
          $('.department').fadeIn();
        }
      })
      $('.dep').on("click",function(){
        $('.dep').slideUp(0);
        $('#inputDep').slideDown(0);
      });

      $('.btnCreateDepartment').on("click",function(){
        let name = $('#inputDepartment').val();
        if(name==""){
          $('.dep').slideDown(0);
        $('#inputDep').slideUp(0);
        }else{
          console.log($('#sendDepart').attr('data-create'));
          let Data = {"name":name};
          $.ajax({
            url: "/diplom/index.php/participants/createDepart/", 
                method:"POST", 
                contentType:"application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",   
                data: Data,
                success:function(data)  
                { 
                  if(data['command']==1){
                    document.location.reload();
                  }else if(data['alert']==true){
                            alert(data['error']);
                        }
                },
                error:function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown);
                } 
          });
        }
      });

      $('.buttonCreateProject').css({"justify-content":"center"});
    </script>
    <script src="<?=base_url()?>js/common.js"></script>
    <script src="<?=base_url()?>js/main.js"></script>
</body>
</html>