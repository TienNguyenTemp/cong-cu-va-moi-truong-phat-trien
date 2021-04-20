<?php
require('top.inc.php');
$categories='';//warrning
$msg='';
//load data lên form theo id khi nhấn edit
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);//kết nối và nhận data từ form
	$res=mysqli_query($con,"select * from categories where id='$id'");//câu truy vấn load data theo id
	$check=mysqli_num_rows($res);//tra về số hàng khi thực hiện truy vấn
	if($check>0){
		$row=mysqli_fetch_assoc($res);//tìm và trả về một dòng kết quả của một truy vấn MySQL dưới dạng một mảng kết hợp
		$categories=$row['categories'];//warrning
	}else{
		header('location:categories.php');//chuyển trang
		die();
	}
}

if(isset($_POST['submit'])){
	$categories=get_safe_value($con,$_POST['categories']);//kết nối data và thưc hiện post categories từ client lên data
	$res=mysqli_query($con,"select * from categories where categories='$categories'");//kiếm tra categories đã tồn tại
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Categories already exist";
			}
		}else{
			$msg="Categories already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($con,"update categories set categories='$categories' where id='$id'");//update catrgories
		}else{
			mysqli_query($con,"insert into categories(categories,status) values('$categories','1')");
		}
		header('location:categories.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Categories</label>
									<input type="text" name="categories" placeholder="Enter categories name" class="form-control" required value="<?php echo $categories?>">
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.inc.php');
?>