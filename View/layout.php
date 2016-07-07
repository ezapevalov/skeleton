<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Skeleton basic app">
    <meta name="author" content="Eugene Zapevalov">
    <link rel="icon" type="image/png" href="/skeleton.png" />

    <title>Skeleton basic app</title>

    <? foreach ( $this->styles as $s ): ?><link href="<?=$s?>" rel="stylesheet">
    <? endforeach ?>
</head>

<body>

<? include $view ?>

<footer class="footer">
    <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
    </div>
</footer>

<? foreach ( $this->scripts as $s ): ?><script src="<?=$s?>"></script>
<? endforeach ?>

</body>
</html>