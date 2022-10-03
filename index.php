<?php
// Global constanst are incluyed
require_once './config/APP.php';

// View controllers incluyed
require_once './controller/controllerView.php';

// A class is instantiated in the template
$template = new controllerView();
$template->get_controller_template();
