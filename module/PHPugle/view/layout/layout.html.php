<?php

$viewChildren = $this->viewModel()->getCurrent()->getChildren();
$vars = reset($viewChildren)->getVariables();
extract($vars);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= $title ?></title>
    <?php if (isset($description)) : ?> <meta name="description" content="<?= $description ?>"><?php endif; ?>

    <!-- Enable responsive viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap styles -->
    <link href="<?= $asset_path; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional theme -->
    <link href="<?= $asset_path; ?>/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Sticky Footer -->
    <link href="<?= $asset_path; ?>/bootstrap/css/bs-sticky-footer.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="<?= $asset_path; ?>/css/style.css?body=1" rel="stylesheet" type="text/css" media="all">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div id="wrap">
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#jb-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $this->serverUrl(); ?>"><?= $app_title ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="jb-navbar-collapse">
            <ul class="nav navbar-nav">
                <?php foreach ($navigation as $label => $href) : ?>
                    <li><a href="<?=$href?>"><?=$label?></a></li>
                <?php endforeach; ?>
            </ul>
            <a href="https://github.com/pugle/pugle.github.io"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/e7bbb0521b397edbd5fe43e7f760759336b5e05f/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677265656e5f3030373230302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_green_007200.png"></a>
        </div>
    </nav>

    <div class="container">
        <?php echo $this->content; ?>
    </div>

</div>


<!-- Latest compiled and minified JavaScript, requires jQuery 1.x (2.x not supported in IE8) -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?= $asset_path; ?>/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>