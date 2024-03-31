<?php echo $form->messages();
$name = $item_priority = '';

if (isset($edit)) {
    $name = $edit['name'];
    $item_priority = $edit['item_priority'];
} else {
    $deactive = 'checked';
}


?>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <!-- <h3 class="box-title">User Info</h3> -->
            </div>
            <form id="form" name="form" method="post">
                <div class="box-body">
                    <!-- <?php echo $form->open(); ?> -->
                    <input type="text" name="name_a" id="name_a" class="form-control"
                           placeholder="Attribute Name">
                    <br>
                    <input type="text" name="item" id="item" class="form-control"
                           placeholder="item_priority">
                    <br>
                    <input type="reset" class="btn btn-default" name="add" id="add"
                           value="ADD">
                </div>
                <br>
                <!-- <?php echo $form->close(); ?> -->
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Attribute name</th>
                        <th>priority</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <?php echo $form->bs3_submit(); ?>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $('#add').click(function (e) {

        //alert('success');
        e.preventDefault();
        // var newName = $('form').find('input[id="name_a"]').val();
        // var item_p = $('form').find('input[id="item"]').val();

        var newName = $("#name_a").val();
        var item_p = $("#item").val();

        if (newName == '') {
            swal('', "Enter newName");
        } else if (item_p == '') {
            item_p('', "item_p name");
        } else {

            $('tbody').append('<tr><td><input type="text" name="name[]" id="name" value="' + newName + '" class="form-control"> </td> <td><input name="item_priority[]" id="item_priority" value="' + item_p + '" class="form-control" type="text" ></td></tr>')
        }
    });

    $('#add').click(function () {
        $('#name_a').val('');
        $('#item').val('');

    });


    jQuery('body').on({'drop dragover dragenter': dropHandler}, '[data-image-uploader]');
    jQuery('body').on({'change': regularImageUpload}, '#file');
</script>
