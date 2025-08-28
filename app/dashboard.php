/**
 * File: dashboard.php
 * Description: User dashboard page.
 */
<?php require 'auth.php'; ?>
<?php require '_header.php'; ?>
<h2>Dashboard</h2>
<p>Welcome <b><?php echo htmlspecialchars($_SESSION['user']); ?></b>!</p>
<p>Use the menu above to access the web page.</p>
<?php require '_footer.php'; ?>
