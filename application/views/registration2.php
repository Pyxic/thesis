<?php $this->load->helper('url');?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/register.css" />
<style>

</style>
</head>
<body>
<div class="container">
	<section id="content">
		<form action="/diplom/index.php/registration/addUser" method="POST">
			<h1>Регистрация</h1>
			<div class=form-group>
				<div class="label">Email</div>
				<input type="text" placeholder="Логин" name="email" required="" id="username" />
			</div>
			<div class="form-group">
				<div class="label">Пароль</div>
				<input type="password" name="pass" placeholder="Пароль" required="" id="password" />
            </div>
            <div class="form-group">
				<div class="label">Имя</div>
				<input type="text" name="name" placeholder="Имя" required="" id="name" />
            </div>
            <div class="form-group">
				<div class="label">Фамилия</div>
				<input type="text" name="sername" placeholder="Фамилия" required="" id="Sername" />
            </div>
            <div class="form-group">
				<div class="label">Название компании</div>
				<input type="text" name="nameCompany" placeholder="Название компании" required="" id="nameCompany" />
            </div>
            <div class="form-group">
				<div class="label">Номер телефона</div>
				<input type="text" name="phone" placeholder="Номер телефона" required="" id="phone" />
			</div>
			<div>
                <input type="submit" value="регистрация" />
				<a href="/diplom/index.php/users" onclick="reg()">Авторизация</a>
			</div>
		</form><!-- form -->
		
	</section><!-- content -->
</div><!-- container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> 
<script src="<?=base_url()?>js/common.js"></script>
<script>
    function reg(){
        document.location.href = "/diplom/index.php/users";
    };
</script>
</body>
</html>