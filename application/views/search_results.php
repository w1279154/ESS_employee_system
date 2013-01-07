
<div>
		Found <?php 
		if ($num_results == '1000'){echo "> or = ";}
		
		echo $num_results; ?> Employees.
	</div>

    <table bgcolor="#FBFBFB" width="90%" align="center" border="0" cellpadding="0" cellspacing="0">
        <thead bgcolor="#FFF0BF">
            <?php foreach($fields as $field_name => $field_display): ?>
            <th height="30px">
            	<?php echo $field_display ?>
            	
            <!--<?php if($sort_by == $field_name)// echo "class=\"sort_$sort_order\""?>	
            	<?php echo anchor("ess_controller/search/$field_name/" .
				
				(($sort_order == 'asc' && $sort_by == $field_name)? 'desc' : 'asc'),
				$field_display); ?>
 			-->
            </th>
            <?php endforeach; ?>
           
        </thead>
        <tbody>
            <?php foreach($employees as $employee){ ?>
            <tr>
				<?php foreach($fields as $field_name => $field_display): ?>
                    <td class="td_results" align="center">
                        <?php echo $employee->$field_name; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>

<!--
	<?php if (strlen($pagination)){ ?>
    <div>
    	Pages: <?php echo $pagination; ?>
    </div>
    <?php } ?>
-->

</div> <!--end content div -->

</body>

</html>