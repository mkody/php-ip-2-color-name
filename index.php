<?php
if(empty($_POST['ip'])){
	$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
}
if(empty($_POST['method'])){
	$_POST['method'] = 1;
}else{
	$_POST['method'] = intval($_POST['method']);
}

?>
<form action="" method="POST">
<input type="text" name="ip" value="<?=$_POST['ip']?>" /><br>
<select name="method">
	<option value="1" <? if($_POST['method']==1) echo 'selected="selected"'; ?> >IP->RGB->HTML Color Names
	<option value="2" <? if($_POST['method']==2) echo 'selected="selected"'; ?> >IP->CMYK->RGB->HTML Color Names (simple CMYK2RGB conversion method)
	<option value="3" <? if($_POST['method']==3) echo 'selected="selected"'; ?> >IP->CMYK->RGB->HTML Color Names (Voisen.org CMYK2RGB conversion method)
	<option value="4" <? if($_POST['method']==4) echo 'selected="selected"'; ?> >IP->CMYK->RGB->HTML Color Names (WIKIPEDIA CMYK2RGB conversion method)
</select><br>
<input type="submit" name="submit" value="Check color">
</form>
<?php
if(!empty($_POST['ip'])){
	require('./phpip2colorname.class.php');
	$phpIp2ColorName = new phpIp2ColorName($_POST['ip'],$_POST['method']);
	echo 'IP: ' . $phpIp2ColorName->ip;
	echo '<br>';
	echo 'method: ' . $phpIp2ColorName->method;
	echo '<br>';
	echo 'Accuracy: ' . $phpIp2ColorName->accuracy . '%';
	echo '<br>';
	echo 'HTML color name: ' . $phpIp2ColorName->getColorRealName();
	echo '<br>';
	echo 'Human readable color name: ' . $phpIp2ColorName->getColorReadableName();
	echo '<br>';
	echo 'HTML color code: ' . $phpIp2ColorName->getColorHexValue();
	echo '<br>';
	echo 'inverted HTML color code: ' . $phpIp2ColorName->getInvertedColorHexValue();
	echo '<br>';
	echo '<div style="width:300px;height:300px;background-color:'.$phpIp2ColorName->getColorHexValue().';color:'.$phpIp2ColorName->getInvertedColorHexValue().'">'.$phpIp2ColorName->getColorReadableName().'</div>';
}
?>
