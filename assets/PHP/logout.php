<?php
session_start();
session_unset();
session_destroy();
header("Location: /eproject/vaccination-management/index.php");
exit;
?>
