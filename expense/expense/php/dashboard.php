<?php
include('header.php');
checkUser();
restrictAccess();
include('user_header.php');
?>
   
   
   <script>
(function(w, d) {
    w.CollectId = "64ee08c817960a15b2334ca0";
    var h = d.head || d.getElementsByTagName("head")[0];
    var s = d.createElement("script");
    s.setAttribute("type", "text/javascript");
    s.async = true;
    s.setAttribute("src", "https://collectcdn.com/launcher.js");
    h.appendChild(s);
})(window, document);
</script>


<h2>Dashboard</h2>

<table>
	<tr>
		<td>Today's Expense</td>
		<td>
		<?php echo getDashboardExpense('today')?>
		</td>
	</tr>
	<tr>
		<td>Yesterday's Expense</td>
		<td>
		<?php echo getDashboardExpense('yesterday')?>
		</td>
	</tr>
	<tr>
		<td>This Week Expense</td>
		<td>
		<?php echo getDashboardExpense('week')?>
		</td>
	</tr>
	<tr>
		<td>This Month Expense</td>
		<td>
		<?php echo getDashboardExpense('month')?>
		</td>
	</tr>
	<tr>
		<td>This Year Expense</td>
		<td>
		<?php echo getDashboardExpense('year')?>
		</td>
	</tr>
	<tr>
		<td>Total Expense</td>
		<td>
		<?php echo getDashboardExpense('total')?>
		</td>
	</tr>
</table>
    
<!-- Calculator Widget Copyright CalculatorSoup, LLC at www.calculatorsoup.com. Use is granted only if this statement and all links to www.calculatorsoup.com are maintained. -->
<?php
include('footer.php');
?> 