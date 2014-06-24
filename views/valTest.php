

<?php echo form_open();  echo $errors;?>
<?php echo form_error('data[0][plz]'); ?>




<input type="text" name="data[0][name]" value="<?php echo set_value('data[0][name]'); ?>">
<input type="submit" name="submit" value="go">
</form>