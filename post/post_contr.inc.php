<?php 

declare(strict_types= 1);

function is_headline_empty(string $headline) {
    if (empty($headline)) {
        return true;
    } else {
        return false;
    }
}

function is_subtitle_empty(string $subtitle) {
    if (empty($subtitle)){
        return true;
    } else {
        return false;
    }
}

function is_content_empty(string $content) {
    if (empty($content)) {
        return true;
    } else {
        return false;
    }
}

function create_post(object $pdo, string $headline, string $subtitle, string $content, string $category, string $author) {
    set_post($pdo, $headline, $subtitle, $content, $category, $author);
}
function save_draft(object $pdo, string $headline, string $subtitle, string $content, string $category, string $author) {
    set_draft($pdo, $headline, $subtitle, $content, $category, $author);
}

function update_posts(object $pdo, int $id, string $headline, string $subtitle, string $content) {
    update_post($pdo, $id, $headline, $subtitle, $content);
}

function update_article_visit_count(object $pdo, int $id){
    update_article_visit_count($pdo, $id);
}