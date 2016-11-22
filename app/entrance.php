<?php

    //Core files
    require_once 'core/controller.php';
    require_once 'core/model.php';
    require_once 'core/view.php';
    require_once 'core/route.php';

    //Side files
    require_once 'core/database.php';
    require_once 'core/sessions.php';

    //Configs
    require_once 'config/database.php';
    require_once 'config/paths.php';

    $app = new Route();