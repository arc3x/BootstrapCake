<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->script('jquery.countdown.min');
    echo $this->Html->css('construction');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"/>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h1>Theta Designs</h1>

                    <h2 class="subtitle">We're working on improvements to our website</h2>
                    <?php if(Configure::read('construction_countdown')): ?>
                        <div id="countdown"></div>
                    <?php endif; ?>

                </div>

            </div>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <p class="copyright">Copyright &copy; <?php echo date("Y"); ?> - <a href="http://www.thetadesigns.com">thetadesigns.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php if(Configure::read('construction_countdown')): ?>
        <script type="text/javascript">
            $('#countdown').countdown('2015/11/01', function (event) {
                $(this).html(event.strftime('%w weeks %d days <br /> %H:%M:%S'));
            });
        </script>
    <?php endif; ?>
</body>
</html>
