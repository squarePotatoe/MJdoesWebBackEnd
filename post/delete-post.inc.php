<?php

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        require_once('C:\xampp8.2\htdocs\new-project\includes\dbh.inc.php');

        $query = "DELETE FROM posts WHERE id = $id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        header("Location: ../../public_html/blog");

        die();
    } catch (PDOException $e) {
        die('Query failed: ' . $e->getMessage());
    }

} else {
    header("Location: ../blog");
}
