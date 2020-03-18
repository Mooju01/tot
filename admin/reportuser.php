<?php
	require_once __DIR__ . '/vendor/autoload.php';
	include('../connect.php');
	if (!$mysqli) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM login";
	$result = mysqli_query($mysqli, $sql);
	$content = "";
	if (mysqli_num_rows($result) > 0) {
		$i = 1;
		while($row = mysqli_fetch_assoc($result)) {
			$tablebody .= '<tr style="border:1px solid #000;">
				<td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$i.'</td>
				<td style="border-right:1px solid #000;padding:3px;">'.$row['username'].'</td>
				<td style="border-right:1px solid #000;padding:3px;">'.$row['name'].'</td>
				<td style="border-right:1px solid #000;padding:3px;">'.$row['user_status'].'</td>
			</tr>';
			$i++;
		}
	}
	
mysqli_close($mysqli);
	
$mpdf = new mPDF();

$tableh = '
<style>
	body{
		font-family: "Garuda"; 
	}
</style>

<h2 style="text-align:center">สมาชิกผู้ใช้งาน</h2>

<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ลำดับ</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">username</td>
        <td  width="15%" style="border-right:1px solid #000;padding:4px;text-align:center;">&nbsp; ชื่อ-สกุล </td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">สถานะ</td>
    </tr>

</thead>
	<tbody>';
	
$tableend = "</tbody>
</table>";

$mpdf->WriteHTML($tableh);

$mpdf->WriteHTML($tablebody);

$mpdf->WriteHTML($tableend);

$mpdf->Output();

//https://monkeywebstudio.com/%E0%B8%AA%E0%B8%A3%E0%B9%89%E0%B8%B2%E0%B8%87%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C-pdf-%E0%B8%94%E0%B9%89%E0%B8%A7%E0%B8%A2-mpdf/
?>