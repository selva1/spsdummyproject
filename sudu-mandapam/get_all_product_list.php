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
	 
	//$query = "SELECT SQL_NO_CACHE j.title,j.description,j.date_posted,j.id as job_tb_id, j.industry as industry_id_vals,jp.job_id as apply_id  FROM jobs j LEFT JOIN (  SELECT job_id FROM job_applied  WHERE job_seeker='$user_id') jp  ON j.id=jp.job_id  where  j.id!='' ".$let_indts_whereclause." ".$let_type_whereclause." ".$left_lo_vals_whereclause."  ".$let_ids_po_date_whereclause." ".$Year_of_exp_whereclause." ".$Edu_level_whereclause." ".$salary_range_wherecase." ".$search_query_val." and status='2'  group by  job_tb_id order by date_posted desc ";
	
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
	if(!empty($_REQUEST['searchByName'])){
		$searchByName=$_REQUEST['searchByName'];
		$search_name_query = " and Title like'$searchByName%' ";
	}else {
        $searchByName="";
        $search_name_query = "";
	}
     
	$query = "SELECT SQL_NO_CACHE p.ProductID,p.Title,p.Description,b.Brand as Brands, jp.Color as Color_val,c.category_id,c.category_name FROM tbl_products p 
	LEFT JOIN ( SELECT id,color FROM tbl_colors WHERE id!='') jp ON p.Color=jp.id 
	LEFT JOIN ( SELECT id,brand FROM tbl_brands WHERE id!='') b ON p.Brand=b.id 
	LEFT JOIN ( SELECT category_id,category_name FROM tbl_category WHERE category_id!='') c ON p.cat_id=c.category_id
	 where p.ProductID!=''  ".$cat_idvalue." ".$cat_type_idvalue." ".$search_name_query."  order by p.ProductID desc";
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
          <th>product name</th>
          <th>Image</th>
          <th>Brand</th>
          <th>Color</th>
          <th>Price</th>
<!--          <th>Description</th>
-->          <th>Category name</th>
         <!-- <th>sort order</th>-->
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
		$ProductID        = $result['ProductID'];
		$Title            = $result['Title'];
	    $Description      = $result['Description'];
		$Brand	          = $result['Brands'];
		$Color            = $result['Color_val'];
		$Price            = $result['Price'];
		$sort_order       = $result['sort_order'];
		$category_name           = $result['category_name'];
		
		?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo htmlentities($Title); ?></td>
          <td><a href="products_image_upload.php?editId=<?php echo $ProductID; ?>">Image upload and edit</a></td>
          <td><?php echo $Brand; ?></td>
          
          <td><?php echo $Color; ?></td>
          <td>Rs <?php echo sigleprice($ProductID); ?> .00</td>
          <!-- <td>Steve</td> -->
         <!-- <td><?php 
			$desc_read_more = stripslashes($Description);
			echo strlen($desc_read_more) >= 40 ? 
			substr($desc_read_more, 0, 39) : $desc_read_more; 
           ?> ... <a  class="readmore" href="#" target="_blank">Read more</a></td>-->
          <!-- <td>$1500</td> -->
          <td><?php echo $category_name; ?></td>
          <!-- <td><span class="badge badge-info"><?php echo $sort_order; ?></span></td>-->
            <td><a href="products_full_details.php?editId=<?php echo $ProductID; ?>">View</a>  |
            <a href="add_products.php?editId=<?php echo $ProductID; ?>">Edit</a>
            | <a href="javascript:void(0);" onclick="deleteProduct(<?php echo $ProductID; ?>);">Delete</a></td>
      </tr>
                             
<?php $i++;
} ?>
 </tbody>
 </table>
</div>
<?php
echo paginateAllproductList($reload, $page, $total_pages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst);
} else {
  echo "Sorry, no results matched your search criteria.";
}
?>

<?php 
}
}
?>
