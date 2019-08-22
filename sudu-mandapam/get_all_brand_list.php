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
	$per_page = 12;
	/* pagenation lime based on table end */
	//$per_page = 1; //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	// relavent search  null or not condication .
 
	$query = "SELECT SQL_NO_CACHE `id`, `brand`, `brand_img`, `status` FROM `tbl_brands` WHERE 1";
	$query_vals    = mysqli_query($conn,$query);
    $numrows = mysqli_num_rows($query_vals);
    $total_pages = ceil($numrows/$per_page);
	$result_final = mysqli_query($conn,$query. " LIMIT ".$offset.",".$per_page."");
	//loop through fetched data
	if($numrows>0){
	$bgcolor="#EEEEEE"; ?>
	<div class="file-preview">
	<div class="file-preview-thumbnails">
	<div class="file-live-thumbs">
	<?php
	$i=1;
while($result = mysqli_fetch_array($result_final)){
			if($bgcolor=='#EEEEEE'){
			 $bgcolor='#fff';
		}else {
			 $bgcolor='#EEEEEE';
		  }
		$id               = $result['id'];
		$brand            = $result['brand'];
	    $brand_img        = $result['brand_img'];
		$status	          = $result['status'];
		?>
		<div data-template="image" data-fileindex="-1" id="" class="file-preview-frame file-preview-success">
		<div class="kv-file-content">
		<img style="width:auto;height:160px;"  src="<?php echo $siteUrl."".$brand_img;?>" width="270" height="120" />
		</div><div class="file-thumbnail-footer">
		<div title="add.png" class="file-footer-caption"><?php echo $brand; ?></div>
		
	
		<!--<div  class="file-footer-caption errorMSG" id="errorMSG<?php echo $id; ?>">
			
		</div>-->
		<!--<div  class="file-footer-caption">
			<select  id="selcatcat<?php echo $id; ?>" name="selcatcat<?php echo $id; ?>">
			    <option value="1">pease select categories type</option>
				<option value="1">Brand New</option>
				<option value="2">Factory Refurbs</option>
			</select>
		</div>-->
		<!--<div class="file-footer-caption">
		<select multiple="" id="selcat<?php echo $id; ?>" name="selcat<?php echo $id; ?>">
			<?php $queryNew = "SELECT `id`, `categories_id`, `categories_name`, `cats_status` FROM `home_categories_list` WHERE 1";
				$query_catx   = mysqli_query($conn,$queryNew);
				while($resultRows = mysqli_fetch_array($query_catx)){
				 ?>
				  <option value="<?php echo $resultRows['categories_id']; ?>"><?php echo $resultRows['categories_name']; ?></option>
				 <?php } ?>
		</select> 
		</div>-->
		<!--<div class="file-footer-caption">
		   <input type="submit" id="Subcatea" name="Subcatea" value="submit" onclick="CatLised_values(<?php echo $id; ?>);" />
		</div>-->
		
		<div class="file-actions">
		<div class="file-footer-buttons">
		<a href="add_brands_list.php?editid=<?php echo $id; ?>"><button title="edit file" class="kv-file-upload btn btn-xs btn-default" type="button"><i class="glyphicon glyphicon-edit text-info"></i></button></a>
		<button title="Remove file" class="kv-file-remove btn btn-xs btn-default" type="button" onclick="deleteImgs('<?php echo $id; ?>');"><i class="glyphicon glyphicon-trash text-danger"></i></button>
		</div>


		<div class="clearfix"></div>
		</div>
		</div>
		</div>
                             
<?php $i++;
} ?>
	</div>
	</div>
<div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>
							<div class="kv-fileinput-error file-error-message" style="display: none;"></div>
</div>
<?php
echo paginateAllBrandList($reload, $page, $total_pages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst);
} else {
  echo "Sorry, no results matched your search criteria.";
}
?>

<?php 
}
}
?>
