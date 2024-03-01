<?php

function retrieve_posts(PDO $pdo) {
  $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
  $resultsPerPage = 3;
  $startFrom = ($page -1) * $resultsPerPage;

  $query = "SELECT COUNT(*) AS total FROM posts";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $totalPages = ceil($row["total"] / $resultsPerPage);

  $query = "SELECT id, header, subtitle, content, category, author, DATE_FORMAT(date, '%M %d %Y %h:%i %p')
   AS date FROM posts ORDER BY id DESC LIMIT $startFrom, $resultsPerPage" ;
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return array (
      'result' => $rows,
      'totalPages'=> $totalPages,
      'currentPage'=> $page
  );
}

function retrieve_posts_by_category(PDO $pdo, $category) {
  $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
  $resultsPerPage = 3;
  $startFrom = ($page -1) * $resultsPerPage;

  $query = "SELECT COUNT(*) AS total FROM posts";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $totalPages = ceil($row["total"] / $resultsPerPage);

  $query = "SELECT id, header, subtitle, content, category, author, DATE_FORMAT(date, '%M %d %Y %h:%i %p')
   AS date FROM posts WHERE category = '$category' ORDER BY id DESC LIMIT $startFrom, $resultsPerPage" ;
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return array (
      'result' => $rows,
      'totalPages'=> $totalPages,
      'currentPage'=> $page
  );
}

function retrieve_latest_post_by_category($pdo, $category) {
  $query = ("SELECT * FROM posts WHERE category = :category ORDER BY id DESC");
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(":category", $category);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function retrieve_posts_by_author(PDO $pdo, $author) {

  $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
  $resultsPerPage = 5;
  $startFrom = ($page -1) * $resultsPerPage;

  $query = "SELECT COUNT(*) AS total FROM posts WHERE author = '$author'";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $totalPages = ceil($row["total"] / $resultsPerPage);

  $query = "SELECT * FROM posts WHERE author = '$author' ORDER BY id DESC LIMIT $startFrom, $resultsPerPage" ;
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return array (
      'result' => $rows,
      'totalPages'=> $totalPages,
      'currentPage'=> $page
  );
}

function retrieve_post_by_id($pdo, $id) {
  $query = "SELECT * FROM posts WHERE id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(":id", $id);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function retrieve_post_by_featured($pdo) {
  $query = ("SELECT * FROM posts WHERE is_featured = 1");
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function retrieve_recent_posts(PDO $pdo) {
  $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 3" ;
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function retrieve_drafts_by_author(PDO $pdo, $author) {

  $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
  $resultsPerPage = 5;
  $startFrom = ($page -1) * $resultsPerPage;

  $query = "SELECT COUNT(*) AS total FROM drafts WHERE author = '$author'";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $totalPages = ceil($row["total"] / $resultsPerPage);

  $query = "SELECT id, header, subtitle, content, category, author, DATE_FORMAT(date, '%M %d %Y %h:%i %p')
   AS date FROM drafts WHERE author = '$author' ORDER BY id DESC LIMIT $startFrom, $resultsPerPage" ;
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return array (
      'result' => $rows,
      'totalPages'=> $totalPages,
      'currentPage'=> $page
  );
}

function update_article_visit_count(object $pdo, int $id){
  $query = "UPDATE posts SET view_count = view_count + 1 WHERE id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(":id", $id);
  $stmt->execute();
}

function get_project_by_id($pdo, $id){
  $query = "SELECT * FROM projects WHERE id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(":id", $id);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function get_posts_json(object $pdo) {

  $query = "SELECT * FROM posts";
  $stmt = $pdo->prepare($query);

  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return json_encode($result, JSON_PRETTY_PRINT);
}


