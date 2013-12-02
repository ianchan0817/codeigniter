<div id="infoMessage"><?=$message?></div>
<?php echo form_open("member/register", array('class' => '', 'id' => 'member_register'));?>
<table>
	<tr>
    	<td>First Name:</td>
        <td><input type="text" name="first_name" value="" autocomplete="off" id="first_name" class="required"/></td>
    </tr>
    <tr>
    	<td>Last Name:</td>
        <td><input type="text" name="last_name" value="" autocomplete="off" id="last_name" class="required"/></td>
    </tr>
    <tr>
    	<td>Birthday:</td>
        <td>
		<select name="year" ><option></option></select>
        <select name="month" ><option></option></select>
        <select name="day" ><option></option></select>	
        </td>
    </tr>
    <tr>
    	<td>Gender:</td>
        <td>
		<input type="radio" name="gender" checked value="male"/>Male&nbsp;
        <input type="radio" name="gender" value="female"/>Female
        </td>
    </tr>
    <tr>
    	<td>Email:</td>
        <td><input type="email" name="email"  value="" autocomplete="off" id="email" class="required"/></td>
    </tr>
    <tr>
    	<td>Password:</td>
        <td><input type="password" name="password" value="" autocomplete="off" id="password"  class="required"/></td>
    </tr>
    <tr>
    	<td>Confirm Password:</td>
        <td><input type="password" name="password_confirm" value="" autocomplete="off" id="confirm_password" class="required"/></td>
    </tr>
    <tr>
    	<td colspan="2">
       	<input type="submit" value="Create" id="submit" />
        </td>
    </tr>
</table>
<?php echo form_close();?>