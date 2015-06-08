<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" a href="template/css/admin_blog.css" type="text/css">

    <title>Carousel Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="template/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="include/ckeditor/ckeditor.js"></script>

    <!-- Custom styles for this template -->
    <link href="template/css/slate.css" rel="stylesheet">

</head>
<!-- NAVBAR
================================================== -->
<body>
<div class="navbar-wrapper">
    <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top navbar navbar-left">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project name</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php?pageid=1">Home</a></li>
                        <li><a href="index.php?pageid=6">Blog</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="#">Separated link</a></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                        <!-- START BLOCK : ADMINPAGE -->
                        <li><a href="index.php?pageid=2">Admin user</a></li>
                        <li><a href="index.php?pageid=3">Admin Blog</a></li>
                        <li><a href="index.php?pageid=10">Admin Project</a> </li>
                        <!-- END BLOCK : ADMINPAGE -->

                    </ul>

                    <!-- START BLOCK : LOGINTOP -->
                    <form class="navbar-form navbar-right" action="index.php?pageid=4" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Username" class="form-control" name="gnaam">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" name="password">
                        </div>
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </form>
                    <!-- END BLOCK : LOGINTOP -->

                    <!-- START BLOCK : LOGGEDIN -->
                    <p class="navbar-text navbar-right">Signed in as <a href="#" class="navbar-link">{USERNAME}</a> - <a href="index.php?pageid=5">Logout</a></p>
                    <!-- END BLOCK : LOGGEDIN -->
                </div>
            </div>
        </nav>