<?php

// Lectura ficheros json
$asoc   = file_get_contents(__DIR__."/data/asoc.json");
$config = file_get_contents(__DIR__."/data/config.json");
$site   = file_get_contents(__DIR__."/data/site.json");
$agenda = file_get_contents(__DIR__."/data/agenda.json");

// Datos disponibles para la aplicacion
$app['asoc'] = json_decode($asoc,true);
$app['site'] = json_decode($site,true);
$app['config'] = json_decode($config,true);
$app['agenda'] = json_decode($agenda,true);


