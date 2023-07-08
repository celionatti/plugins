<?php require("functions.php"); ?>

<?php 
    $hero_titles = ['Home', 'Contact'];

    $hero_titles = do_filter('hero_titles', $hero_titles);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    body {
        font-family: tahoma;
    }
</style>

<body>
    <main style="max-width: 1000px; margin:auto; padding:4px;">
        <h1>This is a Plugins Website</h1>
        <div style="display: flex;">
            <div style="flex: 4; background:#eee; padding: 5px;">
                <div style="padding: 10px;">
                <?php foreach($hero_titles as $title): ?>
                    <a href="#"><?= $title ?></a> |
                <?php endforeach; ?>
            </div>
                <img src="images/image(4).jpg" style="max-width:100%;" alt="">
            </div>
            <div style="flex: 1; background:#ddd;">
                <img src="images/image(1).jpg" style="max-width:100%;" alt="">
                <img src="images/image(2).jpg" style="max-width:100%;" alt="">
                <?php do_action('images_section'); ?>
                <img src="images/image(3).jpg" style="max-width:100%;" alt="">
                <img src="images/image(5).jpg" style="max-width:100%;" alt="">
            </div>
        </div>
    </main>
</body>

</html>