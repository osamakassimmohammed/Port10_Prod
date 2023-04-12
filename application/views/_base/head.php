<!DOCTYPE html>
<html lang="<?php echo @$language; ?>" class="no-js loading <?php echo @$language; ?>">
<head>
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
    <meta charset="utf-8">  
    <meta http-equiv="x-ua-compatible" content="ie=edge">    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    


    <base href="<?php echo $base_url; ?>" />

    <title><?php //echo $page_title; ?> Port 10</title>

    <link href="<?php echo base_url('assets/frontend/images/');?>favicon.png" rel="shortcut icon" type="image/png">

    <!-- Vendor CSS -->


    <?php  if (strpos(current_url(),base_url($language."/admin") ) !== false ) { 
                foreach ($meta_data as $name => $content)
                {
                    if (!empty($content))
                        echo "<meta name='$name' content='$content'>".PHP_EOL;
                }

                foreach ($stylesheets as $media => $files)
                {
                    foreach ($files as $file)
                    {
                        $url = starts_with($file, 'http') ? $file : base_url($file);
                        echo "<link href='$url' rel='stylesheet' media='$media'>".PHP_EOL;  
                    }
                }
                
                foreach ($scripts['head'] as $file)
                {
                    $url = starts_with($file, 'http') ? $file : base_url($file);
                    echo "<script src='$url'></script>".PHP_EOL;
                }
         }else{  ?>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-P3MV9XYRT7"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'G-P3MV9XYRT7');
            </script>
            <script type="text/javascript">
                <?php if($language=='en'){ ?>
                    var ok_ea='OK';
                <?php }else{ ?>
                    var ok_ea='نعم';
                <?php } ?>
            </script>

    <?php  } ?>
</head>



<body class="home-page is-dropdn-click has-slider <?php echo $body_class; ?> <?php echo @$language; ?>">

   

        <div class="rotet_mode mobile" style="display: none;"  >
            <img class="rotet_img_en" src="<?php echo base_url();?>assets/frontend/images/rot.jpg">
            <img class="rotet_img_ar" src="<?php echo base_url();?>assets/frontend/images/rot_ar.jpg">
        </div>
        <script src="https://unpkg.com/current-device/umd/current-device.min.js"></script>

   

  