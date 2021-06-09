<head>
<meta charset="utf-8">
<title>Cart</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
rel="stylesheet" id="bootstrap-css">
</head>
<style>
.quantity {
    display: inline-block;
    width: 36px;
    height: 38px;
    margin: 0 2px;
    padding-left: 3px;
    padding-right: 3px;
    text-align: center;
}
.thumb img {
    width: 25%;
}
</style>
<div class="container">
<div class="">


<div class="col-lg-12 col-md-12">
    <h2 class="title">Shopping cart</h2>
    <table class="items-list col-lg-12 col-md-12 table-hover">
        <tbody>
        <tr>
        <th>&nbsp;</th>
        <th>Product name</th>
        <th>Product price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Delete</th>
      </tr>
      <!--Item-->
      <?php 
        if(isset($cart) && is_array($cart) && count($cart)){
        $i=1;
        foreach ($cart as $key => $data) { 
        ?>
      <tr class="item first rowid<?php echo $data['rowid'] ?>">
        <td class="thumb">
           <img src="<?php echo base_url(); ?>/images/<?php echo $data['image'] ?>" 
                                                alt="<?php echo $data['id'] ?>">
        </td>
        <td class="name"><?php echo $data['name'] ?></td>
        <td class="price">INR 
            <span class="price<?php echo $data['rowid'] ?>"><?php echo $data['price'] ?>
            </span>
        </td>
        <td class="qnt-count">
          <input class="quantity qty<?php echo $data['rowid'] ?> form-control" 
                              type="number" min="1" value="<?php echo $data['qty'] ?>">
          <span class="Update" 
         onclick="javascript:updateproduct('<?php echo $data['rowid'] ?>')">Update</span>
        </td>
        <td class="total">INR <span class="subtotal subtotal<?php echo $data['rowid'] ?>">
                                            <?php echo $data['subtotal'] ?></span></td>
        <td class="delete"><i class="icon-delete" 
           onclick="javascript:deleteproduct('<?php echo $data['rowid'] ?>')">X</i></td>
      </tr>

      <?php
        $i++;
          } }
      ?>
     
      <tr class="item">
        <td class="thumb" colspan="4" align="right">&nbsp;</td>
        <td class="">INR <span class="grandtotal">0</span> </td>
        <td>&nbsp;</td>
      </tr>
    </tbody></table>
  </div>

<button type="button" class="btn btn-default" onclick="javascript:deleteproduct('all')">
                                                    Clear Cart</button>
<a href="<?php echo site_url('checkout') ?>">
      <button type="button" class="btn btn-primary">Place Order</button>
</a>

</div>
</div>
</div>



<script type="text/javascript">
function deleteproduct(rowid)
{
var answer = confirm ("Are you sure you want to delete?");
if (answer)
{
$.ajax({
      type: "POST",
      url: "<?php echo site_url('welcome/remove');?>",
      data: "rowid="+rowid,
      success: function (response) {
          $(".rowid"+rowid).remove(".rowid"+rowid); 
          $(".cartcount").text(response);  
          var total = 0;
          $('.subtotal').each(function(){
              total += parseInt($(this).text());
              $('.grandtotal').text(total);
          });              
      }
  });
}
}

var total = 0;
$('.subtotal').each(function(){
total += parseInt($(this).text());
$('.grandtotal').text(total);
});


function updateproduct(rowid)
{
var qty = $('.qty'+rowid).val();
var price = $('.price'+rowid).text();
var subtotal = $('.subtotal'+rowid).text();
$.ajax({
  type: "POST",
  url: "<?php echo site_url('welcome/update_cart');?>",
  data: "rowid="+rowid+"&qty="+qty+"&price="+price+"&subtotal="+subtotal,
  success: function (response) {
          $('.subtotal'+rowid).text(response);
          var total = 0;
          $('.subtotal').each(function(){
              total += parseInt($(this).text());
              $('.grandtotal').text(total);
          });     
  }
});
}


</script>