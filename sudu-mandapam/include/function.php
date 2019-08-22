<?php
include_once("config.php");
//login function 
function login(){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT id,user_name,email,user_type FROM  hm_users WHERE email = ? and password = ?")) {
		// Bind the variables to the parameter as strings. 
		$name     = mysqli_real_escape_string($conn,$_POST['username']);
	    $password = mysqli_real_escape_string($conn,$_POST['password']);
	    $password = md5($password);
		$stmt->bind_param("ss", $name, $password);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$userName,$resultEmail,$user_type);
		  $rows=[];
			while ($row = $stmt->fetch()) {
				$_SESSION['userid'] 	    = $id;
				$_SESSION['userName']    	= $userName;
				$_SESSION['resultEmail'] 	= $resultEmail;
				$_SESSION['user_type']    	= $user_type;
				
				$_SESSION['adminStatus'] 	= "admin";
				$data['is_logged_in']=1;
				$data['user_type']=$_SESSION['user_type'];
				return $data;
			}	
		} else {
            $data['is_logged_in']=0;
            $data['user_type']="";
		return $data;
		}
	} 
$stmt->close();
$conn->close();
}

function isNotLogin(){
	$userId   = $_SESSION['userid'];
	$userName = $_SESSION['userName'];
	$resultEmail = $_SESSION['resultEmail'];
	$admin_status=$_SESSION['adminStatus'] 	;
	if(!isset($userId) && !isset($admin_status) && $admin_status!= "admin"){
		header("location:login.php");
	}
}

function paginateAllCategoryList($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
	$prevlabel = "&#60;";
	$nextlabel = "&#62;";
	$out = '<div class="pagin green">';
    $nu_vals="1";
	// previous label
	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}else {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}
// first label

	if($page>($adjacents+1)) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}
	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class='current'>$i</span>";
		}else if($i==1) {
			//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}else {
			//$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}
	}

	// interval

if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}
	// last
	if($page<($tpages-$adjacents)) {
		//$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
	}
	// next
	if($page<$tpages) {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}

// Add Main Categories
function addmaincategory(){
	$conn=dbconnection();
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$editid       = mysqli_real_escape_string($conn,$_POST['editid']);
	if($command=="addMainCategory" ){
	  if(!empty($editid)){
	  	// update query 
	  	    $current_date =  date("Y-m-d h:i:s");
			$parent_id=0;
			$category     = mysqli_real_escape_string($conn,$_POST['category']);
			$title        = mysqli_real_escape_string($conn,$_POST['title']);
			$keyword      = mysqli_real_escape_string($conn,$_POST['keyword']);
			$description  = mysqli_real_escape_string($conn,$_POST['description']);
			$maindescription  = mysqli_real_escape_string($conn,$_POST['maindescription']);
			$links        = mysqli_real_escape_string($conn,$_POST['links']);
			$mainselect   = mysqli_real_escape_string($conn,$_POST['mainselect']);
			$status       = mysqli_real_escape_string($conn,$_POST['status']);

			$stmt = $conn->prepare("UPDATE tbl_category SET category_name=?, cat_alias=?,meta_title=?,meta_keyword=?,meta_description=?,main_description=?,status=?,cat_type_id=? WHERE category_id=?");
			//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
			$stmt->bind_param('ssssssiii', $category, $links, $title,$keyword,$description,$maindescription,$status,$mainselect,$editid);
			$results =  $stmt->execute();
			if($results){
			//print 'Success! record updated'; 
			echo "1";
			}else{
			//print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
			echo "0";
			} 	
		 }else{
		// prepare and bind
		$stmt = $conn->prepare("INSERT INTO tbl_category ( `category_name`, `cat_alias`, `parent_id`, `meta_title`, `meta_keyword`, `meta_description`,main_description, `status`,  `cat_type_id`,  `created_on`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssissssiis", $category, $links, $parent_id,$title,$keyword,$description,$maindescription,$status,$mainselect,$current_date);
        $current_date =  date("Y-m-d h:i:s");
		$parent_id=0;
		$category     = mysqli_real_escape_string($conn,$_POST['category']);
		$title        = mysqli_real_escape_string($conn,$_POST['title']);
		$keyword      = mysqli_real_escape_string($conn,$_POST['keyword']);
		$description  = mysqli_real_escape_string($conn,$_POST['description']);
		$maindescription  = mysqli_real_escape_string($conn,$_POST['maindescription']);
		$links        = mysqli_real_escape_string($conn,$_POST['links']);
		$mainselect   = mysqli_real_escape_string($conn,$_POST['mainselect']);
		$status       = mysqli_real_escape_string($conn,$_POST['status']);
		$stmt->execute();
		echo "1";
		$conn->close();
	}
 }

}
// select Query for categories value ...

function editCateValue($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `category_id`, `category_name`, `cat_alias`, `parent_id`, `level`, `meta_title`, `meta_keyword`, `meta_description`,main_description, `status`, `sort_order`, `cat_type_id`, `is_deleted`, `created_on` FROM `tbl_category` WHERE category_id = ? ")) {
		// Bind the variables to the parameter as strings. 
		$edit_id     = mysqli_real_escape_string($conn,$edit_id);
	    $stmt->bind_param("s", $edit_id);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($category_id,$category_name,$cat_alias,$parent_id,$level,$meta_title,$meta_keyword,$meta_description,$main_description,$status,$sort_order,$cat_type_id,$is_deleted,$created_on);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['category_id'] 	= $category_id;
				$rows['category_name']  = $category_name;
				$rows['cat_alias'] 	 = $cat_alias;
				$rows['level'] 	     = $level;
				$rows['meta_title'] 	 = $meta_title;
				$rows['meta_keyword'] = $meta_keyword;
				$rows['meta_description'] 	= $meta_description;
				$rows['main_description'] 	= $main_description;
				$rows['status'] 	    = $status;
				$rows['sort_order'] 	= $sort_order;
				$rows['cat_type_id'] = $cat_type_id;
				$rows['is_deleted'] 	= $is_deleted;
				$rows['created_on'] 	= $created_on;
				$rows['parent_id'] 	= $parent_id;
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}

// Add Main Categories

function addsubcategory(){
	$conn=dbconnection();
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$editid       = mysqli_real_escape_string($conn,$_POST['editid']);
	if($command=="addSubCategory" ){
	  if(!empty($editid)){
	  	// update query 
	  	    $current_date =  date("Y-m-d h:i:s");
			$category     = mysqli_real_escape_string($conn,$_POST['category']);
			$subcategory  = mysqli_real_escape_string($conn,$_POST['subcategory']);
			$title        = mysqli_real_escape_string($conn,$_POST['title']);
			$keyword      = mysqli_real_escape_string($conn,$_POST['keyword']);
			$description  = mysqli_real_escape_string($conn,$_POST['description']);
			$maindescription  = mysqli_real_escape_string($conn,$_POST['maindescription']);
			$links        = mysqli_real_escape_string($conn,$_POST['links']);
			$mainselect   = mysqli_real_escape_string($conn,$_POST['mainselect']);
			$status       = mysqli_real_escape_string($conn,$_POST['status']);

			$stmt = $conn->prepare("UPDATE tbl_category SET category_name=?, cat_alias=?,meta_title=?,meta_keyword=?,meta_description=?,main_description=?,status=?,cat_type_id=?,parent_id=? WHERE category_id=?");
			//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
			$stmt->bind_param('ssssssiiii', $subcategory, $links, $title,$keyword,$description,$maindescription,$status,$mainselect,$category,$editid);
			$results =  $stmt->execute();
			if($results){
			//print 'Success! record updated'; 
			echo "1";
			}else{
			//print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
			echo "0";
			}
	  }else{
		// prepare and bind
		$stmt = $conn->prepare("INSERT INTO tbl_category ( `category_name`, `cat_alias`, `parent_id`, `meta_title`, `meta_keyword`, `meta_description`,main_description, `status`,  `cat_type_id`,  `created_on`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssissssiis", $subcategory, $links, $category,$title,$keyword,$description,$main_description,$status,$mainselect,$current_date);
            $current_date =  date("Y-m-d h:i:s");
			$category     = mysqli_real_escape_string($conn,$_POST['category']);
			$subcategory  = mysqli_real_escape_string($conn,$_POST['subcategory']);
			$title        = mysqli_real_escape_string($conn,$_POST['title']);
			$keyword      = mysqli_real_escape_string($conn,$_POST['keyword']);
			$description  = mysqli_real_escape_string($conn,$_POST['description']);
			$main_description  = mysqli_real_escape_string($conn,$_POST['maindescription']);
			$links        = mysqli_real_escape_string($conn,$_POST['links']);
			$mainselect   = mysqli_real_escape_string($conn,$_POST['mainselect']);
			$status       = mysqli_real_escape_string($conn,$_POST['status']);
		$stmt->execute();
		echo "1";
		$conn->close();
	}
 }
}


function getgaties($cat_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT  `category_name` FROM `tbl_category` WHERE category_id = ? ")) {
	// Bind the variables to the parameter as strings. 
		$stmt->bind_param("i", $cat_id);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($category_name);
		  while ($row = $stmt->fetch()) {
				echo  $category_name;
			}
		} else {
		return FALSE;	
		}
}
}

function getCategoryparentId($cat_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT  `parent_id` FROM `tbl_category` WHERE category_id = ? ")) {
	// Bind the variables to the parameter as strings. 
		$stmt->bind_param("i", $cat_id);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($parent_id);
		  while ($row = $stmt->fetch()) {
				return  $parent_id;
			}
		} else {
		return FALSE;	
		}
}
}




function categoryParentChildTree($parent = 0, $spacing = '', $category_tree_array = '') {
    $conn=dbconnection();
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $parent = $parent;
    if (!is_array($category_tree_array))
        $category_tree_array = array();
    $sqlCategory = "SELECT 	category_id,category_name,parent_id FROM tbl_category WHERE parent_id = $parent and cat_type_id =$id ORDER BY category_id ASC";
    $resCategory=$conn->query($sqlCategory);
    if ($resCategory->num_rows > 0) {
        while($rowCategories = $resCategory->fetch_assoc()) {
            $category_tree_array[] = array("category_id" => $rowCategories['category_id'], "name" => $spacing . $rowCategories['category_name']);
            $category_tree_array = categoryParentChildTree($rowCategories['category_id'], '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array);
        }
    }
    return $category_tree_array;
}

function categoryParentChildTreeAddProd($parent = 0, $spacing = '', $category_tree_array = '') {
    $conn=dbconnection();
    $parent = $parent;
    if (!is_array($category_tree_array))
        $category_tree_array = array();
     $sqlCategory = "SELECT category_id,category_name,parent_id FROM tbl_category WHERE parent_id = $parent  ORDER BY category_id ASC";
    $resCategory=$conn->query($sqlCategory);
    if ($resCategory->num_rows > 0) {
        while($rowCategories = $resCategory->fetch_assoc()) {
           $category_tree_array[] = array("category_id" => $rowCategories['category_id'], "name" => $spacing . $rowCategories['category_name']);
            $category_tree_array = categoryParentChildTreeAddProd($rowCategories['category_id'], '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array);
        }
    }
    return $category_tree_array;
}


function paginateAllproductList($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
	$prevlabel = "&#60;";
	$nextlabel = "&#62;";
	$out = '<div class="pagin green">';
    $nu_vals="1";
	// previous label
	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}else {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}
	// first label
	if($page>($adjacents+1)) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}
	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class='current'>$i</span>";
		}else if($i==1) {
			//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}else {
			//$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}
	}
	// interval
	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}
	// last

	if($page<($tpages-$adjacents)) {
		//$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
	}
	// next
	if($page<$tpages) {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}
//color pagenation 

function paginateAllcolorList($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
	$prevlabel = "&#60;";
	$nextlabel = "&#62;";
	$out = '<div class="pagin green">';
    $nu_vals="1";
	// previous label
	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}else {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}
	// first label
	if($page>($adjacents+1)) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}
	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class='current'>$i</span>";
		}else if($i==1) {
			//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}else {
			//$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}
	}
	// interval
	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}
	// last

	if($page<($tpages-$adjacents)) {
		//$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
	}
	// next
	if($page<$tpages) {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}

function paginateAllHomeCatList($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
	$prevlabel = "&#60;";
	$nextlabel = "&#62;";
	$out = '<div class="pagin green">';
	$nu_vals="1";
	// previous label
	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}else {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}
	// first label
	if($page>($adjacents+1)) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}
	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class='current'>$i</span>";
		}else if($i==1) {
			//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}else {
			//$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}
	}
	// interval
	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}
	// last

	if($page<($tpages-$adjacents)) {
		//$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
	}
	// next
	if($page<$tpages) {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}
function paginateAllcatSpecificationList($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
    $prevlabel = "&#60;";
    $nextlabel = "&#62;";
    $out = '<div class="pagin green">';
    $nu_vals="1";
    // previous label
    if($page==1) {
        $out.= "<span>$prevlabel</span>";
    } else if($page==2) {
        //$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
        $out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
    }else {
        //$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
        $out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
    }
    // first label
    if($page>($adjacents+1)) {
        //$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
        $out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
    }
    // interval
    if($page>($adjacents+2)) {
        $out.= "...\n";
    }
    // pages
    $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
    $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
    for($i=$pmin; $i<=$pmax; $i++) {
        if($i==$page) {
            $out.= "<span class='current'>$i</span>";
        }else if($i==1) {
            //$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
            $out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
        }else {
            //$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
            $out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
        }
    }
    // interval
    if($page<($tpages-$adjacents-1)) {
        $out.= "...\n";
    }
    // last

    if($page<($tpages-$adjacents)) {
        //$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
        $out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
    }
    // next
    if($page<$tpages) {
        //$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
        $out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
    }else {
        $out.= "<span>$nextlabel</span>";
    }
    $out.= "</div>";
    return $out;
}


// Add product details
function addproduct(){
	$conn=dbconnection();
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$editid       = mysqli_real_escape_string($conn,$_POST['editid']);
	$current_date =  date("Y-m-d h:i:s");
	$category     = mysqli_real_escape_string($conn,$_POST['category']);
	$productname  = mysqli_real_escape_string($conn,$_POST['productname']);
	$title        = mysqli_real_escape_string($conn,$_POST['title']);
	$keyword      = mysqli_real_escape_string($conn,$_POST['keyword']);
	$description  = mysqli_real_escape_string($conn,$_POST['description']);
	$links        = $_POST['links'];
	$overalldiscount  = $_POST['overalldiscount'];
	$brand        = mysqli_real_escape_string($conn,$_POST['brand']);
	$price        = mysqli_real_escape_string($conn,$_POST['price']);
	$discount_1     = mysqli_real_escape_string($conn,$_POST['discount']);
	$discount_percentage_1 = mysqli_real_escape_string($conn,$_POST['discount_percentage']);
	$grmorKg_0    = mysqli_real_escape_string($conn,$_POST['grmorKg']);
	$color        = mysqli_real_escape_string($conn,$_POST['color']);
	$status       = mysqli_real_escape_string($conn,$_POST['status']);
	$productdescs = mysqli_real_escape_string($conn,$_POST['productdescs']);
	$producattype = mysqli_real_escape_string($conn,$_POST['producattype']);
	
	
	$price1               = mysqli_real_escape_string($conn,$_POST['price1']);
	$discount1            = mysqli_real_escape_string($conn,$_POST['discount1']);
	$discount_percentage1 = mysqli_real_escape_string($conn,$_POST['discount_percentage1']);
	$grmorKg_1              = mysqli_real_escape_string($conn,$_POST['grmorKg1']);
	
	
	$price2               = mysqli_real_escape_string($conn,$_POST['price2']);
	$discount2            = mysqli_real_escape_string($conn,$_POST['discount2']);
	$discount_percentage2 = mysqli_real_escape_string($conn,$_POST['discount_percentage2']);
	$grmorKg_2              = mysqli_real_escape_string($conn,$_POST['grmorKg2']);

	$price3               = mysqli_real_escape_string($conn,$_POST['price3']);
	$discount3            = mysqli_real_escape_string($conn,$_POST['discount3']);
	$discount_percentage3 = mysqli_real_escape_string($conn,$_POST['discount_percentage3']);
	$grmorKg_3              = mysqli_real_escape_string($conn,$_POST['grmorKg3']);

	
	$price4               = mysqli_real_escape_string($conn,$_POST['price4']);
	$discount4            = mysqli_real_escape_string($conn,$_POST['discount4']);
	$discount_percentage4 = mysqli_real_escape_string($conn,$_POST['discount_percentage4']);
	$grmorKg_4              = mysqli_real_escape_string($conn,$_POST['grmorKg4']);
	
	
	if($grmorKg_0=="")
        $grmorKg=0;
    else
        $grmorKg=$grmorKg_0;
        
    if($grmorKg_1=="")
        $grmorKg1=0;
    else
        $grmorKg1=$grmorKg_1;
    
     if($grmorKg_2=="")
        $grmorKg2=0;
    else
        $grmorKg2=$grmorKg_2;
        
    if($grmorKg_3=="")
        $grmorKg3=0;
    else
        $grmorKg3=$grmorKg_3;
        
    if($grmorKg_4=="")
        $grmorKg4=0;
    else
        $grmorKg4=$grmorKg_4;                                              

    if($discount_1=="")
        $discount=0;
    else
        $discount=$discount_1;
    if($discount_percentage_1=="")
        $discount_percentage=0;
    else
        $discount_percentage=$discount_percentage_1;
        
     if($price1=="")
        $pricec1=0;
    else
        $pricec1=$price1;
     if($discount1=="")
        $discountc1=0;
    else
        $discountc1=$discount1;    
     if($discount_percentage1=="")
        $discount_percentagec1=0;
    else
        $discount_percentagec1=$discount_percentage1;    
        
        
     if($price2=="")
        $pricec2=0;
    else
        $pricec2=$price2;
     if($discount2=="")
        $discountc2=0;
    else
        $discountc2=$discount2;    
     if($discount_percentage2=="")
        $discount_percentagec2=0;
    else
        $discount_percentagec2=$discount_percentage2;   
        
        
      if($price3=="")
        $pricec3=0;
    else
        $pricec3=$price3;
     if($discount3=="")
        $discountc3=0;
    else
        $discountc3=$discount3;    
     if($discount_percentage3=="")
        $discount_percentagec3=0;
    else
        $discount_percentagec3=$discount_percentage3;   
        
     if($price4=="")
        $pricec4=0;
    else
        $pricec4=$price4;
     if($discount4=="")
        $discountc4=0;
    else
        $discountc4=$discount4;    
     if($discount_percentage4=="")
        $discount_percentagec4=0;
    else
        $discount_percentagec4=$discount_percentage4;              
                

	if($command=="addProduct" ){
	  if(!empty($editid)){
	  	// update query 
			$stmt = $conn->prepare("UPDATE tbl_products SET product_alis_link=?,overalldiscount=?, meta_title=?,meta_keyword=?,meta_description=?,Title=?,Description=?,Brand=?,Color=?,cat_id=?,product_status=?,cat_type_id=? WHERE ProductID=?");
			//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
			$stmt->bind_param('sssssssiiiiii', $links,$overalldiscount,$title,$keyword,$description,$productname,$productdescs,$brand,$color,$category,$status,$producattype,$editid);
			$conn->set_charset("utf8");
			$results =  $stmt->execute();

           $sqldelete = "DELETE FROM tbl_product_price WHERE productId=$editid";
		    mysqli_query($conn, $sqldelete);
		   
		   $stmt_price = "INSERT INTO tbl_product_price ( `productId`, `price`,`discount_amount`,`discount_percentage`,weight,pri_iden) 
                        VALUES ('$editid','$price','$discount','$discount_percentage','$grmorKg','0')";
		  $conn->query($stmt_price);
		  if($pricec1!=""){
		  	$stmt_price1 = "INSERT INTO tbl_product_price ( `productId`, `price`,`discount_amount`,`discount_percentage`,weight,pri_iden) 
                        VALUES ('$editid','$pricec1','$discountc1','$discount_percentagec1','$grmorKg1','1')";
		  $conn->query($stmt_price1);
		  }
		   if($pricec2!=""){
		  		$stmt_price2 = "INSERT INTO tbl_product_price ( `productId`, `price`,`discount_amount`,`discount_percentage`,weight,pri_iden) 
                        VALUES ('$editid','$pricec2','$discountc2','$discount_percentagec2','$grmorKg2','2')";
		  $conn->query($stmt_price2);
		  }
		  if($pricec3!=""){
		  		$stmt_price3 = "INSERT INTO tbl_product_price ( `productId`, `price`,`discount_amount`,`discount_percentage`,weight,pri_iden) 
                        VALUES ('$editid','$pricec3','$discountc3','$discount_percentagec3','$grmorKg3','3')";
		  $conn->query($stmt_price3);
		  }
		  if($pricec4!=""){
		  		$stmt_price4 = "INSERT INTO tbl_product_price ( `productId`, `price`,`discount_amount`,`discount_percentage`,weight,pri_iden) 
                        VALUES ('$editid','$pricec4','$discountc4','$discount_percentagec4','$grmorKg4','4')";
		  $conn->query($stmt_price4);
		  }
		  
		   
             /* if(is_product_price_exists($editid)) {

                  $update_price = "UPDATE tbl_product_price SET 
                              price=$price,discount_amount=$discount,discount_percentage=$discount_percentage
                               where productId=$editid";
                  $results = mysqli_query($conn, $update_price);
              }
          else{
              $stmt_price = "INSERT INTO tbl_product_price ( `productId`, `price`,`discount_amount`,`discount_percentage`) 
                        VALUES ('$editid','$price',$discount,$discount_percentage)";
              $results=$conn->query($stmt_price);
          }*/
			//if($results){
			//print 'Success! record updated'; 
			echo "1";
			//}else{
			//print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
			//echo "0";
			//}
	  }else{
		// prepare and bind
		
		$produt_Insert =  "INSERT INTO tbl_products ( `product_alis_link`,`overalldiscount`,`meta_title`, `meta_keyword`, `meta_description`,`Title`, `Description`, `Brand`, `Color`, `cat_id`,`created_date`, `product_status`,cat_type_id) VALUES ('$links', '$overalldiscount', '$title', '$keyword','$description','$productname','$productdescs','$brand','$color','$category','$current_date','$status','$producattype')";
		mysqli_query($conn,$produt_Insert);
		/*$stmt = $conn->prepare("INSERT INTO tbl_products ( `product_alis_link`, `meta_title`, `meta_keyword`, `meta_description`, `Title`, `Description`, `Brand`, `Color`, `cat_id`,`created_date`, `product_status`,cat_type_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
		$stmt->bind_param("ssssssssisii", $links, $title, $keyword,$description,$productname,$productdescs,$brand,$color,$category,$current_date,$status,$producattype);
		$conn->set_charset("utf8");
		$stmt->execute();*/
		$lastInsertId =  mysqli_insert_id($conn); 
		$stmt_price = "INSERT INTO tbl_product_price ( `productId`, `price`,`discount_amount`,`discount_percentage`,weight,pri_iden) 
                        VALUES ('$lastInsertId','$price','$discount','$discount_percentage','$grmorKg','0')";
		  $conn->query($stmt_price);
		  if($pricec1!=""){
		  	$stmt_price1 = "INSERT INTO tbl_product_price ( `productId`, `price`,`discount_amount`,`discount_percentage`,weight,pri_iden) 
                        VALUES ('$lastInsertId','$pricec1','$discountc1','$discount_percentagec1','$grmorKg1','1')";
		  $conn->query($stmt_price1);
		  }
		   if($pricec2!=""){
		  		$stmt_price2 = "INSERT INTO tbl_product_price ( `productId`, `price`,`discount_amount`,`discount_percentage`,weight,pri_iden) 
                        VALUES ('$lastInsertId','$pricec2','$discountc2','$discount_percentagec2','$grmorKg2','2')";
		  $conn->query($stmt_price2);
		  }
		  if($pricec3!=""){
		  		$stmt_price3 = "INSERT INTO tbl_product_price ( `productId`, `price`,`discount_amount`,`discount_percentage`,weight,pri_iden) 
                        VALUES ('$lastInsertId','$pricec3','$discountc3','$discount_percentagec3','$grmorKg3','3')";
		  $conn->query($stmt_price3);
		  }
		  if($pricec4!=""){
		  		$stmt_price4 = "INSERT INTO tbl_product_price ( `productId`, `price`,`discount_amount`,`discount_percentage`,weight,pri_iden) 
                        VALUES ('$lastInsertId','$pricec4','$discountc4','$discount_percentagec4','$grmorKg4','4')";
		  $conn->query($stmt_price4);
		  }
		  
		  
		  
		echo "1";
		$conn->close();
	}
 }
}

// add and edit color 

function addcolors(){
	
	$conn=dbconnection();

	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$colorname    = mysqli_real_escape_string($conn,$_POST['colorname']);
	$status       = mysqli_real_escape_string($conn,$_POST['status']);
	$editid       = mysqli_real_escape_string($conn,$_POST['editid']);

		if($command=="addColor"){

			if($editid!=""){

				$stmt = $conn->prepare("UPDATE tbl_colors SET color=?, color_status=? WHERE id=?");
				//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
				$stmt->bind_param('sii', $colorname,$status,$editid);
				$conn->set_charset("utf8");
				$stmt->execute();
				echo "1";
			}else{

				$stmt = $conn->prepare("INSERT INTO tbl_colors ( `color`, `color_status`) VALUES (?, ?)");
				$stmt->bind_param("si", $colorname, $status);
				$conn->set_charset("utf8");
				$stmt->execute();
				echo "1";
			}
			
		}
	
	}
	
	function deletecolors(){
		
	$conn=dbconnection();
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$ids          = mysqli_real_escape_string($conn,$_POST['Ids']);
	   
	   if($command=="DeleteColorlist"){
	   	
		$stmt = $conn->prepare("DELETE from tbl_colors WHERE id=?");
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$stmt->bind_param('i', $ids);
		$conn->set_charset("utf8");
		$stmt->execute();
		echo "1";	
		
	   }
		
	}

function deleteHomeCategory(){

	$conn=dbconnection();
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$ids          = mysqli_real_escape_string($conn,$_POST['Ids']);

	if($command=="DeleteHomeCategory"){
		$stmt = $conn->prepare("DELETE from home_categories_list WHERE id=?");
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$stmt->bind_param('i', $ids);
		$conn->set_charset("utf8");
		$stmt->execute();
		echo "1";

	}

}


function sigleprice($productId){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT 	id,price FROM tbl_product_price WHERE productId=? ORDER BY id ASC")) {
		// Bind the variables to the parameter as strings. 
		$stmt->bind_param("i", $productId);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$price);
		  while ($row = $stmt->fetch()) {
				return $price;
			}
		} else {
		return FALSE;	
	}
}
}

function sigleprice1($productId,$idens){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT 	id,price FROM tbl_product_price WHERE productId=? and pri_iden=? ORDER BY id ASC")) {
		// Bind the variables to the parameter as strings. 
		$stmt->bind_param("ii", $productId,$idens);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$price);
		  while ($row = $stmt->fetch()) {
				return $price;
			}
		} else {
		return FALSE;	
	}
}
}

function getDiscounts($productId){
    $conn=dbconnection();
    if ($stmt = $conn->prepare("SELECT id,discount_amount,discount_percentage,weight FROM tbl_product_price WHERE productId=? ORDER BY id ASC")) {
        // Bind the variables to the parameter as strings.
        $stmt->bind_param("i", $productId);
        // Execute the statement.
        $stmt->execute();
        $stmt->store_result();
        $numRows = $stmt->num_rows;
        $discount_details=array();
        if($numRows>0){
            $stmt->bind_result($id,$discount_amount,$discount_percentage,$weight);
            while ($row = $stmt->fetch()) {
            	
                $discount_details['discount_amount']=$discount_amount;
                $discount_details['discount_percentage']=$discount_percentage;
                $discount_details['weight']=$weight;
                
                return $discount_details;
            }
        } else {
            return FALSE;
        }
    }
}

function getDiscounts1($productId,$idens){
    $conn=dbconnection();
    if ($stmt = $conn->prepare("SELECT id,discount_amount,discount_percentage,weight FROM tbl_product_price WHERE productId=? and pri_iden=? ORDER BY id ASC")) {
        // Bind the variables to the parameter as strings.
        $stmt->bind_param("ii", $productId,$idens);
        // Execute the statement.
        $stmt->execute();
        $stmt->store_result();
        $numRows = $stmt->num_rows;
        $discount_details=array();
        if($numRows>0){
            $stmt->bind_result($id,$discount_amount,$discount_percentage,$weight);
            while ($row = $stmt->fetch()) {
            	
                $discount_details['discount_amount']=$discount_amount;
                $discount_details['discount_percentage']=$discount_percentage;
                $discount_details['weight']=$weight;
                
                return $discount_details;
            }
        } else {
            return FALSE;
        }
    }
}


// select Query for categories value ...
function editProductValue($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT  `product_alis_link`,`overalldiscount`, `meta_title`, `meta_keyword`, `meta_description`, `Title`, `Description`, `Brand`, `Color`, `cat_id`, `cat_type_id`, `product_img`,  `product_status` FROM `tbl_products` WHERE ProductID = ? ")) {
		// Bind the variables to the parameter as strings. 
		$edit_id     = mysqli_real_escape_string($conn,$edit_id);
	    $stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$conn->set_charset("utf8");
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($product_alis_link,$overalldiscount,$meta_title,$meta_keyword,$meta_description,$Title,$Description,$Brand,$Color,$cat_id,$cat_type_id,$product_img,$product_status);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['product_alis_link'] 	= $product_alis_link;
				$rows['overalldiscount'] 	= $overalldiscount;
				$rows['meta_title']         = $meta_title;
				$rows['meta_keyword']       = $meta_keyword;
				$rows['meta_description']   = $meta_description;
				$rows['Title'] 	            = $Title;
				$rows['Description'] 	    = $Description;
				$rows['Brand']              = $Brand;
				$rows['Color']              = $Color;
				$rows['cat_id'] 	        = $cat_id;
				$rows['cat_type_id']    	= $cat_type_id;
				$rows['product_status']     = $product_status;
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}

//color edits 


// select Query for categories value ...
function editColorValue($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id`, `color`, `color_status` FROM `tbl_colors`  WHERE id = ? ")) {
		// Bind the variables to the parameter as strings. 
		$edit_id     = mysqli_real_escape_string($conn,$edit_id);
	    $stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$conn->set_charset("utf8");
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$color,$color_status);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['id']             	= $id;
				$rows['Title']              = $color;
				$rows['product_status']     = $color_status;
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}

// select Query for categories value ...


function Imgdisplay($edit_id,$idenImg){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id`, `product_Id`, `img_link` FROM `tbl_productImg` WHERE product_Id = ? and img_iden=? ")) {
		// Bind the variables to the parameter as strings. 
	    $stmt->bind_param("is", $edit_id,$idenImg);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$product_Id,$img_link);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['id'] 	    = $id;
				$rows['product_Id'] = $product_Id;
				$rows['img_link']   = $img_link;
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}

function paginateAllBrandList($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
	$prevlabel = "&#60;";
	$nextlabel = "&#62;";
	$out = '<div class="pagin green">';
    $nu_vals="1";
	// previous label

	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}else {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}

	// first label
	if($page>($adjacents+1)) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}

	// pages

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class='current'>$i</span>";
		}else if($i==1) {
			//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
  		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}else {
		//$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}
	}
	// interval

	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}

	// last

	if($page<($tpages-$adjacents)) {
		//$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
	}

	// next

	if($page<$tpages) {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}
// select Query for categories value ...

function editbandsValue($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id`, `brand`, `brand_img`, `brand_img_over`,`brand_alis_name`, `meta_title`, `meta_keyword`, `meta_description`, `status` FROM `tbl_brands` WHERE id=? ")) {
		// Bind the variables to the parameter as strings. 
	    $stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$brand,$brand_img,$brand_img_over,$brand_alis_name,$meta_title,$meta_keyword,$meta_description,$status);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['id'] 	     = $id;
				$rows['brand']       = $brand;
				$rows['brand_img']   = $brand_img;
				$rows['brand_img_over']= $brand_img_over;
				$rows['brand_alis_name']    = $brand_alis_name;
				$rows['meta_title']         = $meta_title;
				$rows['meta_keyword']       = $meta_keyword;
				$rows['meta_description']   = $meta_description;
				$rows['status']   = $status;
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}


function editHomeSliderValue($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id`, `cat_type_id`, `img`, `descr`, `order_by`,status,`title`,`blog_link`,`active_read_more` FROM `main_Home_slider` WHERE id=? ")) {
		// Bind the variables to the parameter as strings. 
	    $stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$cat_type_id,$img,$descr,$order_by,$status,$title,$blog_link,$active_read_more);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['id'] = $id;
				$rows['cat_type_id']  = $cat_type_id;
				$rows['img'] = $img;
				$rows['descr'] = $descr;
				$rows['order_by']  = $order_by;
				$rows['title']  = $title;
				$rows['blog_link']  = $blog_link;
				$rows['active_read_more']  = $active_read_more;
				$rows['status']  = $status;
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}

function editHomeGategorySliderValue($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id`, `categories_id`, `cat_type_id`, `img_name`, `img_status` FROM `home_categories_slider_list` WHERE  id=? ")) {
		// Bind the variables to the parameter as strings. 
	    $stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$categories_id,$cat_type_id,$img_name,$img_status);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['id'] = $id;
				$rows['categories_id']  = $categories_id;
				$rows['cat_type_id']  = $cat_type_id;
				$rows['img'] = $img_name;
				$rows['status']  = $img_status;
				
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}


function editHomeGategoryBlogValue($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id`, `categories_id`, `cat_type_id`, `img_name`, `blog_name`, `blog_link`, `img_status` FROM `home_categories_blog_list` WHERE  id=? ")) {
		// Bind the variables to the parameter as strings. 
	    $stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$categories_id,$cat_type_id,$img_name,$blog_name,$blog_link,$img_status);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['id'] = $id;
				$rows['categories_id']  = $categories_id;
				$rows['cat_type_id']    = $cat_type_id;
				$rows['img'] = $img_name;
				$rows['blog_name'] = $blog_name;
				$rows['blog_link'] = $blog_link;
				$rows['status']    = $img_status;
				
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}

function editHomeGategoryTopBanners($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id`, `categories_id`, `cat_type_id`, `img_name`, `img_status`,title,orderby FROM `home_categories_top_banner_list` WHERE  id=? ")) {
		// Bind the variables to the parameter as strings. 
	    $stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$categories_id,$cat_type_id,$img_name,$img_status,$title,$orderby);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['id'] = $id;
				$rows['categories_id']  = $categories_id;
				$rows['cat_type_id']  = $cat_type_id;
				$rows['img'] = $img_name;
				$rows['status']  = $img_status;
				$rows['title']  = $title;
				$rows['orderby']  = $orderby;
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}

function paginatemainslidersList($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
	$prevlabel = "&#60;";
	$nextlabel = "&#62;";
	$out = '<div class="pagin green">';
    $nu_vals="1";
	// previous label
	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}else {
	//$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}
	// first label
	if($page>($adjacents+1)) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
	}

	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}

	// pages

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class='current'>$i</span>";
		}else if($i==1) {
			//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}else {
			//$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}
	}

	// interval

	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}

	// last

	if($page<($tpages-$adjacents)) {
		//$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
	}
	// next
	if($page<$tpages) {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}

function paginatecategorysliderList($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
	$prevlabel = "&#60;";
	$nextlabel = "&#62;";
	$out = '<div class="pagin green">';
    $nu_vals="1";
	// previous label
	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}else {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}

	// first label
	if($page>($adjacents+1)) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
	}

	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}

	// pages

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class='current'>$i</span>";
		}else if($i==1) {
			//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}else {
			//$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}
	}

	// interval

	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}
	// last
	if($page<($tpages-$adjacents)) {
		//$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
	}
	// next

	if($page<$tpages) {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}

function paginatecategoryTopBannerList($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
	$prevlabel = "&#60;";
	$nextlabel = "&#62;";
	$out = '<div class="pagin green">';
    $nu_vals="1";
	// previous label
	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}else {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}

	// first label
	if($page>($adjacents+1)) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
	}

	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}

	// pages

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class='current'>$i</span>";
		}else if($i==1) {
			//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}else {
			//$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}
	}

	// interval

	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}
	// last
	if($page<($tpages-$adjacents)) {
		//$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
	}
	// next

	if($page<$tpages) {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}

/* adding shipment */
function addshippments(){
	
	$conn=dbconnection();
	
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$shiptype    = mysqli_real_escape_string($conn,$_POST['ship_type']);
	$shipcost    = mysqli_real_escape_string($conn,$_POST['ship_cost']);
	$status       = mysqli_real_escape_string($conn,$_POST['status']);
	$editid       = mysqli_real_escape_string($conn,$_POST['editid']);
	//echo '<script type="text/javascript"> console.log('.$command.');</script>';
		if($command=="addShippment"){
			
			if($editid!=""){
				
				$stmt = $conn->prepare("UPDATE 	tbl_shipment SET ship_type=?,cost=?, status=? WHERE id=?");
				//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
				$stmt->bind_param('sdii', $shiptype,$shipcost,$status,$editid);
				$stmt->execute();
				echo "1";	
			}else{
				
				$stmt = $conn->prepare("INSERT INTO  tbl_shipment (`ship_type`, `cost`, `status`) VALUES (?,?,?)");
				$stmt->bind_param("sdi", $shiptype, $shipcost,$status);
				
				$stmt->execute();
				echo "1";
			}
			
		}
	
	}

/* edit shippment value */
function editShippmentValue($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id`, `ship_type`, `cost`, `status` FROM `tbl_shipment`  WHERE id = ? ")) {
		// Bind the variables to the parameter as strings. 
		$edit_id     = mysqli_real_escape_string($conn,$edit_id);
	    $stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$conn->set_charset("utf8");
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$ship_type,$cost,$status);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['id']             	= $id;
				$rows['ship_type']          = $ship_type;
				$rows['cost']               = $cost;
				$rows['shipp_status']       =$status;
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}

	function deleteshippment(){
		
	$conn=dbconnection();
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$ids          = mysqli_real_escape_string($conn,$_POST['Ids']);
	   
	   if($command=="deleteShippment"){
	   	
		$stmt = $conn->prepare("DELETE from tbl_shipment WHERE id=?");
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$stmt->bind_param('i', $ids);
		$conn->set_charset("utf8");
		$stmt->execute();
		echo "1";	
		
	   }
		
	}
/* edit & view  user details */
function editUserDetails($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `email`, `phone_number`, `mobile`, `name`, `shipping_email`, `shipping_mobile`, `shipping_address`, `country`, `city`, `districk`, `zip`, `spical_notes` FROM `hm_users` WHERE id = ? ")) {
		// Bind the variables to the parameter as strings. 
		$edit_id     = mysqli_real_escape_string($conn,$edit_id);
	    $stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$conn->set_charset("utf8");
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($email,$phone_number,$mobile,$name,$shipping_email,$shipping_mobile,$shipping_address,$country,$city,$districk,$zip,$spical_notes);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['email']         		= $email;
				$rows['phone_number']       = $phone_number;
				$rows['mobile']   			= $mobile;
				$rows['name'] 	    		= $name;
				$rows['shipping_email']     = $shipping_email;
				$rows['shipping_mobile']    = $shipping_mobile;
				$rows['shipping_address'] 	= $shipping_address;
				$rows['country']    		= $country;
				$rows['city']     			= $city;
				$rows['districk']			=$districk;
				$rows['zip']				=$zip;
				$rows['spical_notes']		=$spical_notes;
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}

/* edit coupon value */
function editCouponValue($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id`, `coupon_code`,`discount`, `start_date`, `expiry_date`, `status` FROM `tbl_coupon` WHERE id = ? ")) {
		// Bind the variables to the parameter as strings. 
		$edit_id     = mysqli_real_escape_string($conn,$edit_id);
	    $stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$conn->set_charset("utf8");
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$coupon_code,$discount,$start_date,$expiry_date,$status);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['id']             	= $id;
				$rows['coupon_code']        = $coupon_code;
				$rows['discount']			=$discount;
				$rows['start_date']         = $start_date;
				$rows['expiry_date']		=$expiry_date;
				$rows['status']       =$status;
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}
/* adding shipment */
function addcoupon(){
	
	$conn=dbconnection();
	
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$coup_code    = mysqli_real_escape_string($conn,$_POST['coup_code']);
	$discount	  = mysqli_real_escape_string($conn,$_POST['discount']);
	$start_date    = mysqli_real_escape_string($conn,$_POST['start_date']);
	$expiry_date    = mysqli_real_escape_string($conn,$_POST['expiry_date']);
	$status       = mysqli_real_escape_string($conn,$_POST['status']);
	$editid       = mysqli_real_escape_string($conn,$_POST['editid']);
	//echo '<script type="text/javascript"> console.log('.$command.');</script>';
		if($command=="addCoupon"){
			
			if($editid!=""){
				
				$stmt = $conn->prepare("UPDATE 	tbl_coupon SET coupon_code=?,discount=?,start_date=?,expiry_date=?, status=? WHERE id=?");
				//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
				$stmt->bind_param('sdssii', $coup_code,$discount,$start_date,$expiry_date,$status,$editid);
				$stmt->execute();
				echo "1";	
			}else{
				
				$stmt = $conn->prepare("INSERT INTO `tbl_coupon`(`id`, `coupon_code`, `discount`,`start_date`, `expiry_date`, `status`) VALUES (?,?,?)");
				$stmt->bind_param("sdssi", $coup_code,$discount,$start_date,$expiry_date,$status);
				
				$stmt->execute();
				echo "1";
			}
			
		}
	
	}

// editing static page content
function editPageContent($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `name`, `page_alias`, `meta_title`, `meta_keyword`, `meta_description`, `content`, `status` FROM `tbl_static_pages` WHERE id = ? ")) {
		// Bind the variables to the parameter as strings. 
		$edit_id     = mysqli_real_escape_string($conn,$edit_id);
	    $stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$conn->set_charset("utf8");
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($name,$page_alias,$meta_title,$meta_keyword,$meta_description,$content,$status);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$rows['name'] 	= $name;
				$rows['page_alias']          = $page_alias;
				$rows['meta_title']       	 = $meta_title;
				$rows['meta_keyword']   	 = $meta_keyword;
				$rows['meta_description'] 	 = $meta_description;
				$rows['content'] 	   		 = $content;
				$rows['status']              = $status;
			}
			 return $rows;
		} else {
		return FALSE;	
		}
}
}

/* Add static page content */
function addstaticpage(){
	$conn=dbconnection();
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$editid       = mysqli_real_escape_string($conn,$_POST['editid']);
	$pagename     = mysqli_real_escape_string($conn,$_POST['pagename']);
	$page_alias  = mysqli_real_escape_string($conn,$_POST['page_alias']);
	$title        = mysqli_real_escape_string($conn,$_POST['title']);
	$keyword      = mysqli_real_escape_string($conn,$_POST['keyword']);
	$description  = mysqli_real_escape_string($conn,$_POST['description']);
	$status       = mysqli_real_escape_string($conn,$_POST['status']);
	$content = mysqli_real_escape_string($conn,$_POST['content']);

	if($command=="addStaticPage" ){
	  if(!empty($editid)){
	  	// update query 
			$stmt = $conn->prepare("UPDATE tbl_static_pages SET name=?, page_alias=?,meta_title=?,meta_keyword=?,meta_description=?,content=?,status=? WHERE id=?");
			//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
			$stmt->bind_param('ssssssii', $pagename,$page_alias,$title,$keyword,$description,$content,$status,$editid);
			$conn->set_charset("utf8");
			$results =  $stmt->execute();
			if($results)
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
	  }else{
		// prepare and bind
		$stmt = $conn->prepare("INSERT INTO tbl_static_pages (`name`, `page_alias`, `meta_title`, `meta_keyword`, `meta_description`, `content`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssi", $pagename,$page_alias,$title,$keyword,$description,$content,$status);
		$conn->set_charset("utf8");
		$stmt->execute();
		echo "1";
		$conn->close();
	}
 }
}

/* deleting static page */
function deletestaticpage(){
		
	$conn=dbconnection();
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$ids          = mysqli_real_escape_string($conn,$_POST['Ids']);
	   
	   if($command=="deleteStaticPage"){
	   	
		$stmt = $conn->prepare("DELETE from tbl_static_pages WHERE id=?");
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$stmt->bind_param('i', $ids);
		$conn->set_charset("utf8");
		$stmt->execute();
		echo "1";	
		
	   }
		
	}
function paginateAllOrderList($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
	$prevlabel = "&#60;";
	$nextlabel = "&#62;";
	$out = '<div class="pagin green">';
	$nu_vals="1";
	// previous label
	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}else {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}
	// first label
	if($page>($adjacents+1)) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}
	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class='current'>$i</span>";
		}else if($i==1) {
			//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}else {
			//$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}
	}
	// interval
	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}
	// last

	if($page<($tpages-$adjacents)) {
		//$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
	}
	// next
	if($page<$tpages) {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}

function adminAmountFormat($price){
	return number_format($price);
}

function getOrderConfirmDetails($order_id){
	$conn=dbconnection();
	$query="SELECT DISTINCT * FROM `tbl_orders_cofirm` oc
 								INNER JOIN `tbl_products` p 
 								ON p.ProductID=oc.productId
 								WHERE oc.order_id = '$order_id' ";

	$conn->set_charset("utf8");
		$query_vals    = mysqli_query($conn,$query);
		$numrows = mysqli_num_rows($query_vals);
		$result_final = mysqli_query($conn,$query);
		if($numrows>0){
			return $result_final;
		} else {
			return FALSE;
		}

}

function getShippingDetails($order_id){
	$conn=dbconnection();
	 $query="SELECT oc.user_id FROM `tbl_orders_cofirm` oc WHERE oc.order_id = '$order_id' group by oc.user_id ";
	$conn->set_charset("utf8");
	$query_vals    = mysqli_query($conn,$query);
	$resultad = mysqli_fetch_array($query_vals);
	 $user_id = $resultad['user_id'];
	
	 $queryadd="SELECT name,shipping_address,country,city,districk,zip,shipping_email,shipping_mobile FROM `hm_users` WHERE id='$user_id'  ";
	$conn->set_charset("utf8");
	$query_valssa    = mysqli_query($conn,$queryadd);
	$numrows = mysqli_num_rows($query_valssa);

	$address_details=[];
	if($numrows>0){
		while($resultad = mysqli_fetch_array($query_valssa)){
			$address_details['name']=$resultad['name'];
			$address_details['address']=$resultad['shipping_address'];
			$address_details['country']=$resultad['country'];
			$address_details['city']=$resultad['city'];
			$address_details['districk']=$resultad['districk'];
			$address_details['zip']=$resultad['zip'];
			$address_details['shipping_email']=$resultad['shipping_email'];
			$address_details['shipping_mobile']=$resultad['shipping_mobile'];
		}
		return $address_details;
	} else {
		return FALSE;
	}

}
function getShippingCostDetails($order_id){
	$conn=dbconnection();
	$query="SELECT * FROM `order_confirm_shipping_details_discount_amt` ocs 
 			WHERE order_id = '$order_id'";
	$conn->set_charset("utf8");
	$query_vals    = mysqli_query($conn,$query);
	$numrows = mysqli_num_rows($query_vals);
	$result_final = mysqli_query($conn,$query);
	$cost_details=[];
	if($numrows>0){
		while($result = mysqli_fetch_array($result_final)){
			$cost_details['shipping_cost']=$result['shipping_cost'];
			if($result['disout_amt']=="")
				$disc_amount=0;
			else
				$disc_amount=$result['disout_amt'];
			$cost_details['disout_amt']=$disc_amount;
			$cost_details['total']=$result['total'];
			$cost_details['grand_total']=$result['grand_total'];
		}
		return $cost_details;
	} else {
		return FALSE;
	}

}

function get_order_status($order_id){
    $conn=dbconnection();
    $query="SELECT order_status,order_id FROM `order_confirm_shipping_details_discount_amt` ocs 
 			WHERE order_id = '$order_id'";
    $conn->set_charset("utf8");
    if ($result=mysqli_query($conn,$query))
    {
        while ($row=mysqli_fetch_row($result))
        {
            return $row[0];
        }
    }
}

function updateOrderStatus(){
    $conn=dbconnection();
    $command      = mysqli_real_escape_string($conn,$_POST['command']);
    $status         = mysqli_real_escape_string($conn,$_POST['status']);
    $order_id         = mysqli_real_escape_string($conn,$_POST['order_id']);
    $curr_date=date('Y-m-d');
    if($command=="UpdateOrderStatus"){
        $update_price = "UPDATE order_confirm_shipping_details_discount_amt 
                      SET order_status='$status', status_change_date='$curr_date' WHERE order_id='$order_id'";
        if($conn->query($update_price))
            echo "1";
        else
            echo "0";
    }
}

function addSpecification(){

	$conn=dbconnection();

	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$category    = mysqli_real_escape_string($conn,$_POST['category']);
	$specification    = mysqli_real_escape_string($conn,$_POST['specification']);
    $editid       = mysqli_real_escape_string($conn,$_POST['editid']);
    //echo '<script type="text/javascript"> console.log('.$command.');</script>';
	if($command=="addSpecification"){

		if($editid!=""){

			$stmt = "UPDATE tbl_category_specification_list 
                                    SET feature_property='$specification' WHERE id=$editid";
			if($conn->query($stmt))
				echo "1";
			else
				echo "0";
		}else{
            $stmt = "INSERT INTO tbl_category_specification_list (`category_id`,`feature_property`)
                      VALUES ($category,'$specification')";
            $conn->set_charset("utf8");
            $conn->query($stmt);
			echo "1";
		}

	}

}
function editCatSpecificationValue($edit_id){
    $conn=dbconnection();
    if ($stmt = $conn->prepare("SELECT * FROM `tbl_category_specification_list` WHERE id = ? ")) {
        // Bind the variables to the parameter as strings.
        $edit_id     = mysqli_real_escape_string($conn,$edit_id);
        $stmt->bind_param("i", $edit_id);
        // Execute the statement.
        $conn->set_charset("utf8");
        $stmt->execute();
        $stmt->store_result();
        $numRows = $stmt->num_rows;
        if($numRows>0){
            $stmt->bind_result($spec_id,$cat_id,$spec_property,$created_date);
            $rows=[];
            while ($row = $stmt->fetch()) {
                $rows['feature_property'] 	= $spec_property;
                $rows['cat_id']         = $cat_id;
                $rows['cat_type_id']         = "1";
            }
            return $rows;
        } else {
            return FALSE;
        }
    }
}
function deleteCatSpecification(){

	$conn=dbconnection();
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$ids          = mysqli_real_escape_string($conn,$_POST['Ids']);

	if($command=="deleteCatSpecification"){

		$stmt = $conn->prepare("DELETE from tbl_category_specification_list WHERE id=?");
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$stmt->bind_param('i', $ids);
		$conn->set_charset("utf8");
		$stmt->execute();
		echo "1";

	}

}

function get_cat_id_product($product_id){
    $conn=dbconnection();
    $sql="SELECT cat_id FROM `tbl_products` WHERE ProductID=$product_id";
    $conn->set_charset("utf8");
    if ($result=mysqli_query($conn,$sql))
    {
        while ($row=mysqli_fetch_row($result))
        {
            return $row[0];
        }
    }
}
function get_category_specific_list($category_id,$product_id){
    $conn=dbconnection();
    $sql="SELECT *,ps.id as pro_spec_id,cs.id as cat_spec_id FROM `tbl_category_specification_list` cs 
		  LEFT OUTER JOIN tbl_product_specifications ps
		  ON cs.id=ps.feature_property_id
		  WHERE category_id=$category_id AND ps.product_id=$product_id";
	$conn->set_charset("utf8");
    $result=mysqli_query($conn,$sql);
	$spec_res=[];
	while ($row=mysqli_fetch_array($result)){
		$spec_res[]=$row;
	}
    if($result->num_rows==0)
    {
    	 $sql="SELECT *,cs.id as cat_spec_id FROM `tbl_category_specification_list` cs 
				WHERE category_id=$category_id";
			$conn->set_charset("utf8");
    		$result=mysqli_query($conn,$sql);
			$spec_res1=[];
			while ($row=mysqli_fetch_array($result)){
				$row['features']="";
				$spec_res1[]=$row;
			}
			foreach ($spec_res1 as $row1)
			{
				$row1['feature']="";
				$spec_res[]=$row1;
			}
    }
    return $spec_res;
}
function addProductSpecifications(){
    $conn=dbconnection();
	$spec_list=$_REQUEST['spec_list'];
	$product_id=$_REQUEST['product_id'];
	$status="0";
    foreach ($spec_list as $spec){
		if(!is_specification_exists($product_id,$spec[0])){
			$stmt = "INSERT INTO  tbl_product_specifications (`product_id`,`feature_property_id`,`feature`)
						  VALUES ($product_id,$spec[0],'$spec[1]')";
			$conn->set_charset("utf8");
			if($conn->query($stmt))
				$status="1";
			else
				$status="0";
		}
		else{
			$stmt = "UPDATE tbl_product_specifications 
                    SET feature='$spec[1]' 
                    WHERE product_id = $product_id AND feature_property_id=$spec[0]";
			if($conn->query($stmt))
				$status="1";
			else
				$status="0";
		}
	}
    echo $status;
}

function is_specification_exists($product_id,$cat_spec_id){
	$conn=dbconnection();
	$query="SELECT * FROM `tbl_product_specifications` 
 			WHERE product_id = $product_id AND feature_property_id=$cat_spec_id";
	$conn->set_charset("utf8");
	$result=$conn->query($query);
	if ($result->num_rows==0) {
		return false;
	}
	else{
		return true;
	}
}

function is_product_price_exists($product_id){
	$conn=dbconnection();
	$query="SELECT * FROM `tbl_product_price` 
 			WHERE productId = $product_id ";
	$conn->set_charset("utf8");
	$result=$conn->query($query);
    if ($result->num_rows==0) {
		return false;
	}
	else{
		return true;
	}
}

function deleteCategory(){

	$conn=dbconnection();
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$ids          = mysqli_real_escape_string($conn,$_POST['Ids']);

	if($command=="DeleteCategoryList"){

		$stmt = $conn->prepare("DELETE from tbl_category WHERE category_id=?");
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$stmt->bind_param('i', $ids);
		$conn->set_charset("utf8");
		$stmt->execute();
		echo "1";

	}

}
function deleteTopBanner(){

    $conn=dbconnection();
    $command      = mysqli_real_escape_string($conn,$_POST['command']);
    $ids          = mysqli_real_escape_string($conn,$_POST['Ids']);

    if($command=="deleteTopBanner"){

        $stmt = $conn->prepare("DELETE from home_categories_top_banner_list WHERE id=?");
        //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
        $stmt->bind_param('i', $ids);
        $conn->set_charset("utf8");
        $stmt->execute();
        echo "1";

    }

}

function clean($string) {
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

	return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

function get_product_img($productid){
    $conn=dbconnection();
    $stmt ="SELECT DISTINCT `img_link` FROM `tbl_productImg` where img_iden='thumbIMG' AND product_Id='$productid' ";
    $result=mysqli_query($conn,$stmt);
    if ($result=mysqli_query($conn,$stmt))
    {
        while ($row=mysqli_fetch_row($result))
        {
            return $row[0];
        }
    }

}

function editGiftVoucherValue($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id`, `voucher_name`, `voucher_amount`,`expires_on` FROM `tbl_gift_list`  WHERE id = ? ")) {
		// Bind the variables to the parameter as strings.
		$edit_id     = mysqli_real_escape_string($conn,$edit_id);
		$stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$conn->set_charset("utf8");
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
			$stmt->bind_result($id,$voucher_name,$amount,$expiry_date);
			$rows=[];
			while ($row = $stmt->fetch()) {
				$rows['id']             	= $id;
				$rows['name']              = $voucher_name;
				$rows['amount']     = $amount;
				$rows['expiry_date']     = $expiry_date;
			}
			return $rows;
		} else {
			return FALSE;
		}
	}
}
function addGiftVoucher(){

    $conn=dbconnection();

    $command      = mysqli_real_escape_string($conn,$_POST['command']);
    $gift_voucher_name    = mysqli_real_escape_string($conn,$_POST['gift_voucher_name']);
    $gift_voucher_amount    = mysqli_real_escape_string($conn,$_POST['gift_voucher_amount']);
    $expiry_date    = mysqli_real_escape_string($conn,$_POST['expiry_date']);
    $editid       = mysqli_real_escape_string($conn,$_POST['editid']);
    $ex_date = date('Y-m-d H:i:s', strtotime($expiry_date));
    //echo '<script type="text/javascript"> console.log('.$command.');</script>';
    if($command=="addGiftVoucher"){

        if($editid!=""){

            $stmt = "UPDATE tbl_gift_list 
                    SET voucher_name='$gift_voucher_name',voucher_amount='$gift_voucher_amount',expires_on='$ex_date'
                    WHERE id=$editid";
            if($conn->query($stmt))
                echo "1";
            else
                echo "0";
        }else{
            $stmt = "INSERT INTO tbl_gift_list (`voucher_name`,`voucher_amount`,`expires_on`)
                      VALUES ('$gift_voucher_name','$gift_voucher_amount','$ex_date')";
            $conn->set_charset("utf8");
            $conn->query($stmt);
            echo "1";
        }

    }

}
function DeleteGiftVoucher(){

    $conn=dbconnection();
    $command      = mysqli_real_escape_string($conn,$_POST['command']);
    $ids          = mysqli_real_escape_string($conn,$_POST['Ids']);

    if($command=="DeleteGiftVoucher"){

        $stmt = $conn->prepare("DELETE from tbl_gift_list WHERE id=?");
        //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
        $stmt->bind_param('i', $ids);
        $conn->set_charset("utf8");
        $stmt->execute();
        echo "1";

    }

}
function DeleteProductList(){

	$conn=dbconnection();
	$command      = mysqli_real_escape_string($conn,$_POST['command']);
	$ids          = mysqli_real_escape_string($conn,$_POST['Ids']);

	if($command=="DeleteProductList"){

		$stmt = $conn->prepare("DELETE from tbl_products WHERE ProductID=?");
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$stmt->bind_param('i', $ids);
		$conn->set_charset("utf8");
		$stmt->execute();
		echo "1";

	}

}
function editMobileImageValue($edit_id){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id`, `category_id`, `image_link`, `status` FROM `tbl_mobile_images` WHERE id=? ")) {
		// Bind the variables to the parameter as strings.
		$stmt->bind_param("i", $edit_id);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
			$stmt->bind_result($id,$category_id,$image_link,$status);
			$rows=[];
			while ($row = $stmt->fetch()) {
				$rows['id'] 	     = $id;
				$rows['category_id']       = $category_id;
				$rows['image_link']   = $image_link;
				$rows['status']   = $status;
			}
			return $rows;
		} else {
			return FALSE;
		}
	}
}
function getCatgoryTypeName($cat_id){
    $conn=dbconnection();
    if ($stmt = $conn->prepare("SELECT  `category_name`,`cat_type_id` FROM `tbl_category` WHERE category_id = ? ")) {
        // Bind the variables to the parameter as strings.
        $stmt->bind_param("i", $cat_id);
        // Execute the statement.
        $stmt->execute();
        $stmt->store_result();
        $numRows = $stmt->num_rows;
        if($numRows>0){
            $stmt->bind_result($category_name,$cat_type_id);
            $data=[];
            while ($row = $stmt->fetch()) {
                $data['cat_name']=$category_name;
                if($cat_type_id==1)
                    $data['cat_type']='Brand New';
                else
                    $data['cat_type']='Factory Refurbs';
            }
            return $data;
        } else {
            $data['cat_name']="";
            $data['cat_type']="";
            return $data;
        }
    }
}
?>