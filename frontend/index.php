<?php
$_is_a_theme = false;

if (isset($_GET['k'])) {
    // Get the json
    include __DIR__ .'/config.php';
    $con = mysql_connect(HOST, USER, PASSWORD);
    mysql_select_db(_DB_MAIN);
    $k = mysql_real_escape_string($_GET['k']);
    $q = mysql_query("SELECT `json` FROM `themes` WHERE `key` = '$k'");
    if (mysql_num_rows($q)) {
        $_is_a_theme = true;
        $row = mysql_fetch_array($q);
        $j = htmlspecialchars_decode($row['json']);
        $jobj = json_decode($j, true);
        $title = 'my Facebook chat theme using Facebook Chat Customiser';
        $description = 'Here\'s my chat theme on Facebook, click to try this on yours #FCC #Facebook_Chat_Customiser';
        $image = "http://cistoner.org/labs/fcctheme/share.php?k=" .$k;
    }
}

if (!$_is_a_theme) {
    // General share
    $title = 'Facebook Chat Customiser';
    $description = "Frustrated with tiny Facebook's chat layout? You use facebook for chatting purpose but don't find the chat layout user friendly? Install this extension and customize your facebook chat on the go.";
    $image = "http://cistoner.org/labs/fccshare/share.png";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="<?= $description; ?>">
    <meta name="og:description" content="<?= $description; ?>">
    <meta name="author" content="Minhaz">

    <meta property="og:title" content="<?= $title; ?>">
    <meta property="og:site_name" content="cistoner">
    <meta property="og:image" content="<?= $image; ?>">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="800">


    <title><?= $title; ?></title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="chrome-webstore-item" href="https://chrome.google.com/webstore/detail/icnpgdbaooggmkndmiaogcokgmpdfdmc">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
         ul.feat li:before {
            content: '✔';   
            margin-left: -1em; margin-right: .150em;
         }
         li {list-style-type: none}
    </style>
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Facebook Chat Customiser</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <?php
                    if ($_is_a_theme) {
                    ?>
                    <li class="page-scroll">
                        <a href="#theme">Theme</a>
                    </li>
                    <?php
                    }
                    ?>
                    <li class="page-scroll">
                        <a href="#about">About</a>
                    </li>
                    <li class="page-scroll">
                        <a href="https://github.com/mebjas/facebook-chat-customiser" target="new">Source</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header style="background:#18BC9C">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="<?= $image; ?>" alt="" width="650px">
                    <?php
                    if ($_is_a_theme) {
                    ?>
                    <div class="intro-text">
                        <span class="name">My theme using Facebook Chat Customiser</span>
                        <hr class="star-light">
                        <span class="skills">Easy - Quick - Fast - Awesome - Open Source</span>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>

<?php
if ($_is_a_theme) {
?>

<section style="background:#54BB79" class="success" id="theme">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Use this theme</h2>
                    <hr style="width:35%">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <textarea class="code"><?= $j; ?></textarea>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
    <!-- About Section -->
    <section style="background:#252525" class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr style="width:35%">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p><strong>#FCC:</strong> Frustrated with tiny Facebook's chat layout? You use facebook for chatting purpose but don't find the chat layout user friendly? Install this extension and customize your facebook chat on the go.</p>
                </div>
                <div class="col-lg-4">
                    <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Features:
                    <ul class="feat">
                        <li>Now customise everything on facebook chat, from text to bubble background, height to transparency!</li>
                        <li>Completely customise your facebook chats</li>
                        <li>Resize your facebook Chat-Box</li>
                        <li>Change text color, font, size, bubble background, bold, italics ...</li>
                        <li>Make chat box transclusent</li>
                        <li>Customise from Facebook Chat Settings</li>
                        <li>Choose from themes, import or export themes</li>
                        <li>Customise your chat and share the theme with your friends</li>


                    </ul>
                    </p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="https://chrome.google.com/webstore/detail/facebook-chat-customiser/cfdnmijlibfnjggfeipmjhkbieegjhbd" class="btn btn-lg btn-outline" title="click to install now!">
                        <i class="fa fa-download"></i> Install Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Contribute at Github</h3>
                        <p>Facebook Chat Customiser is open source, its source code is available <a href="">here</a>! Feel freen to contribute, post bugs or feature requests!</p>
                        <!--
                        <p><a href="http://github.com/mebjas/Wiki-Read-Mode" title="easywiki @github">mebjas/Wiki-Read-Mode</a>

                        <br>
                        <a href="https://github.com/mebjas/Wiki-Read-Mode/issues/new" title="Submit a bug or feature!">Found a bug? Report here</a></p>
                        -->

                    </div>
                    <div class="footer-col col-md-4">
                    <br><br><br>
                        <iframe src="http://ghbtns.com/github-btn.html?user=mebjas&repo=facebook-chat-customiser&type=fork"
                            allowtransparency="true" frameborder="0" scrolling="0" width="62" height="20"></iframe> 
                            <br>
                        <iframe src="http://ghbtns.com/github-btn.html?user=mebjas&repo=facebook-chat-customiser&type=watch"
                            allowtransparency="true" frameborder="0" scrolling="0" width="62" height="20"></iframe>
                            <br>
                        <iframe src="http://ghbtns.com/github-btn.html?user=mebjas&repo=facebook-chat-customiser&type=follow"
                            allowtransparency="true" frameborder="0" scrolling="0" width="115" height="20"></iframe> 
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Related</h3>
                        <ul style="text-align:left">
                            <li><a href="https://chrome.google.com/webstore/detail/easywiki/icnpgdbaooggmkndmiaogcokgmpdfdmc" title="EasyWiki - Chrome Extension">EasyWiki - a wasier wikipedia</a></li>
                            <li><a href="http://github.com/mebjas/image-jigsaw" title="@github">Image Jigsaw - jQuery plugin</a></li>
                            <li><a href="https://github.com/mebjas/windows8-tile-menu" title="@github">Window 8 Menu - jQuery plugin</a></li>
                            <li><a href="https://github.com/mebjas/jQuery-sticky-elements" title="@github">Sticky Menu - jQuery plugin</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; <a href="http://cistoner.org">cistoner.org</a> 2014
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-37229689-3', 'auto');
      ga('send', 'pageview');

    </script>
</body>

</html>
