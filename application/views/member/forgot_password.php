<div id="infoMessage"><?php echo $message;?></div>

<?=form_open("member/forgot_password", array('class' => '', 'id' => 'member_forget_password'))?>
<table>
<tr>
	<td>Email:</td>
    <td><input type="email" name="email"  value="" autocomplete="off" id="email" class="required"/></td>
</tr>
<tr>
	<td colspan="2">
	<input type="submit" value="Submit" />
    </td>
</tr>
</table>
<?=form_close()?>