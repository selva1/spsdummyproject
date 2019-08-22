<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
include_once ("include/function.php");

$userId      = $_SESSION['userid'];
$userName    = $_SESSION['userName'];
$resultEmail = $_SESSION['resultEmail'];

isNotLogin();
$conn=dbconnection();	
if($search_val!=""){
 $wherecaseselect = " and fpc.doctor_id='".$search_val."' "; 
}	  
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	/* pagenation lime based on table start */
	$per_page = 10;
	/* pagenation lime based on table end */
	//$per_page = 1; //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	// relavent search  null or not condication .
	 
	
	
	if(!empty($_REQUEST['search_val'])){
		 $search_val=$_REQUEST['search_val'];
		 $cat_idvalue = " and cat_id='$search_val' ";
	}else {
		$search_val="";
		$cat_idvalue = "";
	}
	if(!empty($_REQUEST['str_check'])){
		 $chek_box_val = $_REQUEST['str_check'];
		 $cat_type_idvalue = " and cat_type_id='$chek_box_val' ";
		
		
	}else {
		$chek_box_val="";
		$cat_type_idvalue ="";
	}
     
	$query = "SELECT `id`, `name`, `page_alias`, `meta_title`, `meta_keyword`,`status` FROM `tbl_static_pages` where id!='' order by id ASC";
	 $conn->set_charset("utf8");
	$query_vals    = mysqli_query($conn,$query);
    $numrows = mysqli_num_rows($query_vals);
    $total_pages = ceil($numrows/$per_page);
	$result_final = mysqli_query($conn,$query. " LIMIT ".$offset.",".$per_page."");
	//loop through fetched data
	if($numrows>0){
	$bgcolor="#EEEEEE"; ?>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Page Name</th>
          <th>Page Alias</th>
          <th>Meta Title</th>
          <th>Meta Keyword</th>
          <th>Status</th>
          <th>Action</th>
      </tr>
  </thead>
  <tbody>
	<?php
	$i=1;
while($result = mysqli_fetch_array($result_final)){
			if($bgcolor=='#EEEEEE'){
			 $bgcolor='#fff';
		}else {
			 $bgcolor='#EEEEEE';
		  }
		$name            = $result['name'];
		$page_alias            = $result['page_alias'];
		$meta_title		=$result['meta_title'];
		$meta_keyword	=$result['meta_keyword'];
		$status          = $result['status'];
	    $id               = $result['id'];
		
		?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $name;?></td>
          <td><?php echo $page_alias;?></td>
           <td><?php echo $meta_title; ?></td>
          <td><?php echo $meta_keyword; ?></td>
          <td><?php 
          if($status=="0"){
		  	echo "Active"; 
		  }else{
		  	echo "DeActive"; 
		  }
          
          
          ?></td>
          <td> <a href="add-static-page.php?editId=<?php echo $id; ?>">Edit</a> | <a href="javascript:void(0);" onclick="deletePage(<?php echo $id; ?>);">Delete</a></td>
      </tr>
                             
<?php $i++;
} ?>
 </tbody>
 </table>
</div>
<?php
echo paginateAllcolorList($reload, $page, $total_pages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst);
} else {
  echo "Sorry, no results matched your search criteria.";
}
?>

<?php 
}
}
?>
