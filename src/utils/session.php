<?php

// called in router to globally start session only if PHPSESSID cookie exists (will be true at user login thanks to a session_start() in the userConnect function)

if (session_status() === PHP_SESSION_NONE && isset($_COOKIE['PHPSESSID'])) {
    session_start();
}