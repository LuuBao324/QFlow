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

function userRole($pdo){
    $parameters = [':id' => $_SESSION['user_id']];
    return query($pdo, 'SELECT role FROM users WHERE id = :id', $parameters) ->fetchColumn();
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
    $sql = "SELECT questions.*, users.username FROM questions 
            INNER JOIN users ON questions.user_id = users.id
            WHERE questions.module_id IN ($placeholderString) 
            ORDER BY questions.created_at DESC";
    
    $stmt = query($pdo, $sql, $parameters);
    return $stmt->fetchAll();
}

function usernameExists($pdo, $username) {
    $query = 'SELECT COUNT(*) FROM users WHERE username = :username';
    $parameters = [':username' => $username];
    return query($pdo, $query, $parameters)->fetchColumn() > 0;
}

function emailExists($pdo, $email) {
    $query = 'SELECT COUNT(*) FROM users WHERE email = :email';
    $parameters = [':email' => $email];
    return query($pdo, $query, $parameters)->fetchColumn() > 0;
}

function insertUser($pdo, $username, $hashedPassword, $email, $role, $status) {
    $query = 'INSERT INTO users (username, email, password, role, status) VALUES (:username, :email, :password, :role, :status)';
    $parameters = [
        ':username' => $username,
        ':email' => $email,
        ':password' => $hashedPassword,
        ':role' => $role,
        ':status' => $status
    ];
    return query($pdo, $query, $parameters);
}

function getAllUsers($pdo) {
    $query = 'SELECT * FROM users ORDER BY role DESC, id ASC';
    return query($pdo, $query)->fetchAll();
}

// Admin functions
function deleteModule($pdo, $id){
    $parameters = ['id' => $id];
    query($pdo, 'DELETE FROM module WHERE id = :id', $parameters);
}

function insertModule($pdo, $moduleName) {
    $query = 'INSERT INTO module (moduleName) VALUES (:moduleName)';
    $parameters = [':moduleName' => $moduleName];
    return query($pdo, $query, $parameters);
}

function getUserById($pdo, $id) {
    $query = 'SELECT * FROM users WHERE id = :id';
    $parameters = [':id' => $id];
    return query($pdo, $query, $parameters)->fetch();
}

function disableUserAccount($pdo, $id) {
    $query = 'UPDATE users SET status = "disabled" WHERE id = :id';
    $parameters = [':id' => $id];
    query($pdo, $query, $parameters);
}

function enableUserAccount($pdo, $id) {
    $query = 'UPDATE users SET status = "active" WHERE id = :id';
    $parameters = [':id' => $id];
    query($pdo, $query, $parameters);
}

function getAdminByUsername($pdo, $username) {
    $query = 'SELECT * FROM users WHERE username = :username AND role = "admin"';
    $parameters = [':username' => $username];
    return query($pdo, $query, $parameters)->fetch();
}

function updateUser($pdo, $id, $username, $email, $role) {
    $query = 'UPDATE users SET username = :username, email = :email, role = :role WHERE id = :id';
    $parameters = [
        ':username' => $username,
        ':email' => $email,
        ':role' => $role,
        ':id' => $id
    ];
    return query($pdo, $query, $parameters);
}

?>