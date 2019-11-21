<!doctype html>
<html>
	<head>
		<title>Welcome to url shortener</title>

	</head>
	<body>


		<div class="wrap">



			<h1>Welcome to url shortener</h1>

			<div>
				<form method="post"  action="<?php echo '/home/short';?>">
					<label for="url">paste your url: </label>
					<input type="text" name="url" id="url" value=""/>
					<button type="submit" name="short">Short!</button>
				</form>


			</div>
			<?php if(!empty($url)): ?>
			<div class="footer">
				Your short url is: <a href="<?=  '//' . $url ?>"><?= $vurl ?></a>
			</div>
			<?php endif; ?>

		</div>

	</body>
</html>
