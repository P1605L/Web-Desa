<?php
// PHP Version: Endpoint to record a new document application in DB
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitize entries
    $service_id = isset($_POST['service_id']) ? sanitizeInput($_POST['service_id']) : '';
    $service_name = isset($_POST['service_name']) ? sanitizeInput($_POST['service_name']) : '';
    $tracking_id = isset($_POST['tracking_id']) ? sanitizeInput($_POST['tracking_id']) : '';
    $nik = isset($_POST['nik']) ? sanitizeInput($_POST['nik']) : '';
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $address = isset($_POST['address']) ? sanitizeInput($_POST['address']) : '';

    if (empty($tracking_id)) {
        $tracking_id = generateTrackingID('SERVICES');
    }

    $id = 'sub-' . uniqid();
    $status = 'Diajukan';
    $date_submitted = date('d ') . getIndonesianMonth((int)date('m')) . date(' Y');
    $notes = 'Berkas Anda sedang dalam proses verifikasi awal administrasi.';

    // 2. Handle files uploads (multiple document uploads)
    $uploaded_files = [];
    if (isset($_FILES['document_files']) && !empty($_FILES['document_files']['name'][0])) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        foreach ($_FILES['document_files']['name'] as $key => $name_file) {
            if ($_FILES['document_files']['error'][$key] == UPLOAD_ERR_OK) {
                $file_extension = pathinfo($name_file, PATHINFO_EXTENSION);
                $safe_name = 'doc_' . time() . '_' . rand(100, 999) . '_' . $key . '.' . $file_extension;
                
                if (move_uploaded_file($_FILES['document_files']['tmp_name'][$key], $upload_dir . $safe_name)) {
                    $uploaded_files[] = $name_file; // Keep original name for display, or safe_name
                }
            }
        }
    }
    
    // JSON encode list of uploaded files
    $files_json = json_encode($uploaded_files);

    // 3. Insert into database
    $success = true;
    if (isset($pdo)) {
        try {
            $sql = "INSERT INTO submissions (id, service_id, service_name, nik, name, phone, email, date_submitted, status, tracking_id, files, notes) 
                    VALUES (:id, :service_id, :service_name, :nik, :name, :phone, :email, :date_submitted, :status, :tracking_id, :files, :notes)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'id' => $id,
                'service_id' => $service_id,
                'service_name' => $service_name,
                'nik' => $nik,
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'date_submitted' => $date_submitted,
                'status' => $status,
                'tracking_id' => $tracking_id,
                'files' => $files_json,
                'notes' => $notes
            ]);
        } catch (\PDOException $e) {
            $success = false;
            $error_message = $e->getMessage();
        }
    } else {
        // Fallback: Store in PHP session list
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['submissions'])) {
            $_SESSION['submissions'] = [];
        }
        $_SESSION['submissions'][] = [
            'id' => $id,
            'service_id' => $service_id,
            'service_name' => $service_name,
            'nik' => $nik,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'date_submitted' => $date_submitted,
            'status' => $status,
            'tracking_id' => $tracking_id,
            'files' => $uploaded_files,
            'notes' => $notes
        ];
    }

    if ($success) {
        header("Location: index.php?page=services&submission_status=success&code=" . $tracking_id);
        exit();
    } else {
        header("Location: index.php?page=services&submission_status=failed&err=" . urlencode($error_message));
        exit();
    }
}

function getIndonesianMonth($num) {
    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    return isset($months[$num]) ? $months[$num] : 'Juni';
}
?>
