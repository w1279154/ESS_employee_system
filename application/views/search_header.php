<style>
#search_table
{
border-style:solid;
border-width:1px;
}

#search_table tr
{
text-align: right;
}

.ui-button_search{
    background:none;
    background-color:#0073EA;
    border-style:solid;
    border-width:1px;
    border-color:#000;
    color: #FFF;
    width: 100px;
    
}

.ui-button_search:hover{
    background-color:#FF0084;
    border-style:solid;
    border-width:1px;
    border-color:#000;
    color: #FFF;
    width: 100px;
}

.ui-button{
    font-size:14px;
}



</style>

<div align="center">



<div id="search">
        <br/>
        <br/>
                <form action='<?= base_url()."index.php/find_employee/findemp"?>' method="GET">
        <table bgcolor="#FBFBFB" width="750px" height="150px" id="search_table" >
            <tr>
                <td>
				<?=form_label('Employee Number:', 'emp_no')?>
                <?php $attribute = 'placeholder="Employee Number"'; ?>
                <?=form_input('emp_no',$emp_no,$attribute)?>
                </td>
                <td>
                <?=form_label('Title:', 'jobtitle')?>
                <?=form_dropdown('jobtitle', $options_title, $jobtitle)?>
                </td>
            </tr>
            <tr>
                <td>
                <?=form_label('First Name:', 'firstname')?>
                <?php $attribute = 'placeholder="First Name" '; ?>
                <?=form_input('firstname', $firstname,$attribute)?>
                </td>
                <td>
                <?=form_label('Department:', 'dept')?>
                <?=form_dropdown('dept', $options_dept, $dept)?>
                </td>
            </tr>
            <tr>
                <td>
                <?=form_label('Last Name:', 'lastname')?>
                <?php $attribute = 'placeholder="Last Name" '; ?>
                <?=form_input('lastname', $lastname,$attribute)?>
                </td>
                <td></td>
            </tr>
        </table>
        <table width="750px" style="border-width:0px; text-align:right">
            <tr>
				<td>
                <button class="ui-button_search" id="search_button" type="submit">Search</button>
                </td>
            </tr>
            <tr>
            	<td>
                <input href="#" type="reset" id="reset" value="Reset Search"/>
                </td>
            </tr>
        </table>
</form>
</div> <!-- end search div -->


    <script>
$(function() {
        $( "button" ).button();
    });
    

</script>
