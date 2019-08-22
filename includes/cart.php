<?php
$viewCarts =  viewCart();
$shipping_cost="0";
$total = 0; //set initial total value
?>
  <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Cart</a>
               </div>
            </div>
         </div>
      </section>
      <section class="cart-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-body cart-table">
                     <div class="table-responsive">
                        <table class="table cart_summary">
                           <thead>
                              <tr>
                                 <th class="cart_product">Product</th>
                                 <th>Description</th>
                                 <th>Avail.</th>
                                 <th>Unit price</th>
                                 <th>Qty</th>
                                 <th>Total</th>
                                 <th class="action"><i class="mdi mdi-delete-forever"></i></th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php  foreach($viewCarts['allresult'] as $viewCartsRow){
                       $subtotal = ($viewCartsRow->ProductPrice * $viewCartsRow->quantity); //calculate Price x Qty 
                       $productname = productname($viewCartsRow->productId);
                       
                       ?>
                       
                              <tr>
                                 <td class="cart_product"><a href="<?php echo SITE_URL; echo $productname['product_alis_link']; ?>"><img class="img-fluid" src="<?php echo SITE_URL;?><?php echo $viewCartsRow->productImg; ?>" alt=""></a></td>
                                 <td class="cart_description">
                                    <h5 class="product-name"><a href="<?php echo SITE_URL; echo $productname['product_alis_link']; ?>"> <?php echo $productname['Title']; ?> </a></h5>
                                    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php $weight=$viewCartsRow->weight; if($weight!=""){echo $weight; } ?></h6>
                                 </td>
                                 <td class="availability in-stock"><span class="badge badge-success">In stock</span></td>
                                 <td class="price"><span>Rs. <?php echo amountformat($viewCartsRow->ProductPrice); ?>.00</span></td>
                                 <td class="qty">
                                    <div class="input-group">
                                    <?php echo $viewCartsRow->quantity; ?>
                                       <!-- <span class="input-group-btn"><button disabled="disabled" class="btn btn-theme-round btn-number" type="button">-</button></span>
                                       <input type="text" max="10" min="1" value="1" class="form-control border-form-control form-control-sm input-number" name="quant[1]">
                                       <span class="input-group-btn"><button class="btn btn-theme-round btn-number" type="button">+</button> -->
                                       </span>
                                    </div>
                                 </td>
                                 <td class="price"><span>Rs. <?php echo amountformat($subtotal); ?>.00</span></td>
                                 <td class="action">
                                    <a class="btn btn-sm btn-danger" data-original-title="Remove" href="javascript:void(0);" onclick="DeleteCartProduct('<?php echo $viewCartsRow->productId; ?>');" title="" data-placement="top" data-toggle="tooltip"><i class="mdi mdi-close-circle-outline"></i></a>
                                 </td>
                              </tr>
                           <?php 
                                $total = ($total + $subtotal); //add subtotal to total var 
                           }
                           $grand_total = $total + $shipping_cost; //grand total including shipping cost

                           ?>
                             
                           </tbody>
                           <tfoot>
                              <!-- <tr>
                                 <td colspan="1"></td>
                                 <td colspan="4">
                                    <form class="form-inline float-right">
                                       <div class="form-group">
                                          <input type="text" placeholder="Enter discount code" class="form-control border-form-control form-control-sm">
                                       </div>
                                       &nbsp;
                                       <button class="btn btn-success float-left btn-sm" type="submit">Apply</button>
                                    </form>
                                 </td>
                                 <td colspan="2">Discount : $237.88 </td>
                              </tr>
                              <tr>
                                 <td colspan="2"></td>
                                 <td class="text-right"  colspan="3">Total products (tax incl.)</td>
                                 <td colspan="2">$437.88 </td>
                              </tr> -->
                              <!-- <tr>
                                 <td class="text-right" colspan="5"><strong>Total</strong></td>
                                 <td class="text-danger" colspan="2"><strong>$337.88 </strong></td>
                              </tr> -->
                           </tfoot>
                        </table>
                     </div>
                     <?php
                     $login_status = loginStatus();
                     if($login_status=="EmptySession"){
                     ?>
                        <a href="#" data-target="#bd-example-modal" data-toggle="modal" class="btn btn-link"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>Rs. <?php echo amountformat($grand_total); ?>.00</strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
                     <?php }else{ ?>
                        <a href="<?php echo SITE_URL; ?>checkout"  class="btn btn-link"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>Rs. <?php echo amountformat($grand_total); ?>.00</strong> <span class="mdi mdi-chevron-right"></span></span></button></a>

                     <?php } ?>
                     <a href="checkout"></a>
                  </div>
               </div>
            </div>
         </div>
      </section>
     