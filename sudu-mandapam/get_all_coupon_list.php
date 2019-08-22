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
     
	$query = "SELECT `id`, `coupon_code`,`discount`, `start_date`,`expiry_date`, `status` FROM `tbl_coupon` where id!='' order by id ASC";
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
          <th>Coupon Code</th>
          <th>Discount(%) </th>
          <th>Start Date</th>
          <th>Expiry Date</th>
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
		$coupon_code            = $result['coupon_code'];
		$discount  				=$result['discount'];
		$start_date             = $result['start_date'];
		$expiry_date	 		=$result['expiry_date'];
		$status          		= $result['status'];
	    $id               		= $result['id'];
		
		?>
        <tr>
          <td><?php echo $i; ?></td>
           <td><?php echo $coupon_code; ?></td>
           <td><?php echo $discount; ?></td>
           <td><?php echo $start_date; ?></td>
          <td><?php echo $expiry_date; ?></td>
          <td><?php 
          if($status=="0"){
		  	echo "Active"; 
		  }else{
		  	echo "DeActive"; 
		  }
          
          
          ?></td>
          <td> <a href="add_coupon.php?editId=<?php echo $id; ?>">Edit</a> </td>
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
