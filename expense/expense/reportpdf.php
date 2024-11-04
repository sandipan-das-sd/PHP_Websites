<?php
require('vendor1/autoload.php');
$con=mysqli_connect('localhost','root','','tridev');//database
$res=mysqli_query($con,"select * from expense");//table

if(mysqli_num_rows($res)>0){
	$htmlhead.='<style>.head{
		 align-item:centre;
		 color:blue; 
		 background-color:lightblue;}</style><table class="head"><tr><td>--------------------------------------------</td><td><b>:This is Your Expenses Report:</b></td><td> --------------------------------------------</tr></table>';

	$html='<style>.table{background-color:#CBC8B9;}</style><table class="table">';	
	$html.='<tr><td>ID</td><td></td><td>Category</td><td>Item</td><td>Price</td><td>Details</td><td>Date</td></tr>';
		while($row=mysqli_fetch_assoc($res)){
			$html.='<tr><td>'.$row['id'].'</td><td> </td><td>'.$row['category_id'].'</td>
			<td>'.$row['item'].'</td>
			<td>'.$row['price'].'</td>
			<td>'.$row['details'].'</td>
			<td>'.$row['expense_date'].'</td></tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found.";
}
$bg='<style> *{ background-color:red;} </style>';
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($bg);
$mpdf->WriteHTML($htmlhead);
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->Output($file,'I');
//I-jokhon tipbe pdf download hobe
//D- dile direct download hbe
?>
