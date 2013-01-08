
<div>
		Found <?php echo $num_results; ?> Employees.
	</div>

    <table bgcolor="#FBFBFB" width="90%" align="center" border="0" cellpadding="0" cellspacing="0">
        <thead bgcolor="#FFF0BF">
            <?php foreach($fields as $field_name => $field_display): ?>
            <th height="30px">
            	<?php echo $field_display ?>
            	        
            </th>
            <?php endforeach; ?>
           
        </thead>
        <tbody>
            <?php foreach($employees as $employee){ ?>
            <tr style="background: #f1f1f1;">
				<?php foreach($fields as $field_name => $field_display): ?>
                    <td class="td_results" align="center">
                        <?php echo $employee->$field_name; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>



</div> <!--end content div -->
    
</body>

</html>