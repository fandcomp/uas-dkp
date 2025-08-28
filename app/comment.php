<?php require 'auth.php'; ?>
<?php require '_header.php'; ?>
<h2>Post comments</h2>
<form method="post">
  <input name="author" placeholder="Name...">
  <textarea name="content" placeholder="Comments..."></textarea>
  <button>Post</button>
</form>

<?php
if ($_POST) {
    $stmt = $GLOBALS['PDO']->prepare("INSERT INTO comments(author,content,created_at) VALUES(?,?,datetime('now'))");
    $stmt->execute([$_POST['author'], $_POST['content']]);
}
?>
<h3>Comment lists : </h3>
<?php
foreach ($GLOBALS['PDO']->query("SELECT * FROM comments ORDER BY id DESC") as $row) {
    echo "<p><b>" . htmlspecialchars($row['author']) . "</b>: " . htmlspecialchars($row['content']) . "</p>";
}
?>
<?php require '_footer.php'; ?>
