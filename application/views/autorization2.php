<?php $this->load->helper('url');
$info = [
	[
		'email' => 'dfgfh',
		'age' => 12,
		'isMale' => true
	],
	[
		'email' => 'afdfgfh',
		'age' => 9,
		'isMale' => false
	],
	[
		'email' => 'vbvdfgfh',
		'age' => 14,
		'isMale' => true
	]
];
print_r($info);
foreach ($info as $key => $row) {
    $email[$key]  = $row['email'];
	$isMale[$key] = (string)$row['isMale'];
	$age[$key] = $row['age'];
}
array_multisort($email, SORT_ASC, $info);
array_multisort($isMale,SORT_STRING, SORT_ASC, $info);
array_multisort($age,SORT_ASC,$info);
print_r($info);
	// function digitCounter($numeral,$number){
	// 	$count = 0;
	// 	$numberArray = preg_split('//',(string)$number);
	// 	for($i=0;$i<count($numberArray);$i++){
	// 		if((string)$numeral==$numberArray[$i]) $count++;
	// 	}
	// 	return $count;
	// }
	// echo digitCounter(7,54677545645);

	// function sumArray($ar) {
	// 	$sum=0;
	// 	foreach($ar as $k => $v) {
	// 	if (gettype($v)=='integer') $sum += $v;
	// 	else if (is_array($ar[$k]))
	// 	 {
	// 	  $sum +=sumArray($v);
	// 	 }
	// 	}
	// 	return $sum;
	// }
	// echo sumArray($counter);

	
	// $summ = 0;
	// foreach($cards as $v)
	// if(gettype($v)=='integer'){
	// 	$summ += $v;
	// }
	// echo $summ;
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/register.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<style>

</style>
</head>
<body>
<div class="container">
	<section id="content">
		<form action="/diplom/index.php/users/enterHead" method="POST">
			<h1>Авторизация</h1>
			<div class=form-group>
				<div class="label">Email</div>
				<input type="text" placeholder="Логин" name="email" required="" id="username" />
			</div>
			<div class="form-group">
			<div class="label">Пароль</div>
				<input type="password" name="pass" placeholder="Пароль" required="" id="password" />
			</div>
			<div>
                <input type="submit" value="Войти" />
				<a href="/diplom/index.php/registration" onclick="reg()">Регистрация</a>
			</div>
		</form><!-- form -->
		
	</section><!-- content -->
</div><!-- container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> 
<script src="<?=base_url()?>js/common.js"></script>
<script>
    function reg(){
        document.location.href = "/diplom/index.php/registration";
    };
</script>
</body>
</html>