<?php
function redirect($url) {
    header("Location: $url");
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function query($pdo, $sql, $parameters = []){
    $query = $pdo->prepare($sql);
    $query -> execute($parameters);
    return $query;
}

function getAllQuestion($pdo, $id){
    $parameters = [':id'=> $id];
    $query = query($pdo, 'SELECT * FROM questions WHERE id = :id', $parameters);
    return $query->fetch();
}

function getDetailedQuestion($pdo, $id){
    $parameters = [':id'=> $id];
    $query = 'SELECT questions.*, users.username FROM questions JOIN users ON questions.user_id = users.id WHERE questions.id = :id';
    return query($pdo, $query, $parameters)->fetch();
}

function getImage($pdo, $id){
    $parameters = ['id'=> $id];
    $query = query($pdo, 'SELECT image FROM questions WHERE id = :id ', $parameters);
    return $query->fetch();
}


function updateQuestion($pdo, $questionId, $title, $content, $module_id, $image){
    $query = 'UPDATE questions SET title = :title, content = :content, module_id = :module_id, image = :image WHERE id = :id';
    $parameters = [':title' => $title, ':content' => $content, ':module_id' => $module_id, ':image' => $image, ':id'=> $questionId];
    query($pdo, $query, $parameters);
}

function deleteQuestion($pdo, $id){
    $parameters = ['id'=> $id];
    query($pdo, 'DELETE FROM questions WHERE id = :id', $parameters);
}

function insertQuestion($pdo, $user_id, $module_id, $title, $content, $image){
    $query = 'INSERT INTO questions (user_id, module_id, title, content, image) VALUES (:user_id, :module_id, :title, :content, :image)';
    $parameters = [':user_id' => $user_id, ':module_id' => $module_id, ':title' => $title, ':content' => $content, ':image'=> $image];
    query($pdo, $query, $parameters);
}

function allModules($pdo){
    $modules = query($pdo, 'SELECT * FROM module');
    return $modules->fetchAll();
}

function insertComment($pdo, $question_id, $user_id, $content){
    $query = 'INSERT INTO comments (question_id, user_id, content) VALUES(:question_id, :user_id, :content)';
$parameters = [':question_id'=> $question_id,':user_id'=> $user_id, ':content'=> $content];
query($pdo, $query, $parameters);
}

function fetchComments($pdo, $question_id){
    $query = 'SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.question_id = :question_id';
    $parameters = [':question_id'=> $question_id];
    return query($pdo, $query, $parameters)->fetchAll();
}
?>