<?php
echo $form->messages();
$title = $description = $image = $category = $sub_cat = $color = $size = $price = '';
if (isset($edit)) {
    $title = $edit['title'];
    $image = $edit['image'];

    $category = $edit['category'];
    $sub_cat = $edit['sub_cat'];

    $color = $edit['color'];
    $size = $edit['size'];
    $price = $edit['price'];

    $description = $edit['description'];

}

?>


<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <!-- 	<h3 class="box-title">Title</h3> -->
            </div>
            <div class="box-body">
                <!--
          <?php if (isset($edit)) {
                    $c_id = $edit['id'];
                    echo "<form action='product/edit/$c_id'  method='post' enctype='multipart/form-data' >";
                } else {
                    echo "<form action='productattribute/create' method='post' enctype='multipart/form-data' >";
                } ?> -->


                <div class="form-group">
                    <label for="groups">Size</label>
                    <div>
                        <input type="text" name="size" value="">
                    </div>
                </div>


                <br><br><br>

                <input class="btn btn-primary" type="submit" value="submit">

                <!--  <?php echo $form->bs3_submit(); ?> -->
                <!-- <?php echo $form->bs3_submit(); ?> -->

                <?php echo $form->close(); ?>
            </div>
        </div>
    </div>

</div>
