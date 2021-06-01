<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title><?= $page->title ?></title>
    <link rel="stylesheet" href="content/css/master.css">
    <link rel="stylesheet" href="node_modules\material-design-icons\iconfont\material-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&family=Roboto:wght@100;300;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <header>
    <?= $page->navbar->content ?>
    </header>
    <main>
      <?= $page->content ?>
    </main>
  </body>
    <script type="text/javascript" src="content/scripts/register.js"></script>
    <script type="text/javascript" src="content/scripts/cart.js"></script>
    <script type="text/javascript" src="content/scripts/home.js"></script>
    <script type="text/javascript" src="content/scripts/overlaymenu.js"></script>
</html>
