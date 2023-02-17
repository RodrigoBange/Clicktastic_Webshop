<?php
// Start the session
session_start();

// Router
require_once(__DIR__ . "/../routers/PatternRouter.php");

$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new PatternRouter();
$router->route($uri);
