<?php require 'auth.php'; ?>
<?php require '_header.php'; ?>
<h2>Crash Test</h2>
<?php
$factor = $_GET['factor'] ?? 1;
if (!is_numeric($factor) || $factor == 0) {
    die("Invalid factor. Must be a non-zero number.");
}
$result = 100 / $factor;
echo "100 / " . htmlspecialchars($factor) . " = " . htmlspecialchars($result);
?>
<?php require '_footer.php'; ?>
