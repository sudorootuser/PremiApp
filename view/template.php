<?php session_start(['name' => 'SPM']); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo COMPANY; ?></title>
    <link rel="icon" href="<?php echo SERVERURL; ?>/view/assets/img/LOGO_PRL_PREMIAPP.png" type="image/x-icon">

    <!-- Styles link -->
    <?php include "./view/inc/Link.php"; ?>

</head>

<body>
    <?php
    $ajaxRequest = false;
    require_once "./controller/controllerView.php";

    $IV = new controllerView();

    $view = $IV->get_controller_view();

    if ($view == "login" || $view == "404") {
        require_once "./view/content/" . $view . "-view.php";
    } else {
        // Data is extrated from the sécified URL
        $page = explode("/", $_GET['views']);

        require_once "./controller/controllerLogin.php";
        $cl = new controllerLogin();

        if (!isset($_SESSION['token_spm']) || !isset($_SESSION['userName_spm']) || !isset($_SESSION['privilege_spm']) || !isset($_SESSION['id_spm'])) {
            $cl->force_logout_controller();
            exit();
        } ?>

        <!-- Main container -->
        <main class="full-box main-container">

            <!-- Side Navigation -->
            <?php include './view/inc/slideNavigation.php'; ?>

            <!-- Page content -->
            <section class="full-box page-content">
                <?php
                include_once './view/inc/navBar.php';

                include $view;
                ?>
            </section>
        </main>

        <!--=============================================
	=            Include JavaScript files           =
	==============================================-->
    <?php
        include './view/inc/logOut.php';
    }
    include './view/inc/script.php';
    ?>
</body>

</html>