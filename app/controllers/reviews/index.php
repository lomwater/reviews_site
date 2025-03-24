<?php

use myfrm\Pagination;

$title = 'Reviews';
$db = myfrm\App::get(\myfrm\Db::class);

$page = $_GET['page'] ?? 1;
$per_page = 6;
$total = $db->query("SELECT COUNT(*) FROM reviews")->getColumnCount();
$pagination = new Pagination((int)$page, $per_page, $total);
$start = $pagination->getStart();

$reviews = $db->query("SELECT * FROM reviews ORDER BY id DESC LIMIT $start, $per_page")->findAll();
require VIEWS . '/reviews/index.view.php';