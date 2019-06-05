<?php $this->load->helper('url');?>
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
                <form method="post" role='form' action="/diplom/index.php/users/enterHead">
                          <div class="error col-md-6 offset-md-3"></div>
                          <br>
                        <div class="form-group row h-100 justify-content-center align-items-center">
                          <label for="text" class="col-md-2 col-form-label">Email</label>
                          <div class="col-md-4">
                            <input type="email" name="email" class="form-control" id="Email" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-group row h-100 justify-content-center align-items-center">
                          <label for="Password" class="col-md-2 col-form-label">Password</label>
                          <div class="col-md-4">
                            <input type="password" name="pass" class="form-control" id="Password" placeholder="пароль">
                          </div>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="form-group row h-100 justify-content-center align-items-center">
                                <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-user-plus"></i> Войти</button>
                                    </div>
                        </div>
                      </form>
        </div>       
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> 
<script src="<?=base_url()?>js/common.js"></script>
</body>
</html>