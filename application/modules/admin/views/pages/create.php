<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div style="text-align: right;">
    <a class="service-image" href="<?php echo base_url('admin/pages'); ?>">
        <button type="submit" class="btn btn-success">Back to list</button>
    </a>
</div>
<?php echo $form->messages();
$title = $active = $editor = $date_of_publish = '';
if (isset($edit)) {
    $title = $edit['title'];
//$myimage = $edit['image'];
    $active = $edit['status'] == 'active' ? 'checked' : '';
    $deactive = $edit['status'] == 'deactive' ? 'checked' : '';
    $editor = $edit['editor'];
    $date_of_publish = $edit['date_of_publish'];
} else {
    $deactive = 'checked';
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <!-- 	<h3 class="box-title">Title</h3> -->
            </div>
            <div class="box-body">
                <?php echo $form->open(); ?>
                <div class="form-group">
                    <label for="groups">Title</label>
                    <div>
                        <?php echo $form->bs3_text('title', 'title', $title, array('required' => '')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="groups">Status</label>
                    <div>
                        <?php echo $form->bs3_radio('Active', 'status', 'active', array('required' => ''), $active); ?>
                        <?php echo $form->bs3_radio('Deactive', 'status', 'deactive', array('required' => ''), $deactive); ?>

                    </div>
                </div>
                <div class="form-group">
                    <label for="groups">Date Of Publish</label>
                    <div>
                        <?php echo $form->bs3_text('Date Of Publish', 'date_of_publish', $date_of_publish, array('' => '')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="groups">Editor</label>
                    <div>
                        <textarea name="editor"
                                  id="ckeditor2"><?php echo $editor; ?> </textarea>
                    </div>
                </div>


                <br><br><br>
                <?php echo $form->bs3_submit(); ?>

                <?php echo $form->close(); ?>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(function () {
        CKEDITOR.replace('ckeditor2');
        CKEDITOR.config.height = 300;
    });
    $("#date_of_publish").datepicker({dateFormat: 'dd-mm-yy'});
</script>
