<?php $all_reviews1=json_decode($_REQUEST['data']);
    $all_reviews=json_decode(json_encode($all_reviews1), True);
?>

<?php if (empty(!$all_reviews)) {?>
    <div class="">
        <?php foreach($all_reviews as $rowCategories ) {?>

            <div class="row" style="border-bottom: 1px #e5e5e5 solid;">
                <div class="col-md-4">
                    <div> <?php echo $rowCategories['user_name']."<br>";?></div>
                    <div>  <?php echo date("M d, Y", strtotime($rowCategories['rating_date']));?></div>

                </div>
                <div class="col-md-6"><ul class="testimonials-rating_1">
                        <?php for($x=1;$x<=$rowCategories['ratings'];$x++) {
                            echo '<li><i class="fa fa-star fa_custom"></i></li>';
                        }
                        if (strpos($rowCategories['ratings'],'.')) {
                            echo '<li><i class="fa fa-star-half fa_custom"></i></li>';
                            $x++;
                        }
                        while ($x<=5) {
                            echo '<li><i class="fa fa-star-o fa_custom"></i></li>';
                            $x++;
                        } ?>
                        <li style="margin-left: 10px;font-size: 14px;"><?php echo $rowCategories['review_subject'];?></li>
                    </ul>

                    <div style="margin-left: 56px;"><?php echo trim($rowCategories['review']) ;?></div>
                </div>
            </div>

        <?php } ?>
    </div>
<?php }
else{
    echo "no reviews available";
}
?>