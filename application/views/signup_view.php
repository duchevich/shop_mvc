<h1><?=$data['page']['title']?></h1>



<div class="form">
	<form action="" method="POST" id="form">
		<span class="error"><?=$data['errors']['name']?></span>
		<input id="name" class="input" type="text" name="name" placeholder="<?=$data['lang']['name']?>">
		<br>
		<span class="error"><?=$data['errors']['email']?></span>
		<input id="email" class="input" type="text" name="email" placeholder="<?=$data['lang']['email']?>">
		<br>
		<span class="error"><?=$data['errors']['pass']?></span>
		<input id="pass" class="input" type="password" name="password" placeholder="<?=$data['lang']['password']?>">
		<br>
		<span class="error"><?=$data['errors']['pass1']?></span>
		<input id="pass1" class="input" type="password" name="password1" placeholder="<?=$data['lang']['password1']?>">
		<input class="submit" type="submit" value="<?=$data['lang']['submit']?>">
	</form>

</div>
<!-- <?php 
	echo '<pre>';
	print_r($data);
	echo '<pre>'; 
?> -->