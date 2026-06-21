<?php
// PHP Version: Endpoint to record a new potential item inquiry or purchase
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitize entries
    $item_id = isset($_POST['item_id']) ? sanitizeInput($_POST['item_id']) : '';
    $item_title = isset($_POST['item_title']) ? sanitizeInput($_POST['item_title']) : '';
    $price_detail = isset($_POST['price_detail']) ? sanitizeInput($_POST['price_detail']) : '';
    $buyer_name = isset($_POST['buyer_name']) ? sanitizeInput($_POST['buyer_name']) : '';
    $buyer_phone = isset($_POST['buyer_phone']) ? sanitizeInput($_POST['buyer_phone']) : '';

    $date_submitted = date('d-m-Y H:i');

    $success = true;
    if (isset($pdo)) {
        try {
            $sql = "INSERT INTO potential_inquiries (item_id, item_title, price_detail, buyer_name, buyer_phone, date_submitted) 
                    VALUES (:item_id, :item_title, :price_detail, :buyer_name, :buyer_phone, :date_submitted)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'item_id' => $item_id,
                'item_title' => $item_title,
                'price_detail' => $price_detail,
                'buyer_name' => $buyer_name,
                'buyer_phone' => $buyer_phone,
                'date_submitted' => $date_submitted
            ]);
        } catch (\PDOException $e) {
            $success = false;
            $error_message = $e->getMessage();
        }
    } else {
        // Session fallback
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['inquiries'])) {
            $_SESSION['inquiries'] = [];
        }
        $_SESSION['inquiries'][] = [
            'item_id' => $item_id,
            'item_title' => $item_title,
            'buyer_name' => $buyer_name,
            'buyer_phone' => $buyer_phone,
            'date_submitted' => $date_submitted
        ];
    }

    if ($success) {
        header("Location: index.php?page=potential&inquire_status=success&item=" . urlencode($item_title));
        exit();
    } else {
        header("Location: index.php?page=potential&inquire_status=failed&err=" . urlencode($error_message));
        exit();
    }
}
?>
