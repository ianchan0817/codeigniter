<?php echo form_open("member/login", array('class' => '', 'id' => 'member_login'));?>
<table>
	<tr>
    	<td>Email</td>
        <td><input type="email" name="identity" value="" autocomplete="off" id="identity" class="required"/></td>
    </tr>
    <tr>
    	<td>Password</td>
        <td><input type="password" name="password" value="" autocomplete="off" id="password" class="required"/></td>
    </tr>

    <tr>
    	<td colspan="2">
       	Remember me <input type="checkbox" name="remember" id="remember" />
        </td>
    </tr>
	<tr>
    	<td colspan="2">
        <input type="submit" value="Login" id="submit" />
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        <a href="forgot_password">Forgot your password?</a>
        <a href="register">Regiser</a>
        </td>
    </tr>
</table>
<?php echo form_close();?>