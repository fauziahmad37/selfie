<html>
<head>
	<title>Data Setoran</title>
</head>
<body>

	<form>
		<input type="text" name='poolfullname'>
	</form>
	<table border='1'>
		<tr>
			<td>Nama Pool</td>
		</tr>
		<?php for($data_setoran as $data) {
		?>
		<tr>
			<td><?php echo $data['poolfullname'];?></td>
		</tr>
		<?php }?>
	</table>
</body>
</html>