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
    $modules = query($pdo, 'SELECT * FROM module ORDER BY moduleName');
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

function getUser($pdo, $username){
    $query = 'SELECT * FROM users WHERE username = :username';
    $parameters = [':username'=> $username];
    return query($pdo, $query, $parameters) ->fetch();
}

function getAllQuestions($pdo) {
        $stmt = query($pdo, "SELECT questions.*, users.username 
                         FROM questions 
                         INNER JOIN users ON questions.user_id = users.id
                         ORDER BY questions.created_at DESC");
        return $stmt->fetchAll();
}

function getFilteredQuestions($pdo, $moduleIds) {
    // Create placeholders for the IN clause using named parameters
    $placeholders = [];
    $parameters = [];
    
    foreach ($moduleIds as $index => $moduleId) {
        $paramName = ":module$index";
        $placeholders[] = $paramName;
        $parameters[$paramName] = $moduleId;
    }
    
    $placeholderString = implode(',', $placeholders);
    
    // Fetch questions based on selected modules
    $sql = "SELECT questions.*, users.username 
            FROM questions 
            INNER JOIN users ON questions.user_id = users.id
            WHERE questions.module_id IN ($placeholderString) 
            ORDER BY questions.created_at DESC";
    
    $stmt = query($pdo, $sql, $parameters);
    return $stmt->fetchAll();
}

// Admin functions

?>