<?php
session_start();
require_once '../config/db_connect.php';
require_once '../admin_check.php';
checkAdmin();

if (!isset($_GET['id'])) {
    $_SESSION['error_message'] = "No user selected for editing.";
    header("Location: manage_users.php");
    exit();
}

$user_id = $_GET['id'];

// Prevent admin from editing themselves
if ($user_id == $_SESSION['user_id']) {
    $_SESSION['error_message'] = "You cannot edit your own account!";
    header("Location: manage_users.php");
    exit();
}

// Fetch user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    $_SESSION['error_message'] = "User not found.";
    header("Location: manage_users.php");
    exit();
}

if (isset($_POST['update_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $is_admin = $_POST['is_admin'];

    try {
        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, is_admin = ? WHERE id = ?");
        if ($stmt->execute([$name, $email, $is_admin, $user_id])) {
            $_SESSION['success_message'] = "User details updated successfully!";
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Error updating user details: " . $e->getMessage();
    }
    header("Location: manage_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="../includes/ad_images/logo.ico" type="image/x-icon">
    <title>Edit User - Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit User Details</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="is_admin" class="form-control">
                    <option value="1" <?php echo $user['is_admin'] ? 'selected' : ''; ?>>Admin</option>
                    <option value="0" <?php echo !$user['is_admin'] ? 'selected' : ''; ?>>User</option>
                </select>
            </div>
            <button type="submit" name="update_user" class="btn btn-primary">Update Details</button>
            <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
