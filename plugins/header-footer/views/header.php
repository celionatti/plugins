<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= ucfirst(page()) ?> | <?= APP_NAME ?></title>
	<link rel="stylesheet" href="<?= ROOT ?>/assets/css/bootstrap.min.css">
</head>

<body>

	<div class="col-md-10 mx-auto p-4">

		<?php if (!empty($links)) : ?>
			<?php foreach ($links as $link) : ?>

				<?php if (user_can($link->permission)) : ?>
					<a href="<?= ROOT ?>/<?= $link->slug ?>"><?= $link->title ?></a>
				<?php endif ?>
			<?php endforeach ?>
		<?php endif ?>
	</div>