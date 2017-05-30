<?php
$app->route->add('/admin/ads', 'Admin/Ads');
$app->route->add('/admin/ads/add', 'Admin/Ads@add');
$app->route->add('/admin/ads/submit', 'Admin/Ads@submit', 'POST');
$app->route->add('/admin/ads/edit/:id', 'Admin/Ads@edit');
$app->route->add('/admin/ads/save/:id', 'Admin/Ads@save', 'POST');
$app->route->add('/admin/ads/delete/:id', 'Admin/Ads@delete');