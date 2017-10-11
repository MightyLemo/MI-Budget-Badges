
<?php 
	

if (!isset($_SESSION["showBudgetBadges"])) {
	$_SESSION["showBudgetBadges"] = '';
}
	
?>
<!-- Budget Badges -->
<div id="MI_budgetLinks" class="<?php echo $_SESSION["showBudgetBadges"]; ?>">  
	<div id="MI_links">
		<a id="MI_budgetLink" href="<?php echo $budgetLink; ?>" target="_blank" class="MI_button" title="Budget &amp; Salary/Compensation Transparency Reporting"></a> 
		
		<a id="MI_budgetLink2" href="<?php echo $dataLink; ?>" target="_blank" class="MI_button" title="Budget &amp; Salary/Compensation Transparency Reporting"></a>  
	</div>
	
	<a id="MI_bbCloser"></a>
</div>

<script type="text/javascript">
	
jQuery('document').ready(function ($) {
	
	$('#MI_bbCloser').click(function() {
		$('#MI_links').slideToggle(function () {
			$('#MI_budgetLinks').toggleClass('minimized');
		});
		
		$.post('<?php echo $sessionToggleURL; ?>', {"showBudgetBadges": 'toggle'});
	});

});

</script>
<!-- END Budget Badges -->

