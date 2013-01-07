
<h2>Move Employee Department</h2>
	

	<div id="emp_search" align="center">
		<form action='<?= base_url()."index.php/hr/move_employee"?>' method="post">
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
				<td align="right" colspan="2"><span id="search_failed" style="color: RED;"></span></td>
			</tr>
		</table>
	</div>
<SCRIPT type="text/javascript">
		function search(){
			var search = <?= $search ?>;
			//alert(login);
			
			if (search != 1)
			{
				document.getElementById('search_failed').innerHTML = "Search Failed. Employee Number Incorrect.";			
			} //END IF
			
			
		} //END SEARCH
		
		search();
		
	</SCRIPT>


</body>

</html>