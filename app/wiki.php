<?php require 'auth.php'; ?>
<?php require '_header.php'; ?>
<h2>Wiki Search</h2>
<form><input name="q"><button>Search</button></form>
<?php
if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $stmt = $GLOBALS['PDO']->prepare("SELECT * FROM articles WHERE title LIKE ?");
    $search = "%$q%";
    $stmt->execute([$search]);
    echo "<p>Query executed safely.</p>";
    foreach ($stmt as $row) {
        echo "<li>" . htmlspecialchars($row['title']) . ": " . htmlspecialchars($row['body']) . "</li>";
    }
}
?>
<?php require '_footer.php'; ?>
