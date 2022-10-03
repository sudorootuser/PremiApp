<?php
class modelView
{

    /**-------------- Model gets views -------------*/

    protected static function get_model_view($view)
    {
        $whiteList = [
            "home", "company", "client-list", "client-new", "client-search", "bclient-update", "user-list", "user-new", "user-search", "user-update"
        ];

        // It is validated that it is in the array
        if (in_array($view, $whiteList)) {
            if (is_file("./view/content/" . $view . "-view.php")) {
                $content = "./view/content/" . $view . "-view.php";
            } else {
                $content = "404";
            }
        } elseif ($view == "login" || $view == "index") {
            $content = "login";
        } else {
            $content = "404";
        }

        return $content;
    }
}
