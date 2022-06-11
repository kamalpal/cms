<?php

require './config/config.php';
require './config/connection.php';
require './functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate
    if (!isset($_POST['name']) || empty($_POST['name'])) {
        setMsg('Name is required.', 'warning');
        redirect('./registration.php');

    }

    if (!isset($_POST['email']) || empty($_POST['email'])) {
        setMsg('Email is required.', 'warning');
        redirect('./registration.php');

    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        setMsg('Enter a valid Eamil address.', 'warning');
        redirect('./registration.php');

    }

    if (strlen($_POST['password']) < 8) {
        setMsg('Password should be atleast 8 chars long.', 'warning');
        redirect('./registration.php');

    }
    if ($_POST['password'] !== $_POST['confirm-password']) {
        setMsg('Both password should match.', 'warning');
        redirect('./registration.php');

    }

    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute([
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => md5($_POST['password']),
    ]);

    setMsg('Registered successfully', 'success');
    redirect('./index.php');
}

redirect('./registration.php');