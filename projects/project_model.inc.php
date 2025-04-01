<?php 

declare(strict_types = 1);

function set_project(object $pdo, string $title, string $description, string $imagePath) {

    $query = "INSERT INTO projects (title, description, image_path) VALUES (:title, :description, :image_path);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":image_path", $imagePath);

    $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetFolder = '../uploads/';

    $uploadFile = $_FILES['image']['tmp_name'];

    $targetFile = $targetFolder . basename($_FILES['image']['name']);

    if (move_uploaded_file($uploadFile, $targetFile)) {
        echo 'Uploaded';
    } else {
        echo "Error";
    }
}

