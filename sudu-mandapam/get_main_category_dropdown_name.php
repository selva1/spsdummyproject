<?php
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$id = mysqli_real_escape_string($conn,$_POST['id']);
$maincatids = mysqli_real_escape_string($conn,$_POST['maincatid']);

if($id)
{
	/*$id=$id;
	
	if ($stmt = $conn->prepare("SELECT `category_id`, `category_name` FROM `tbl_category` WHERE cat_type_id = ? and parent_id=? ")) {
		// Bind the variables to the parameter as strings. 
		$parentid=0;
		$stmt->bind_param("ii", $id,$parentid);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($category_id,$category_name);
		  $rows[''];
			while ($row = $stmt->fetch()) { 
			
			if($maincatids==$category_id){
				echo $selected= "selected=''";
			}else{
				$selected ="";
			}
			?>
			<option value="<?php echo $category_id; ?>" <?php echo $selected; ?>><?php echo $category_name; ?></option>
			<?php	}	
			} else{ ?>
		   <option value="">please category name</option>
		<?php }
		
		} */
		
			$categoryList = categoryParentChildTree(); 
			
			foreach($categoryList as $key => $value){ 
			
			if($maincatids==$value['category_id']){
				$selected= "selected=''";
			}else{
				$selected ="";
			}
			
			?>
			
			<option value="<?php  echo $value['category_id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
			<?php }
	}
?>
