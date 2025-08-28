<?php include 'auth.php'; ?>
/**
 * File: ping.php
 * Description: Ping server with input validation and output escaping.
 */
<?php require 'auth.php'; ?>
<?php require '_header.php'; ?>
<form><input name="target"><button>Ping!</button></form>
<?php
if (!isset($_GET['target'])) {
    die("Missing parameter.");
}
    $target = $_GET['target'];
    $target = $_GET['target'];
    if (!filter_var($target, FILTER_VALIDATE_IP) && !preg_match('/^[a-zA-Z0-9.-]+$/', $target)) {
        die("Invalid target");
    }
    echo "<h3>Ping Result for: " . htmlspecialchars($target) . "</h3>";
    $output = shell_exec("ping -c 2 " . escapeshellarg($target));
    echo "<pre>" . htmlspecialchars($output) . "</pre>";

?>
<?php require '_footer.php'; ?>