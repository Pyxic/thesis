<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/registration.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="bg-color-light">
        <div class="container h-100 registration" style="margin-top:5%">
            <div class="h-100 justify-content-center align-items-center">
                    <form method="post" action="/diplom/index.php/registration/registerEmployee">
                            <div class="form-group row h-100 justify-content-center align-items-center">
                              <label for="Password" class="col-md-2 col-form-label">Password</label>
                              <div class="col-md-4">
                                <input type="password" name ="pass" class="form-control" id="Password" placeholder="пароль">
                              </div>
                            </div>
                            <input type="hidden" name="email" value="<?php echo $email?>">
                            <input type="hidden" name="companyId" value="<?php echo $companyId?>">
                            <?php if($depart):?>
                              <input type="hidden" name="depart" value="<?=$depart?>">
                            <?php endif;?>
                            <div class="form-group row h-100 justify-content-center align-items-center">
                                    <label for="Name" class="col-sm-2 col-form-label">Имя</label>
                                    <div class="col-sm-4">
                                      <input type="text" name="name" class="form-control" id="Name" placeholder="Имя">
                                    </div>
                            </div>
                            <div class="form-group row h-100 justify-content-center align-items-center">
                                    <label for="Sername" class="col-sm-2 col-form-label">Фамилия</label>
                                    <div class="col-sm-4">
                                      <input type="text" name="sername" class="form-control" id="Sername" placeholder="Фамилия">
                                    </div>
                            </div>
                            
                            <div class="form-group row h-100 justify-content-center align-items-center">
                                    <label for="phone" class="col-sm-2 col-form-label">Телефон</label>
                                    <div class="col-sm-4">
                                      <input type="text" name ="phone" class="form-control" id="phone" placeholder="Номер телефона">
                                    </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="form-group row h-100 justify-content-center align-items-center">
                                    <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-user-plus"></i>Заррегистрироваться</button>
                                        </div>
                            </div>
                          </form>
            </div>       
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
</body>
</html>