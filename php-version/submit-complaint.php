<?php
// PHP Version: Endpoint to record a new complaint ticket in DB
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitize entries
    $title = isset($_POST['title']) ? sanitizeInput($_POST['title']) : '';
    $category = isset($_POST['category']) ? sanitizeInput($_POST['category']) : 'lainnya';
    $location = isset($_POST['location']) ? sanitizeInput($_POST['location']) : '';
    $description = isset($_POST['description']) ? sanitizeInput($_POST['description']) : '';
    $is_anonymous = isset($_POST['is_anonymous']) ? intval($_POST['is_anonymous']) : 0;
    
    $author = 'Warga Desa';
    if ($is_anonymous === 1) {
        $author = 'Warga Anonim';
    } else if (isset($_POST['author']) && !empty(trim($_POST['author']))) {
        $author = sanitizeInput($_POST['author']);
    }

    // 2. Assign dates and random tracking codes
    $tracking_id = generateTrackingID('SAMBAT');
    $status = 'Diterima';
    $date_submitted = date('d ') . getIndonesianMonth((int)date('m')) . date(' Y');
    $id = 'c-' . uniqid();
    $response_msg = 'Laporan Anda telah berhasil kami terima di sistem E-Sambat WebDesa. Tim Satuan Tugas Desa akan melakukan verifikasi lapangan segera.';

    // 3. Handle physical file directories and uploads safely
    $uploaded_file_name = null;
    if (isset($_FILES['complaint_image']) && $_FILES['complaint_image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_extension = pathinfo($_FILES['complaint_image']['name'], PATHINFO_EXTENSION);
        $safe_name = 'sambat_' . time() . '_' . rand(100, 999) . '.' . $file_extension;
        if (move_uploaded_file($_FILES['complaint_image']['tmp_name'], $upload_dir . $safe_name)) {
            $uploaded_file_name = $safe_name;
        }
    }

    // 4. Fire DB Query if system is database connected, otherwise simulate session mock
    $success = true;
    if (isset($pdo)) {
        try {
            $sql = "INSERT INTO complaints (id, title, category, description, status, date_submitted, author, tracking_id, location, response_message) 
                    VALUES (:id, :title, :category, :description, :status, :date_submitted, :author, :tracking_id, :location, :response_message)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'id' => $id,
                'title' => $title,
                'category' => $category,
                'description' => $description,
                'status' => $status,
                'date_submitted' => $date_submitted,
                'author' => $author,
                'tracking_id' => $tracking_id,
                'location' => $location,
                'response_message' => $response_msg
            ]);
        } catch (\PDOException $e) {
            $success = false;
            $error_message = $e->getMessage();
        }
    } else {
        // Fallback: If DB is not connected yet, we store is in a PHP list/session simulating persistence
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['complaints'])) {
            $_SESSION['complaints'] = [];
        }
        $_SESSION['complaints'][] = [
            'id' => $id,
            'title' => $title,
            'category' => $category,
            'description' => $description,
            'status' => $status,
            'date_submitted' => $date_submitted,
            'author' => $author,
            'tracking_id' => $tracking_id,
            'location' => $location,
            'response_message' => $response_msg
        ];
    }

    if ($success) {
        // Redirect back with successful response parameters
        header("Location: index.php?page=profile&sambat_status=success&code=" . $tracking_id);
        exit();
    } else {
        header("Location: index.php?page=profile&sambat_status=failed&err=" . urlencode($error_message));
        exit();
    }
}

/**
 * Locale mapper for Indonesian Month strings
 */
function getIndonesianMonth($num) {
    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    return isset($months[$num]) ? $months[$num] : 'Juni';
}
?>
