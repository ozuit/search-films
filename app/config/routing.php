<?php

return array(
    '/' => array(
        '/' => ['HomeController', 'index', 'ajax_home_request', [], 'get|post'],
        '/person/all' => ['HomeController', 'getPerson', 'ajax_get_person', [], 'post'],
    ),
);
