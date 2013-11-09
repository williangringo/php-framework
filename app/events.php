<?php

$events = container()->get('events');
/* @var $events Symfony\Component\EventDispatcher\EventDispatcher */

include __DIR__ . '/events_core.php';
include __DIR__ . '/events_custom.php';
