<link href='<?php echo base_url(); ?>assets/frontend/css/virtual.css' rel='stylesheet' media="screen">
<link href='<?php echo base_url(); ?>assets/frontend/css/common.css' rel='stylesheet' media="screen">

<article class="container theme-container">
  <div class="row justify-content-around mt-4">
    <div class="col-lg-2 col-md-6 col-sm-12 row align-items-end justify-content-around">
      <img src="<?php echo base_url('assets/admin/images/') ?>wallet.svg">
    </div>
    <div class="col-md-8 col-sm-12 row justify-content-center row align-items-end m-md-4 m-lg-0 m-sm-4 sm-space">
      <div class="data-cards mx-2 sm-space">
        <h3 class="text-light text-center p-4 bolder"><?php echo lang('aUsed_Amount'); ?></h3>
        <h3 class="text-light text-center p-2 bolder"><?php echo $user_account_details['balance'] ?></h3>
      </div>
      <div class="data-cards mx-2 sm-space">
        <h3 class="text-light text-center p-4 bolder"><?php echo lang('aLocked_Amount'); ?></h3>
        <h3 class="text-light text-center p-2 bolder"><?php echo $used_balance ?></h3>
      </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-12 row align-items-end justify-content-end justify-content-around">
      <a class="product-item-price btn btn-solid float-right" href="<?php echo base_url($language . '/my_account/withdraw') ?>"><?php echo lang('awithdraw'); ?></a>
    </div>
  </div>
  <div class="account-box  light-bg default-box-shadow recv_invoicas mt-3" style="padding: 2px 2px;background:white;margin-top:0px">
    <div class="top_pading_sec">
      <table class="tabl_tr_th" style="margin-top: 0px; margin-bottom: 20px; ">
        <thead>
          <tr>
            <th colspan="1">
              <?php echo lang('SN'); ?>
            </th>
            <th>
              <?php echo lang('aDescription'); ?>
            </th>
            <th>
              <?php echo lang('Date'); ?>
            </th>
            <th>
              <?php echo lang('aAmount'); ?>
            </th>
            <th>
              <?php echo lang('Payment_Method'); ?>
            </th>
          </tr>
        </thead>
        <tbody id="table_body">
        <?php $count = 1;
         foreach($data as $key=>$value)
        { ?>
          <tr class="remove">
            <td colspan="1" class="sn1">
              <?php echo($count++); ?>
            </td>
            <td class="sn3">
              <?php echo $value['payment_note'] ?>
            </td>
            <td class="sn3">
              <?php echo substr($value['created_at'], 0, 10) ?>
            </td>
            <td class="sn3">
              <?php echo $value['amount'] ?>
            </td>
            <td class="sn5">
              <?php echo $value['transaction_type'] ?>
            </td>
          </tr>

          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</article>