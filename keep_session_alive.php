<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $_SESSION['last_regeneration'] = time();
}
?>