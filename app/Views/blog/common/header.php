<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!--Facebook sharing data-->
        <meta property="og:url"                content="<?php echo $baseUrl; ?>" />
        <meta property="og:type"               content="article" />
        <meta property="og:title"              content="<?php echo $title; ?>" />
        <meta id="metaPostDesc" property="og:description"        content="" />
        <meta id="metaPostImg" property="og:image"              content="" />
        <meta id="FBappID" property="fb:app_id"              content="<?php echo $FBappID; ?>" />
        <!--Icon and title-->
        <link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon"/>
        <title><?php echo $title; ?></title>
        <!-- Bootstrap -->
        <link href="<?php echo assets('blog/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- Bootstrap social icons -->
        <link href="<?php echo assets('blog/css/bootstrap-social.css'); ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo assets('blog/css/font-awesome.min.css'); ?>" />
        <!-- Animate CSS -->
        <link rel="stylesheet" href="<?php echo assets('blog/css/animate.css'); ?>" />
        <!-- Custom Style -->
        <link rel="stylesheet" href="<?php echo assets('blog/css/style.css'); ?>" />
        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Header -->
        <header>
            <nav class="navbar">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo url('/'); ?>"><?php echo $site_name; ?></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li id="nav-">
                                <a href="<?php echo url('/'); ?>">Home</a>
                            </li>
                            <li id="nav-about" >
                                <a href="<?php echo url('/about'); ?>">About Us</a>
                            </li>
                            <li id="nav-contact" >
                                <a href="<?php echo url('/contact'); ?>">Contact Us</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($categories AS $category) { ?>
                                        <li>
                                            <a href="<?php echo url('category/' . seo($category->name) . '/' . $category->id); ?>"><?php echo $category->name; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if ($user) { ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle user-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo avatar($user->img); ?>" alt="<?php echo $user->name; ?>" title="<?php echo $user->name; ?>" class="user-image" />
                                        <?php echo $user->name; ?>
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <?php if ($user->ugid === '1') { ?>
                                                <a href="<?php echo url('/admin') ?>" target="_blank">Control Panel</a>
                                            <?php } ?>
                                            <a href="<?php echo url('/profile') ?>">My Profile</a>
                                            <a href="<?php echo url('/author') . '/' . $user->name ?>">My posts</a>
                                            <a href="<?php echo url('/logout') ?>">Logout</a>
                                        </li>

                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li><a href="<?php echo url('/login'); ?>">Login</a></li>
                                <li><a href="<?php echo url('/register'); ?>">Register</a></li>
                            <?php } ?>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <!--/ Header -->
        <!-- Content -->
        <div id="content">
