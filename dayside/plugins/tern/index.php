<? include __DIR__."/../../server/build.php" ?>
<!doctype html>
<html>
    <head>
        <title>Tern plugin test</title>
        <meta charset="utf-8">
        
        <script src="../../server/assets/teacss/teacss.js"></script>
        
        <script src="../../server/assets/teacss/teacss-ui.js"></script>
        <link href="../../server/assets/teacss/teacss-ui.css" rel="stylesheet" type="text/css">
            
        <script src="../../client/dayside.js"></script>
        <link href="../../client/dayside.css" rel="stylesheet" type="text/css">
        
        <? if (build("makefile.tea","tern.css","tern.js",__DIR__)!='dev'): ?>
            <script>
                dayside({
                    root: teacss.path.absolute("./")
                });
                dayside.plugins.tern();
            </script>
        <? endif ?>
    </head>
</html>      