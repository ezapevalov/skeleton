<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Skeleton</title>

    <? foreach ( $app->getStyles() as $style ): ?>
        <link type="text/css" href="<?=$style?>" rel="stylesheet">
    <? endforeach ?>
    <? foreach ( $app->getScripts() as $script ): ?>
        <script type="text/javascript" src="<?=$script?>"></script>
    <? endforeach ?>
</head>

<body>
    <?php include(VIEWS_PATH . "$view.php");?>
</body>
</html>