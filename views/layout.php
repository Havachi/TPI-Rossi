<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $page->title ?></title>
    <link rel="stylesheet" href="content/css/master.css">
    <link rel="stylesheet" href="node_modules\material-design-icons\iconfont\material-icons.css">
  </head>
  <body>
    <header>
    <?php echo $page->navbar->content ?>
    </header>

    <main>
      <?php echo $page->content ?>
    </main>

  </body>
</html>
