<?php

use \myfrm\App;
use \myfrm\Router;

$db = App::get(\myfrm\Db::class);

$slug = routeParam('slug');
//$id = (int)$_GET['id'] ?? 0;

$reviews = $db->query("SELECT * FROM `reviews` WHERE slug = ? LIMIT 1", [$slug])->findOrFail();


require VIEWS . '/reviews/snow.view.php';