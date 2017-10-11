<?php
	
session_start();

if (isset($_POST['showBudgetBadges']) && isset($_SESSION["showBudgetBadges"])) {
	
	if ($_SESSION["showBudgetBadges"] == '') {
		$_SESSION["showBudgetBadges"] = 'minimized';
	} else {
		$_SESSION["showBudgetBadges"] = '';
	}
}
	
?>