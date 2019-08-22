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
 
	$query = "SELECT `id`, `cat_type_id`, `img`, `descr`, `order_by` FROM `main_Home_slider` WHERE 1";
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
		$img              = $result['img'];
	    $cat_type_id      = $result['cat_type_id'];
		$descr 	          = $result['descr'];
		$order_by         = $result['order_by'];
		?>
		<div class="HomeSliderAlign">
		<div class="ImgAligns">
		<img style="width:auto;height:160px;"  src="<?php echo $siteUrl."".$img;?>" />
		</div>
		<div>
		<div class="descTxt"><?php echo  htmlspecialchars_decode(stripslashes($descr)); ?></div>

		
		
	
		
		<a href="add_home_slider_list.php?editid=<?php echo $id; ?>" class="aAlignRight"><button title="edit file" class="kv-file-upload btn btn-xs btn-default" type="button"><i class="glyphicon glyphicon-edit text-info"></i></button></a>
		<button title="Remove file" class="kv-file-remove btn btn-xs btn-default" type="button" onclick="deletehomesliderImgs('<?php echo $id; ?>');"><i class="glyphicon glyphicon-trash text-danger"></i></button>
		

		</div>
		</div>
                             
<?php $i++;
} ?>
	</div>
	</div>
<div class="clearfix"></div>    
<div class="file-preview-status text-center text-success"></div>
<div class="kv-fileinput-error file-error-message" style="display: none;"></div>
</div>
<?php
echo paginatemainslidersList($reload, $page, $total_pages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst);
} else {
  echo "Sorry, no results matched your search criteria.";
}
?>

<?php 
}
}
?>
