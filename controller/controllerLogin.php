<?php
if ($ajaxRequest) {
    require_once "../model/modelLogin.php";
} else {
    require_once "./model/modelLogin.php";
}

class controllerLogin extends modelLogin
{
    /**-----------------------------
     *        Controler login
     *----------------------------*/

    public function controller_login()
    {
        $user = mainModel::clear_chain($_POST['user_log']);
        $key = mainModel::clear_chain($_POST['key_log']);

        if ($user == "" || $key == "") {
            echo '
            <script>
            Swal.fire({
                title: "Ocurrio un error inesperado",
                text: "No has llenado todos los campos que son obligatorios",
                icon: "error",
                confirmButtonText: "Aceptar"
            });
            </script>';

            exit();
        }

        /*== Verifying data integrity ==*/
        if (mainModel::verify_data("[a-zA-Z0-9]{1,35}", $user)) {
            echo '
            <script>
            Swal.fire({
                title: "Ocurrio un error inesperado",
                text: "El nombre de usuario no coincide con el formato solicitado",
                icon: "error",
                confirmButtonText: "Aceptar"
            });
            </script>';

            exit();
        }

        if (mainModel::verify_data("[a-zA-Z0-9$@.-]{7,100}", $user)) {
            echo '
            <script>
            Swal.fire({
                title: "Ocurrio un error inesperado",
                text: "La clave no coincide con el formato solicitado",
                icon: "error",
                confirmButtonText: "Aceptar"
            });
            </script>';

            exit();
        }

        $key = mainModel::encrypt_decrypt('encrypt', $key);

        $login_data = [
            "User" => "$user",
            "Key" => "$key"
        ];

        $account_data = modelLogin::model_login($login_data);

        if ($account_data->rowCount() == 1) {

            $row = $account_data->fetch();


            $_SESSION['id_spm'] = $row['user_id'];
            $_SESSION['firstName_spm'] = $row['user_firstname'];
            $_SESSION['lastName_spm'] = $row['user_lastname'];
            $_SESSION['userName_spm'] = $row['user_username'];
            $_SESSION['privilege_spm'] = $row['user_privilege'];
            $_SESSION['token_spm'] = md5(uniqid(mt_rand(), true));

            if (headers_sent()) {
                echo "<script>window.location.href='" . SERVERURL . "home/'</script>";
            } else {
                return header("Location:" . SERVERURL . "home/");
            }
        } else {
            echo '<script>
            Swal.fire({
                title:"Ocurrio un error inesperado",
                text:"El usuario o clave son incorrectos",
                icon:"error",
                confirmButtonText: "Aceptar"
            });
            </script>
            ';
            exit();
        }
    }
    /**  End of controller **/


    /*----------- Force logOut of controller---------*/
    public function force_logout_controller()
    {
        session_unset();
        session_destroy();
        if (headers_sent()) {
            echo "<script>window.location.href='" . SERVERURL . "login/'</script>";
        } else {
            return header("Location: " . SERVERURL . "login/");
        }
    }
    /**  End of controller **/

    /*----------- Sign off ---------*/
    public function sign_off()
    {
        session_start(['name' => 'SPM']);

        $token = mainModel::encrypt_decrypt('decrypt', $_POST['token']);
        $user = mainModel::encrypt_decrypt('decrypt', $_POST['user']);

        // Tredemolla

        if ($token == $_SESSION['token_spm'] && $user == $_SESSION['userName_spm']) {
            session_unset();
            session_destroy();

            $alert = [
                "Alert" => "redirect",
                "URL" => SERVERURL . "login/",
            ];
        } else {
            $alert = [
                "Alert" => "simple",
                "Title" => "Ocurrio un error inesperado",
                "Text" => "No se pudo cerrar la sesion en el sistema",
                "Type" => "error"
            ];
        }
        echo json_encode($alert);
    }
    /**  End of controller **/
}
