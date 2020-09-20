<!DOCTYPE html>
<html lang="en">

    <?php file_partial("head"); ?>

    <body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

        <div id="fb-root"></div>
<!--        <script async defer crossorigin="anonymous" 
              src="https://connect.facebook.net/en_US/sdk.js#xfbml=1
                   &version={graph-api-version}
                   &appId={your-facebook-app-id}
                   &autoLogAppEvents=1" 
              nonce="FOKrbAYI">
        </script>-->
        
        <script>
            var FULL_BASE_URL = '<?php echo FULL_BASE_URL; ?>';
        </script>
        
        <!-- PRE LOADER -->
        <section class="preloader">
            <div class="spinner">
                <span class="spinner-rotate"></span>
            </div>
        </section>

        <?php file_partial("header"); ?>

        <?php file_partial("top_menu"); ?>

        <?php echo $content; ?>      

        <?php file_partial("footer"); ?>

        <!-- SCRIPTS -->
        <script src="<?php echo VIEWS_URL; ?>js/jquery.js"></script>
        <script src="<?php echo VIEWS_URL; ?>js/bootstrap.min.js"></script>
        <script src="<?php echo VIEWS_URL; ?>js/jquery.sticky.js"></script>
        <script src="<?php echo VIEWS_URL; ?>js/jquery.stellar.min.js"></script>
        <script src="<?php echo VIEWS_URL; ?>js/wow.min.js"></script>
        <script src="<?php echo VIEWS_URL; ?>js/smoothscroll.js"></script>
        <script src="<?php echo VIEWS_URL; ?>js/owl.carousel.min.js"></script>
        <script src="<?php echo VIEWS_URL; ?>js/custom.js"></script>
        <script src="<?php echo VIEWS_URL; ?>lightgallery/js/lightgallery.js"></script>
        <script src="<?php echo VIEWS_URL; ?>js/common.js"></script>

    </body>
</html>