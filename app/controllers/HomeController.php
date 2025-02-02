<?php

class HomeController
{
    public static function index() {
        $eventObj = new Event();
        $events = $eventObj->getUpcomingThreeEvents();
        require BASE_PATH . "/app/views/index.php";
    }
}
