<h1><?=$data['page']['title']?></h1>

<div class="form">
	<form action="" method="POST" id="form">
		<br>
		<span class="error"><?=$data['errors']['name']?></span>
		<input class="input" type="text" name="name" placeholder="<?=$data['lang']['name']?>">
		<br>
		<span class="error"><?=$data['errors']['pass']?></span>
		<input class="input" type="password" name="password" placeholder="<?=$data['lang']['password']?>">
		<input class="submit" type="submit" value="<?=$data['lang']['submit']?>">
	</form>

</div>