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
    <link rel="stylesheet" href="<?=base_url()?>css/style1.css">
</head>
<body class="bg-color">
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
              <a class="nav-link" href="index.html">моя работа</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">календарь</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">команда</a>
            </li>
          </ul>
          <ul class="navbar-nav justify-content-end nav-fill">
            <li class="nav-item  nav-mr">
                <img src="envelope-solid.svg" alt="" width="20" height="20" class="countMes">
            </li>
            <li class="nav-item  nav-mr">
                <img src="misha.jpg" alt="photo" class="photoEmployee">
            </li>
            <li class="nav-item  nav-mr">
                <span >Миша</span>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <div class="container">
        <div class="row">
            <main class="col-md-12">
                <div class="create">
                    <div class="nameProject">Папка/имя проекта</div>
                    <div>Руководитель проекта</div>
                    <img src="misha.jpg" alt="photo" class="photoEmployee">
                    <span>Миша</span>
                </div>
                <div class="save">
                    <form action="">
                            <input class="btn btn-primary l" type="submit" value="Сохранить"> 
                            <input class="btn btn-light" type="submit" value="Отменить">
                    </form>
                </div>
                <div class="lifeCicle">
                    <h6>Жизненный цикл проекта</h6>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" style="display:flex;">
                            <table class="table lifeCicleTable">
                                    <td>ЗАРЕГИСТРИРОВАН</td>
                                    <td>БИЗНЕС-ПЛАН ОДОБРЕН</td>
                                    <td>ПРИНЯТ К РЕАЛИЗАЦИИ</td>
                                    <td>ФИНАНСИРОВАНИЕ ВЫДЕЛЕНО</td>
                                    <td>РЕАЛИЗОВАН</td>
                                    <td>ЗАВЕРШЕН</td>
                                </tr>
                            </table>
                            <div class="triangle"></div>
                            </div>
                        </div>
                        <div><a href="" class="nextStage">Перевести на следующий этап <span class="fa fa-arrow-right"></span></a></div>
                    </div>
                </div>
                <div class="reqisites">
                    <h6>Реквизиты</h6>
                    <div class="reqisite">
                        <form action="">
                            <div class="form-group row">
                                <label for="typeProject" class="col-sm-2 col-form-label">Тип проекта</label>
                                <div class="col-sm-4">
                                  <select class="custom-select" id="typeProject">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                    <label for="descriptionProject" class="col-sm-2 col-form-label">Цель проекта</label>
                                    <div class="col-sm-6">
                                      <textarea class="form-control" id="decriptionProject" rows="3"></textarea>
                                    </div>
                                  </div>
                        </form>
                    </div>
                </div>
                <div class="addPartners">
                    <h6>Участники</h6>
                    <form action="">
                        <input type="button" value="Добавить" class="btn btn-primary js-button-leader" id="addPartner">
                    </form>
                    <br>
                    <table class="table table-sm table-striped">
                        <thead class="thead-dark">
                            <th scope="col">Имя</th>
                            <th scope="col">Роль в проекте</th>
                            <th scope="col">E-Mail</th>
                            <th scope="col">должность</th>
                            <th scope="col">Телефон</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Михаил Калита</td>
                                <td>Руководитель</td>
                                <td><a href="">blabla@mail.ru</a></td>
                                <td>Директор по проектам</td>
                                <td>093-000-00-00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Михаил Калита</td>
                                <td>Руководитель</td>
                                <td><a href="">blabla@mail.ru</a></td>
                                <td>Директор по проектам</td>
                                <td>093-000-00-00</td>
                                <td></td>
                            </tr>
                            <tr>
                                    <td>Михаил Калита</td>
                                    <td>Руководитель</td>
                                    <td><a href="">blabla@mail.ru</a></td>
                                    <td>Директор по проектам</td>
                                    <td>093-000-00-00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Михаил Калита</td>
                                    <td>Руководитель</td>
                                    <td><a href="">blabla@mail.ru</a></td>
                                    <td>Директор по проектам</td>
                                    <td>093-000-00-00</td>
                                    <td></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
        <div class="overlay js-overlay-leader">
                <div class="popup js-popup-leader">
                        <h6>Выберите пользователя</h6>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                          </form>
                <div class="row">
                    <div class="col-md-10">
                        <nav class="nav">
                            <ul class="metisFolder metismenu width">
                                <li class="flex">
                                    <a href="" >
                                        <span class="fa fa-folder-o">Руководство</span>                                
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="">
                                                <span class="fa fa-file"> file 1</span>
                                                <span class="nameEmployee">Ген директор</span>
                                            </a>
                                        </li>
                                        <li>
                                                <a href="">
                                                    <span class="fa fa-file">file 2</span>
                                                    <span class="nameEmployee">Ген директор</span>
                                                </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span class="fa fa-file">file 3</span>
                                                <span class="nameEmployee">Ген директор</span>
                                            </a>
                                        </li>
                                        <li>
                                                <a href="">
                                                    <span class="fa fa-file">file 4</span>
                                                    <span class="nameEmployee">Ген директор</span>
                                                </a>
                                            </li>
                                    </ul>
                                </li>
                                <li class="flex">
                                        <a href=""><span class="fa fa-fw fa-folder-o">Проектный офис</span></a>
                                        <ul>
                                                <li>
                                                    <a href="">
                                                        <span class="fa fa-file"> file 1</span>
                                                        <span class="nameEmployee">Ген директор</span>
                                                    </a>
                                                </li>
                                                <li>
                                                        <a href="">
                                                            <span class="fa fa-file">file 2</span>
                                                            <span class="nameEmployee">Ген директор</span>
                                                        </a>
                                                </li>
                                                <li>
                                                    <a href="">
                                                        <span class="fa fa-file">file 3</span>
                                                        <span class="nameEmployee">Ген директор</span>
                                                    </a>
                                                </li>
                                                <li>
                                                        <a href="">
                                                            <span class="fa fa-file">file 4</span>
                                                            <span class="nameEmployee">Ген директор</span>
                                                        </a>
                                                </li>
                                            </ul>
                                </li>
                                <li class="flex">
                                            <a href=""><span class="fa fa-fw fa-folder-o">производство</span></a>
                                            <ul>
                                                    <li>
                                                        <a href="">
                                                            <span class="fa fa-file"> file 1</span>
                                                            <span class="nameEmployee">Ген директор</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                            <a href="">
                                                                <span class="fa fa-file">file 2</span>
                                                                <span class="nameEmployee">Ген директор</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                        <a href="">
                                                            <span class="fa fa-file">file 3</span>
                                                            <span class="nameEmployee">Ген директор</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                            <a href="">
                                                                <span class="fa fa-file">file 4</span>
                                                                <span class="nameEmployee">Ген директор</span>
                                                            </a>
                                                        </li>
                                                </ul>
                                </li>
                                </div>
                            </ul>
                        </nav>
                    </div>
                    <div class="close-popup js-close-leader"></div>
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
    <script src="<?=base_url()?>js/main.js"></script>
</body>
</html>