<?php
require 'auth.php';

class Profile {
    public $username;
    public $isAdmin = false;

    function __toString() {
        return "User: {$this->username}, Role: " . ($this->isAdmin ? "Admin" : "User");
    }
}


if (!isset($_COOKIE['profile'])) {
  die("Profile cookie tidak ditemukan. Silakan login ulang.");
}
$profile = json_decode($_COOKIE['profile'], true);
if (!is_array($profile) || !isset($profile['username']) || !isset($profile['isAdmin'])) {
  die("Profile cookie tidak valid. Silakan login ulang.");
}

// jika admin, boleh hapus user lain
if ($profile['isAdmin'] && isset($_POST['delete_user'])) {
  $target = $_POST['delete_user'];
  $stmt = $GLOBALS['PDO']->prepare("DELETE FROM users WHERE username = ?");
  $stmt->execute([$target]);
  $msg = "<p style='color:green'>User <b>" . htmlspecialchars($target) . "</b> berhasil dihapus!</p>";
}

include '_header.php';
?>
<h2>Profile Page</h2>
<p><?php echo "User: " . htmlspecialchars($profile['username']) . ", Role: " . ($profile['isAdmin'] ? "Admin" : "User"); ?></p>

<?php if ($profile['isAdmin']): ?>
  <h3>Admin Panel</h3>
  <form method="post">
    <label>Delete user:
      <select name="delete_user">
        <?php
    $users = $GLOBALS['PDO']->query("SELECT username FROM users");
    foreach ($users as $u) {
      if ($u['username'] !== $profile['username']) {
        echo "<option value='" . htmlspecialchars($u['username']) . "'>" . htmlspecialchars($u['username']) . "</option>";
      }
    }
        ?>
      </select>
    </label>
    <button type="submit">Delete</button>
  </form>
  <?php if (!empty($msg)) echo $msg; ?>
<?php else: ?>
  <p style="color:red">You are a regular user. You do not have admin panel access.</p>
<?php endif; ?>

<?php include '_footer.php'; ?>