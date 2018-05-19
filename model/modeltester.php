<?php
include_once "../cfg.php";
include_once "DAO.php";
include_once "User_model.php";

$modeltester = new User_model();

?>

<pre>
<?php print_r($modeltester->countUser('josef','josefbaldo9')) ?>
</pre>