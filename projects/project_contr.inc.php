<?php 

declare(strict_types= 1);

function is_tilte_empty(string $title) {
    if (empty($title)){
        return true;
    } else {
        return false;
    }
}

function create_project(object $pdo, string $title, string $descrioption, string $imagePath){
    set_project($pdo, $title, $descrioption, $imagePath);
}