<?php

function redirect($path)
{
    header('location: ' . $path);
    exit;
}

function showMsg()
{
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

function setMsg($message, $type = 'info')
{
    $_SESSION['msg'] = '<div class="alert alert-' . $type . '">' . $message . '</div>';
}

function login($email, $password)
{
    global $db;
    $statement = $db->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
    $statement->execute([
        'email' => $email,
        'password' => md5($password),
    ]);

    $_SESSION['_user'] = $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user ? true : false;
}

function isLoggedIn()
{
    return isset($_SESSION['_user']);
}

function logout()
{
    unset($_SESSION['_user']);
}
