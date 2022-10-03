<?php
require_once "mainModel.php";

class modelLogin extends mainModel
{

    /** Model login **/
    protected static function model_login($data)
    {

        // var_dump($data);die;
        $sql = mainModel::connect()->prepare("SELECT * FROM user WHERE user_username=:User || user_email=:User and user_key=:Key and user_state='active' LIMIT 1");

        $sql->bindParam(":User", $data['User']);
        $sql->bindParam(":Key", $data['Key']);
        $sql->execute();

        return $sql;
    }
}
