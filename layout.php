<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cuiter</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <link href="style.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <div class="header">
        <nav>
            <ul class="nav nav-pills pull-right">
                <li role="presentation" class="active"><a href="/">Home</a></li>
                <li role="presentation">
                    <form method="get" action="/"><input type="hidden" name="action" value="search"/><input
                            class="search" type="text" name="q" placeholder="Search"/></form>
                </li>
                <li role="presentation"><a href="#">Settings</a></li>
            </ul>
        </nav>
        <h3 class="text-muted">Cuiter</h3>
    </div>

    <?php
    include('view/' . $view . '.php');
    ?>

    <footer class="footer">
        <p>Cuiter 2015</p>
    </footer>

</div>
<!-- /container -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>
</html>
