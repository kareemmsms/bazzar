<?php
require_once '../config/db.php';       // الاتصال بقاعدة البيانات
require_once '../model/User.php';     // استدعاء كلاس اليوزر

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'] ?? null;
    $newPassword = $_POST['new_password'] ?? null;

    if ($userId && $newPassword) {
        $db = new Database();
        $conn = $db->getConnection();  // ✅ استخدم اسم الدالة الصحيح

        $user = new User($conn);       // ✅ كلاس User بياخد PDO
        $success = $user->updatePassword($userId, $newPassword);

        if ($success) {
            echo "Password updated successfully.";
        } else {
            echo "Failed to update password.";
        }
    } else {
        echo "Missing user ID or new password.";
    }
}
?>
