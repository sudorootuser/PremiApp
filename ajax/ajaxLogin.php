<?php
$ajaxRequest = true;

require_once "../config/APP.php";

if (isset($_POST['token']) && isset($_POST['user'])) {

    /**------------------ Controller is instantiated -------------**/

    require_once "../controller/controllerLogin.php";
    $ins_login = new controllerLogin();

    echo $ins_login->sign_off();

    /**------------------ Add a new user ------------------**/
} else {
    session_start(['name' => 'SPM']);
    session_unset();
    session_destroy();
    header("Location:" . SERVERURL . "login/");
    exit();
}
