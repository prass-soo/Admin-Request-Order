<?php
session_name('admin_session');
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../dashboard-admin-cs/login.php");
    exit;
}
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerId = $_POST['id'];
    $customerData = getCustomerById($customerId);

    header('Content-Type: application/json');
    echo json_encode($customerData);
    exit;
}
