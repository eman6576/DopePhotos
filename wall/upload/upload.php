<?php
include('uploadphoto.php');
require_once "wallsession.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DopePhotos</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href="css/upload.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../wall.php">DopePhotos</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>PhotoGenerator5000</h1>
                <br>
                <br>
                <br>
                <form id="form" class="form-horizontal" method="post" action="upload.php" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label class="sr-only" for="image">Your Image</label>
                        <img id="image" name="image" src="/" width="100%" hidden="hidden">
                        <input type="file" id="upload" name="upload" accept="image/*">
                    </div>
                    
                    <div id="checkboxlist" class="form-group" hidden="hidden">
                        <h3>Filter Photo</h3>
                        <div class="checkbox-inline">
                            <label for="myNostalgia">My Nostalgia</label>
                            <input type="radio" name="filter" id="myNostalgia" value="nostalgia" onclick="applyMyNostalgiaFilter();">
                        </div>
                        <div class="checkbox-inline">
                            <label for="grayscale">Grayscale</label>
                            <input type="radio" name="filter" id="grayscale" value="grayscale" onclick="applyGrayscaleFilter();">
                        </div>
                        <div class="checkbox-inline">
                            <label for="myNostalgia">Negative</label>
                            <input type="radio" name="filter" id="negative" value="negative" onclick="applyNegativeFilter();">
                        </div>
                        <div class="checkbox-inline">
                            <label for="original">Revert to Original</label>
                            <input type="radio" name="filter" id="lomo" value="none" onclick="revertToOriginal();">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="title" class="control-label col-xs-1">Title</label>
                        <div class="col-xs-11">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-header fa-fw"></span></span>
                                <input type="text" class="form-control" id="title" name="title" 
                            maxlength="20" size="20" value="" required placeholder="Enter a title" autofocus>
                            </div>
                        </div>
                    </div>
                      
                    <div class="form-group">
                        <label for="text" class="control-label col-xs-1">Text</label>
                        <div class="col-xs-11">
                            <textarea class="form-control" id="text" name="text" maxlength="255" placeholder="up 255 characters" required></textarea>
                        </div>
                    </div>
                    
                    <input type="submit" value="Upload" class="btn btn-primary col-md-offset-1">
                    <input type="button" id="resetForm" value="Start over!" class="btn btn-default" onclick="resetUploader();"><br>
                    <span class="error"><?php echo $error; ?></span>
                </form>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script src="js/frontend.js"></script>

</body>

</html>
