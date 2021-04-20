<?php
//Hàm kiểm tra lỗi
function pr($arr){
	echo '<pre>';
	print_r($arr);
}
//
function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();//chương trình sẽ dừng ở đây.
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);//nối chuỗi
		return mysqli_real_escape_string($con,$str);//thoát khỏi các ký tự đặt biệt trong câu truy vấn ('$username')
	}
}
?>