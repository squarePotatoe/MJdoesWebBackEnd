<?php 

declare(strict_types= 1);

function set_post(object $pdo, string $headline, string $subtitle, string $content, string $category, string $author) {
    $query = "INSERT INTO posts (header, subtitle, content, category, author) VALUES (:headline, :subtitle, :content, :category, :author);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":headline", $headline);
    $stmt->bindParam(":subtitle", $subtitle);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":category", $category);
    $stmt->bindParam(":author", $author);


    $stmt->execute();
}

function get_posts(object $pdo) {
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $resultsPerPage = 3;
    $startFrom = ($page -1) * $resultsPerPage;

    $query = "SELECT * FROM posts ORDER BY id DESC LIMIT $startFrom, $resultsPerPage";
    $stmt = $pdo->prepare($query);

    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $totalRows = $stmt->rowCount();
    $totalPages = ceil($totalRows / $resultsPerPage);

    $results = [
        'result' => $rows,
        'totalPages' => $totalPages,
        'currentPage' => $page
    ];
    return $results;
}


function set_draft(object $pdo, string $headline, string $subtitle, string $content, string $category, string $author) {
    $query = "INSERT INTO drafts (header, subtitle, content, category, author) VALUES (:headline, :subtitle, :content, :category, :author);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":headline", $headline);
    $stmt->bindParam(":subtitle", $subtitle);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":category", $category);
    $stmt->bindParam(":author", $author);


    $stmt->execute();
}

function get_drafts(object $pdo) {
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $resultsPerPage = 3;
    $startFrom = ($page -1) * $resultsPerPage;

    $query = "SELECT * FROM drafts ORDER BY id DESC LIMIT $startFrom, $resultsPerPage";
    $stmt = $pdo->prepare($query);

    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $totalRows = $stmt->rowCount();
    $totalPages = ceil($totalRows / $resultsPerPage);

    $results = [
        'result' => $rows,
        'totalPages' => $totalPages,
        'currentPage' => $page
    ];
    return $results;
}

function update_post(object $pdo, int $id, string $headline, string $subtitle, string $content) {
    $query = "UPDATE posts SET header = :header, subtitle = :subtitle, content = :content WHERE id = :id";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":headline", $headline);
    $stmt->bindParam(":subtitle", $subtitle);
    $stmt->bindParam(":content", $content);

    $stmt->execute();
}

