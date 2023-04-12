

<div class="container" style="text-align: center;margin-top: 10%;margin-bottom: 12%;">
   <br>
   <?php if(isset($message)) { ?>
    <p class="ops_page" ><?php echo $message; ?></p>
   <?php }else{  ?>
   	<p class="ops_page" >Success, <br>
	Your password changed successfully.</p>
   <?php } ?>

</div>



<style>


.ops_page {
    font-size: 20px;
    color: #979797;
}

</style>

