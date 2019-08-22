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
	//$conn->set_charset("utf8");
	//mysqli_query($conn,"SET NAMES utf8"); 
    $query = "SELECT `category_id`, `category_name`, `cat_alias`, `parent_id`, `level`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `sort_order`, `created_on` FROM `tbl_category`";
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
          <th>category name</th>
          <th>parent id</th>
					<th>Upload Image</th>
          <!-- <th>Client</th> -->
          <th>meta title</th>
          <!-- <th>Price</th> -->
          <th>meta keyword</th>
          <th>meta description</th>
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
		$category_id      = $result['category_id'];
		$category_name    = $result['category_name'];
	    $parent_id        = mysqli_real_escape_string($conn,$result['parent_id']);
		$meta_title	      = mysqli_real_escape_string($conn,$result['meta_title']);
		$meta_keyword     = $result['meta_keyword'];
		$meta_description = $result['meta_description'];
		$sort_order       = $result['sort_order'];
		if($parent_id=="0"){
			$cat_links_edits = "add_main_categories.php";
		}else{
			$cat_links_edits = "add_sub_categories.php";
		}
		?>
                                <tr>
                                  <td><?php echo $category_id; ?></td>
                                  <td><?php echo htmlentities($category_name); ?></td>
                                  <td><?php echo $parent_id; ?></td>
                                  <td><a href="category_image_upload.php?editId=<?php echo $category_id; ?>">Image upload and edit</a></td>
                                  <td><?php echo $meta_title; ?></td>
                                  <!-- <td>$1500</td> -->
                                  <td><?php echo $meta_keyword; ?></td>
                                  <td><?php echo $meta_description; ?></td>
                                  <!-- <td><span class="badge badge-info"><?php echo $sort_order; ?></span></td>-->
                                    <td><a href="<?php echo $cat_links_edits; ?>?editId=<?php echo $category_id; ?>">Edit</a> | <a href="javascript:void(0);" onclick="deleteCategory(<?php echo $category_id; ?>);">Delete</a></td>
                              </tr>
                             
                             
                            
                         
                     
		
<?php $i++;
} ?>
 </tbody>
 </table>
</div>
<?php
echo paginateAllCategoryList($reload, $page, $total_pages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst);
} else {
  echo "Sorry, no results matched your search criteria.";
}
?>

<?php 
}
}
?>
