
<h2>Change Employee Title</h2>
	

	<div id="emp_search" align="center">
		<form action='<?= base_url()."index.php/hr/change_title"?>' method="post">
		<table>
			<tr align="right">
				<td>
					Employee Number:
				</td>
				<td>
					<input type="text" name="emp_no" placeholder="Enter Here" required></input>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<input type="submit" value="Find Employee"></input>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2"><span id="search_failed" style="color: RED;"></span></td>
			</tr>
		</table>
	</div>
<SCRIPT type="text/javascript">
		function search(){
			var search = <?= $search ?>;
			//alert(login);
			if (search == 2)
			{
				var demote= "<a href='<?= base_url().'index.php/hr/demote_employee_search'?>'>Demote Employee</a>";
				document.getElementById('search_failed').innerHTML = "<p>This employee is a Manager. <br/>Please use the "+demote+".</p>";	
			} //END IF
			else if (search != 1)
			{
				document.getElementById('search_failed').innerHTML = "Search Failed. Employee Number Incorrect.";			
			} //END IF
			
		} //END SEARCH
		
		search();
		
	</SCRIPT>


</body>

</html>