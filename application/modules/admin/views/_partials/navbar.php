<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');
</style>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap');
</style>


<!-- <nav class="navbar">
  <a href="" class="logo"><b><?php echo $site_name; ?></b></a>
  <div class="navbar-header" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="hidden-xs"><?php echo $user->first_name; ?></span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <p><?php echo $user->first_name; ?></p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="panel/account" class="btn btn-default btn-flat">Account</a>
              </div>
              <div class="pull-right">
                <a href="panel/logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
brand-logo      </ul>
    </div>
  </div>
</nav> -->


<!-- <div class="loading">
  <div>
    <div class="spinner-layer pl-light-green">
        <div class="circle-clipper left">
            <div class="circle"></div>
        </div>
        <div class="circle-clipper right">
            <div class="circle"></div>
        </div>
    </div>
  </div>
  <p class="loader-text">Please wait...</p>
</div> -->

<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>


<script type="text/javascript">

  $(window).on('load', function () {
    setTimeout(function () {
      $('body').addClass('loaded');
    }, 90);
  });
</script>


<style type="text/css">
  .slimScrollBar {
    background: #ff375e !important;
    width: 7px !important;
    opacity: 1 !important;
  }
</style>

<!-- Top Bar -->
<nav class="navbar">
  <div class="container-fluid">
    <div class="click_menu_btn">
      <i class="material-icons menu_clas">menu</i>
      <i class="material-icons close_clas">close</i>
    </div>
    <div class="navbar-header">
      <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
        data-target="#navbar-collapse" aria-expanded="false"></a>
      <a href="javascript:void(0);" class="bars"></a>
      <!-- <img style="margin-left: 10px;" src="<?php echo base_url(); ?>assets/admin/images/logo.png" height="50" width="200" > -->
      <a class="navbar-brand  ">
        <!-- <?php echo $site_name; ?> -->
        <img style="margin-left: 10px; width: 190px; margin-top: -10px;"
          src="<?php echo base_url(); ?>assets/admin/images/logo-admin.png">
      </a>
    </div>

    <style type="text/css">
      .notifctn_panel_as {
        width: 320px;
      }

      .notifctn_panel_as li {
        display: inline-block;
        width: 100%;
        margin: 0px;
        float: left;
      }

      .notifctn_panel_as li a {
        width: 100%;
        display: inline-block;
        white-space: normal;
        font-size: 14px;
        line-height: 21px;
        padding: 9px 12px;
        border-bottom: 1px solid #dedede;
        margin: 0px;
        float: left;
      }

      .notfct_titl {
        display: inline-block;
        width: 100%;
        font-size: 15px;
        color: #31a550;
        font-weight: 600;
        margin-bottom: 4px;
      }

      .notfct_date_tim {
        display: inline-block;
        width: 100%;
        float: left;
        text-align: right;
        font-size: 13px;
        margin-top: 5px;
        font-style: italic;
        color: #b3b3b3;
      }

      .dropdown_notfctn {
        padding-bottom: 14px;
        padding-right: 7px;
      }

      .dropdown_notfctn:hover {
        background: #ffffff36;
        cursor: pointer;
      }

      .dropdown.open.dropdown_notfctn {
        background: #ffffff36;
      }

      body {
        background-color: #f8fbfd !important;
        /* font-family: initial; */
      }


      .dashboard .card {
        background: #fff !important;
      }

      .got_ac {
        background: transparent;
        margin: 0px;
        margin-top: 16px !important;
        padding: 9px 15px !important;
        border-radius: 100px;
        letter-spacing: 0px !important;
        text-transform: uppercase;
        font-family: 'Montserrat';
        letter-spacing: 0px;
        font-size: 13px;
        font-weight: 500;
      }

      .toggle_cls {
        height: auto;
        margin-top: 27px;
        cursor: pointer;
      }

      /*li.toggle_menu:after{
  content:"0";
  background: red;
}*/

      .hide_mouse {
        float: left;
        background: red;
        width: 40px;
        height: 13px;
        margin-top: 20px;
        margin-right: -40px;
        z-index: 9999;
        position: relative;
        height: 24px;
        border-radius: 100px;
        cursor: default;
        opacity: 0;
      }

      body.ar .hide_mouse {
        float: left;
        background: red;
        width: 40px;
        height: 13px;
        margin-top: 20px;
        margin-right: -89px;
        z-index: 9999;
        position: relative;
        height: 24px;
        border-radius: 100px;
        cursor: default;
        opacity: 0;
        margin-left: 35px;
      }

      .notifctn_panel_as li {
        display: inline-block;
        width: 100%;
        margin: 0px;
        float: left;
        text-align: center;
      }
    </style>




    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <!-- Call Search -->
        <?php if (!empty($user->group_id == 5 || $user->group_id == 10)) {
          $front_login = false;
          if ($user->group_id == 5) {
            $front_login = true;
          }
          if (!empty($user->access_permission)) {
            $access_permission_arr = explode(',', $user->access_permission);
            if (in_array('buyer_account', $access_permission_arr)) {
              $front_login = true;
            }
          }
          if ($front_login == true) {
            ?>
            <li style=""><a class="got_ac" href="<?php echo base_url($language) ?>"><?php echo lang('aGo_to_Buyer_Account'); ?></a></li>
          <?php }
        } ?>
        <li style=""><a class="got_ac" href="<?Php echo base_url($language . '/admin/manual'); ?>"><?php echo lang('aManual'); ?></a></li>


        <li class="dropdown dropdown_notfctn bg-not">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="material-icons">notifications_none </i><span class="badge">
              <?php echo (count($noti_data) == 0) ? "0" : count($noti_data); ?>
            </span>
          </a>
          <?php if (!empty($noti_data)) { ?>
            <ul class="dropdown-menu menu_admin_right notifctn_panel_as" style="border-radius:1rem">
              <?php foreach ($noti_data as $inn_key => $inn_val) { ?>
                <li>
                  <a href="<?php echo $inn_val['link']; ?>">
                    <span class="notfct_titl">
                      <?php echo $inn_val['message']; ?>
                    </span>
                    <div class="clear"></div>
                  </a>
                </li>
              <?php } ?>
            </ul>
          <?php } ?>
        </li>
        <li class="toggle_menu">
          <?php if ($language == 'en') { ?>
            <img class="en_toggle toggle_cls" src="<?php echo base_url('assets/admin/images/') ?>arabic_btn.png">
          <?php } else { ?>
            <img class="ar_toggle toggle_cls" src="<?php echo base_url('assets/admin/images/') ?>ar_load.png">
          <?php } ?>
          <span class="hide_mouse"></span>
        </li>

        <li class="dropdown" style="display:none;">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">

            <!-- <img class="img_admin_icon" src="<?php //echo base_url('assets/admin/usersdata/').@$admin_logo[0]['logo']; ?>"> -->
            <span class="user_name_text hidden-xs">
              <?php echo $user->first_name; ?>
              <?php echo $user->last_name; ?>
            </span>
          </a>
          <ul style="display: none" class="dropdown-menu menu_admin_right">
            <li class="header">
              <p>
                <?php echo $user->first_name; ?>
                <?php echo $user->last_name; ?>
              </p>
            </li>
            <li class="footer">
              <div class="pull-left leftaln">
                <a href="panel/account" class="btn btn-info waves-effect t">Account</a>
              </div>
              <div class="pull-right rightaln">
                <?php if ($user->group_id == 1) { ?>
                  <a href="panel/logout" class="btn btn-danger waves-effect t">Sign out</a>
                <?php } else { ?>
                  <a href="<?php echo base_url('en/login/logout'); ?>" class="btn btn-danger waves-effect t">Sign out</a>
                <?php } ?>
              </div>
            </li>
          </ul>
        </li>

        <!-- <li class="dropdown">
          <a href="javascript:void(0);" onclick="toggleFullScreen(document.body)" class="ful_screen_optn dropdown-toggle" data-toggle="dropdown">
            <i class="material-icons">settings_overscan</i>
          </a>
        </li> -->

      </ul>
    </div>
  </div>
</nav>
<!-- #Top Bar -->


<style type="text/css">
  .loading {
    width: 100%;
    height: 100%;
    opacity: 0.85;
    position: fixed;
    z-index: 2000;
  }

  .loading>div {
    width: 60px;
    height: 60px;
    position: absolute;
    left: 50%;
    margin-left: -30px;
    top: 50%;
    margin-top: -130px;
  }

  .loader-text {
    font-size: 14px;
    font-weight: bold;
    color: #444;
    width: 100px;
    height: 60px;
    position: absolute;
    left: 50%;
    margin-left: -38px;
    top: 50%;
    margin-top: -53px;

  }

  a.navbar-brand {
    font-size: 30px;
    margin: 10px;
    float: right;
    margin-left: 0px !important;
    margin-bottom: 0px;
    margin-right: 0px;
    font-weight: bold;
    margin-top: 0px;
  }
</style>


<script type="text/javascript">
  $(".click_menu_btn").click(function () {
    //alert("The paragraph was clicked.");
  });

  $(".click_menu_btn").click(function () {
    $(".sidebar_left").toggleClass("slider_menu_hide");
  });

  $(".click_menu_btn").click(function () {
    $(".page_inner_wrapper").toggleClass("page_inner_wrapper_full");
  });

  $(".click_menu_btn").click(function () {
    $(".click_menu_btn").toggleClass("click_menu_btn_close");
  });


</script>
<script type="text/javascript">
  function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
      textbox.addEventListener(event, function () {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    });
  }
// https://jsfiddle.net/emkey08/zgvtjc51
</script>
<style type="text/css">
  #loading {
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    position: fixed;
    display: block;
    opacity: 0.7;
    background-color: #fff;
    z-index: 99;
    text-align: center;
  }

  #loading-image {
    position: absolute;
    top: 250px;
    left: 630px;
    z-index: 100;
  }
</style>
<style type="text/css">
  .fist_a {
    width: 30%;
    margin: 0px;
    margin-top: 0px !important;
  }

  .second_a {
    width: 30%;
    margin-right: 2px;
    margin-top: 0px !important;
  }

  .third_a {
    width: 30%;
    margin-right: 1px;
    margin-top: 0px !important;
  }
</style>
<div id="loading" style="display: none">
  <img id="loading-image" src="<?php echo base_url('assets/admin/images/') ?>loaders.gif" alt="Loading..." />
</div>