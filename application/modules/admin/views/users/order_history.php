<div class="col-md-12" style="float: right;    margin-bottom: 0px;    height: 10px; margin-top: -10px;">
      <a href="<?php echo base_url($language) ?>/admin/users" class="back_button">Back to list</a>
</div>

<br>


<div class="container" style="margin: 0px; padding: 0; " >
    <div class="row">
         <div class="col-sm-2 col-md-2">
          <?php if (!empty($data['logo'])) { ?>
           <img src="<?php echo base_url('assets/admin/usersdata'); ?>/<?php echo $data['logo']; ?>"
            alt="" class="img-rounded img-responsive" />
           <?php } else{ ?>
           <img src="https://affordableamericaninsurance.com/wp-content/uploads/2017/04/no-image-icon-hi.png"
            alt="" class="img-rounded img-responsive" />
          <?php  } ?>
            
        </div> 
        <div class="col-sm-4 col-md-4">
                <p style="    line-height: 30px;" ><?php echo $data['first_name']; ?><br>
                <i class="glyphicon glyphicon-map-marker"></i> <?php echo $data['social']; ?> Registration
                <br>             
                <i class="glyphicon glyphicon-envelope"></i> <?php echo $data['email']; ?>

                <?php if ($data['type'] == 'driver' || $data['social'] != 'gmail' ): ?>
                  
                <br/><i class="glyphicon glyphicon-phone"></i> <?php echo $data['phone']; ?>
                <?php  if(!empty($data['registration_number'])){ ?>
                <br/><i class=""></i>Registration number :-  <?php echo $data['registration_number']; ?>                
                <?php } ?>
                <?php  if(!empty($data['vehicle_type'])){ ?>
                <br/><i class=""></i>Vehicle type  :-  <?php echo $data['vehicle_type']; ?>
              <?php } ?>
              <?php  if(!empty($data['address'])){ ?>
                <br/><i class=""></i>Address  :-  <?php echo $data['address']; ?>
              <?php } ?>
                <!-- <br/><i class="glyphicon glyphicon-gift"></i> January 30, 1974 <br> --><br>
                <?php endif ?>
              </p>



        </div>
       
    </div>
</div>

<style type="text/css">
  .ul_class {padding-left: 18px;margin: 0;font-size: .9em;color: #626A73;
    margin-top: 10px;}
</style>


<div class="row">
    <div class="col-sm-6 col-md-12" style=" margin-left:;font-size: 12px;margin-top: 5px;">
         <div id="container">
            <?php if (!empty($products)): ?>
            	<h4>Total order details ( <?php echo count($products) ?> ) <a class="btn btn-info" href="<?php echo base_url($language.'/admin/users/user_detail/').$data['id']; ?>">User Details</a> </h4>
            <?php endif ?>
            
            <?php foreach ($products as $key => $value) { ?>

            <div class="col-sm-3 comment">
              <div class="padd">
             <!--  <a data-id="<?php echo $value['order_master_id'] ; ?>"  class="delete-complaint" style="float: right; color: red;"><i class="material-icons" style="font-size:20px">visibility</i></a> -->

              

              <!--  <?php if (!empty($value['product_image'])) { ?>
               <a target="_blank" href="<?php echo base_url("admin/product/edit/") ?><?php echo $value['id'] ?>">
               <img src="<?php echo base_url("assets/admin/products/") ?><?php echo $value['product_image'] ?>" class="photo">
               </a>
               <?php } ?>
               <?php if (empty($value['product_image'])) { ?>
               <img src="https://pbs.twimg.com/profile_images/506813173220257792/VcRwhqNo_400x400.jpeg" class="photo">
               <?php } ?> -->
               <div class="comment-text">

                  <a target="_blank" href="orders/view/<?php echo $value['order_master_id'] ; ?>"  class=" asd" style="float: right; color: red;"><i class="material-icons" style="font-size:20px">visibility</i></a>

                  <p style="font-size: 1.1em; margin-top: 20px" class="text-left"><strong>Address : </strong><br><?php echo $value['address_1'] ?></p>


                  <p style="font-size: 1.1em; margin-top: 20px" class="text-left"><strong>Order Date Time: 

                    </strong><br><span style="font-size: 1.1em;" class="time"> <?php $value['order_datetime'] = date('F j, Y  , g:i a' ,strtotime($value['order_datetime']));
                        echo $value['order_datetime'];  ?></span> 
                  </p>

                  <p style="font-size: 1.1em; margin-top: 20px" class="text-left short_desc"><strong>Order id : </strong><br><?php echo $value['display_order_id'] ?></p>

                  <p style="font-size: 1.1em; margin-top: 20px" class="text-left">
                  <strong class="str">Order  Status : 
                    <?php if($value['order_status']=='Delivered'){ ?>
                    <span class="btn btn-success"><?php echo $value['order_status']; ?></span> 
                  <?php }else if($value['order_status']=='canceled') { ?>
                    <span class="btn btn-danger"><?php echo $value['order_status']; ?></span> 
                  <?php }else{ ?>
                    <span class="btn btn-info"><?php echo $value['order_status']; ?></span>
                  <?php } ?>
                  </strong>
                  
                  </p>

                  <?php if (!empty($value['order_item'])): ?>
                    <?php foreach ($value['order_item'] as $skey => $vdalue): ?>
                      
                      <p style="font-size: 1.1em; margin-top: 20px" class="text-left"><strong>Product name / Qty / Price : 

                        </strong><br><span style="font-size: 1.1em;" class="time"><?php echo $vdalue['product_name']; ?></span> 
                        </strong><br><span style="font-size: 1.1em;" class="time"><?php echo $vdalue['quantity']; ?></span> 
                        </strong><br><span style="font-size: 1.1em;" class="time"><?php echo $vdalue['price']; ?></span> 
                      </p>
                    <?php endforeach ?>
                  <?php endif ?>

               </div>
            </div>
            </div>
            <!-- .comment -->
            <?php } ?>



         </div>
         <!-- #container -->
      </div>

	<div class="imga" style="width: 50%; margin: 0px auto;">
		<?php if (empty($products)): ?>
			<img src="https://www.livekingdomhall.com/public/images/empty-cart.jpg">
		<?php endif ?>

	</div>

</div>

<link href="https://fonts.googleapis.com/css?family=Maitree:300,400,600|Montserrat" rel="stylesheet">

<style type="text/css">
   
    #close {
      width: 14px;
      position: absolute;
      top: 30px;
      right: 30px;
    }

    .comment {
      margin-top: 30px;
      padding: 10px;
    }

    .photo {
      width: 60px;
      height: 60px;
      border: 2px solid;
      border-radius: 100%;
      float: left;
      margin-right: 20px;
    }

    .comment-text {
      width: 100%;
      float: left;
      /*margin-top: 20px;*/
    }

    .name {
      margin: 0;
       
      font-size: .9em;
      color: #2C3137;

     margin-bottom: 15px;
      font-weight: 600;
    }

    .time {
      margin: 0;
       
      font-size: .8em;
      color: #a0a0a0;
      padding-left: 20px;
      font-weight: 400;
      background-image: url("https://upload.wikimedia.org/wikipedia/commons/thumb/f/fd/Location_dot_grey.svg/500px-Location_dot_grey.svg.png");
      background-repeat: no-repeat;
      background-size: 4px;
      background-position: top 8px left 5px;
    }

    p {
      margin: 0;
       
      font-size: 16px;
      color: #234162;
    }

    /* To clear the div Clearfix, I am using the nth child from 2nd div onwards. */
    .comment:nth-child(n+2):after {
        display: block;
        content: " ";
        clear: both;
        }

    .padd:hover {
      background: #eaeaea;
      border-radius: 5px;
    }

    b, strong {
        font-weight: bold;
        color: #2a274b;
        margin-bottom: 5px;
    }
    a.asd{

    position: relative;
    width: 10%;
    float: right;
    }
</style>


<!-- delete functionality using Ajax functionality -->
<script type="text/javascript">
    $(document).on("click",".delete-complaint",function()
    {
        // alert("The clicked.");
        var type = 'complaint';
        var id = $(this).data('id');
        delete_requests(id, type);
        // alert(id);
    });
    function delete_requests(id, type)
    {
        swal({
              title: "Are you sure?",
              text: "You want to delete this",
              type: "warning",
              showCancelButton: true,
              closeOnConfirm: false,
              showLoaderOnConfirm: true,
              confirmButtonText: "Yes",
              cancelButtonText: "Cancel",
            },
            function(){
             $.ajax({
                url: "<?php echo base_url('admin/complaint/delete_complaint'); ?>",
                type: "POST",
                data: {id:id, type:type},
                success:function(response){
                    if (response)
                    {
                         swal({  title: "success!",  text: "Deleted Successfully.",  imageUrl: 'https://qph.fs.quoracdn.net/main-qimg-e1f0859025623850e8dd44300a60a872'});
                    }
                    setTimeout(function(){ location.reload(); }, 1500);
                }
            });
        });
    }
</script>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">



<script>
    $.fn.stars = function() {
        return $(this).each(function() {

            var rating = $(this).data("rating");

            var numStars = $(this).data("numStars");

            var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fa fa-star"></i>');

            var halfStar = ((rating%1) !== 0) ? '<i class="fa fa-star-half-empty"></i>': '';

            var noStar = new Array(Math.floor(numStars + 1 - rating)).join('<i class="fa fa-star-o"></i>');

            $(this).html(fullStar + halfStar + noStar);

        });
    }

    $('.stars').stars();
</script>

<style type="text/css">
  .fa {
  display: inline-block;
  font: normal normal normal 14px/1 FontAwesome;
  font-size: inherit;
  color: black;
  font-size: 18px;
  letter-spacing: 2px;
  text-rendering: auto;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  }
  .padd{
  overflow-y: scroll;
  padding: 10px;
  border: 1px solid #cdcdcd; 
  height: 400px;
  min-height: 400px;
  max-height: 800px;
  }
  .str{
  margin-bottom: -10px;
  overflow: hidden;
  display: block;
  }
  a.delete-complaint{
  margin-top: 7px;
  margin-bottom: 13px;
  clear: both;
  display: block;
  cursor: pointer;
  text-decoration: none; 
  }
  .map{

  overflow: hidden;
  padding: 5px;
  padding-bottom: 0px;
  border: 2px solid #cdcdcd;
  }
  .short_desc{
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    line-height: 16px;
    max-height: 65px;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
  }
</style>

