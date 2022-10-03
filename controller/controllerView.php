<?php
require_once './model/modelView.php';

class  controllerView extends modelView
{

    /**-----------------------------------------
     *         Controler get template
     **---------------------------------------**/
    public function get_controller_template()
    {
        return require_once "./view/template.php";
    }

    /**-----------------------------------------
     *         Controler get view
     **---------------------------------------**/
    public static function get_controller_view()
    {
        // The URL is obtained by the get method and the iunformation is extracted fom th .htaccess
        if (isset($_GET['views'])) {
            $route = explode("/", $_GET['views']);
            $answer = modelView::get_model_view($route[0]);
        } else {
            $answer = "login";
        }
        return $answer;
    }
}
