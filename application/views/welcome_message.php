<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Shopping cart</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
rel="stylesheet" id="bootstrap-css">
</head>
<body>
<style>
.catalog-grid .tile .price-label {
    position: absolute;
    padding: 5px;
    height: 32px;
    background: #ffc107;
    top: 0;
    right: 0;
   
    color: #fff;
   
}

</style>
<div class="container" style="padding:20px 0px 20px 0px;" >
<h2 class="title">Prodcuts</h2>
<a class="btn btn-primary pull-right" href="<?php echo base_url('cart'); ?>" >
    <span>
      Cart ( <span class="cartcount"><?php echo count($this->cart->contents());  ?></span> )
    </span>
</a>
</div>


<div class="container catalog-grid">
<div class="row">
      <?php 
	  //print_r($products);
      if(isset($products) && is_array($products) && count($products)){
      $i=1;
      foreach ($products as $key => $data) { 
      ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="tile" style="border: 1px solid #b2b2b2; position: relative;">
            <div class="price-label price<?php echo $data['id'] ?>" 
rel="<?php echo $data['price'] ?>">INR <?php echo $data['price'] ?></div>
            <img class="image<?php echo $data['id'] ?>" rel="<?php echo $data['image'] ?>" 
src="<?php echo base_url(); ?>images/<?php echo $data['image'] ?>" 
alt="<?php echo $data['id'] ?>">
            <span class="tile-overlay"></span>
          <div class="footer" style="padding:12px">
            <strong><p class="name<?php echo $data['id'] ?>" 
rel="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></p></strong>
<p><?php echo $data['short_description'] ?> </p>
            <button class="btn btn-primary" 
onclick="javascript:addtocart(<?php echo $data['id'] ?>)">Add to Cart</button>
          </div>
        </div>
      </div>
      <?php
        $i++;
          } }
        ?>
</div>
</div>


<script type="text/javascript">
    function addtocart(p_id)
    {
        var price = $('.price'+p_id).attr('rel');
        var image = $('.image'+p_id).attr('rel');
        var name  = $('.name'+p_id).text();
        var id    = $('.name'+p_id).attr('rel');
            $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('welcome/add');?>",
                    data: "id="+id+"&image="+image+"&name="+name+"&price="+price,
                    success: function (response) {
                       $(".cartcount").text(response);
                    }
                });
    }




</script>



</body>
</html>