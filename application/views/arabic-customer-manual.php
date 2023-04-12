<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css'
    rel='stylesheet' media='screen'>
<script
    src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script
    src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<link href='<?php echo base_url(); ?>assets/frontend/css/common.css' rel='stylesheet' media="screen" id="color">
<link href='<?php echo base_url(); ?>assets/admin/css/style.css' rel='stylesheet' media="screen" id="color">
<link href='<?php echo base_url(); ?>assets/admin/css/bootstrap.css' rel='stylesheet' media="screen" id="color">
<link href='<?php echo base_url(); ?>assets/frontend/css/bootstrap.css' rel='stylesheet' media="screen" id="color">


<style>
    section.content {
        margin: 15px 15px 0 15px;
        -moz-transition: 0.5s;
        -o-transition: 0.5s;
        -webkit-transition: 0.5s;
        transition: 0.5s;
    }

    .card .body {
        font-size: 14px;
        color: #555;
        padding: 20px;
        font-family: sans-serif;
    }

    body {
        background-color: #f1f2f7;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        font-family: Roboto;
    }

    li {
        list-style: disc;
        font-size: 15px;
        color: #000000;
        font-weight: 500
    }

    li:before {
        /* content: "·"; */
        font-size: 60px;
        vertical-align: middle;
        line-height: 20px;
        border-radius: 50%
    }

    .line-head {
        font-size: 15px;
        color: #000000;
        font-weight: 500;
        margin-bottom: 0.9rem;
    }

    img {
        max-width: 100% !important;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .content-wrapper {
        text-align: right;
        direction: rtl;
    }

    .got_ac {
        padding: 13px 29px;
        background: #3f006f;
        color: white !important;
        letter-spacing: 0.05em;
        border-radius: 5rem;
        margin-bottom: 1rem;
        font-family: sans-serif;
        font-size: 14px;
    }
</style>

<div class="content-wrapper">
    <section class="content page_inner_wrapper ">
        <button class="got_ac"><a style="color:white" href="<?Php echo base_url('en/manual'); ?>">English</a></button>
        <div class="container-fluid">
            <div class="row clearfix ">
                <div class="card">
                    <div class="body">
                        <div class="d-flex justify-content-between">
                            <img style="width: 120px;height: 120px" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>logo-english-image.png" />
                            <img style="width: 120px;height: 120px" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>logo-arabic-image.png" />
                        </div>
                        <div>
                            <h1 class="manual-headers-blue text-center">
                                دليل المورد
                            </h1>
                            <div class="side_space_2">
                                <h2 class="manual-headers-blue">
                                    الفهرس
                                </h2>
                                <div class="row g-mt-3rem">
                                    <div class="col-12">
                                        <div class="col-md-2" style="text-align:end">
                                            <h4>3</h4>
                                            <h4>2</h4>
                                            <h4>7</h4>
                                            <h4>9</h4>
                                            <h4>5</h4>
                                            <h4>3</h4>
                                        </div>
                                        <div class="col-md-10" style="padding-right: 0px;">
                                            <h4 class="bolder">
                                                تغيير كلمة المرور
                                            </h4>
                                            <h4 class="bolder">
                                                تغيير صورة الملف الشخصي
                                            </h4>
                                            <h4 class="bolder">
                                                تحديث معلومات الحساب
                                            </h4>
                                            <h4 class="bolder">
                                                عرض / تنزيل فاتورة الطلب
                                            </h4>
                                            <h4 class="bolder">
                                                إعادة طلب المنتجات
                                            </h4>
                                            <h4 class="bolder">
                                                طلب تسعيرة
                                            </h4>
                                        </div>

                                        <div>
                                            <div class="row g-mt-3rem">
                                                <div class="col-12">
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-lg-5 col-md-12">
                                                            <h2 class="manual-headers-red g-mt-3rem">
                                                                تغيير كلمة المرور
                                                            </h2>
                                                            <h4 class="line-head">لإعادة تعيين كلمة المرور المرتبطة
                                                                بحسابك:</h4>
                                                            <ul>
                                                                <li>انتقل إلى https://www.port10.sa/en/login وقم بتسجيل
                                                                    الدخول
                                                                    باستخدام بيانات الاعتماد الحالية الخاصة بحسابك.</li>
                                                                <li>انقر فوق الزاوية اليمنى واختار الحساب.</li>
                                                                <li>في إعدادات الحساب، انتقل إلى تغيير كلمة المرور وأدخل
                                                                    كلمة
                                                                    المرور القديمة ثم ادخل كلمة المرور الجديدة وقم
                                                                    بتأكيد كلمة
                                                                    المرور الجديدة.
                                                                </li>
                                                                <li>اضغط تغيير لحفظ كلمة المرور الجديدة.</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-7 col-md-12">
                                                            <img class="shadow rounded" alt=""
                                                                src="<?php echo base_url('assets/admin/blog/'); ?>change-password-arabic.gif" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="row g-mt-3rem">
                                                <div class="col-12">
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-lg-5 col-md-12">
                                                            <h2 class="manual-headers-red g-mt-3rem">
                                                                تغيير صورة الملف الشخصي
                                                            </h2>
                                                            <h4 class="line-head">لرفع صورة للملف الشخصي المرتبط بحسابك:
                                                            </h4>
                                                            <ul>
                                                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل
                                                                    الدخول
                                                                    باستخدام بيانات التسجيل الخاصة بك.</li>
                                                                <li>انقر فوق الزاوية اليمنى واختار الحساب.</li>
                                                                <li>في إعدادات الحساب، انتقل إلى تحميل الشعار واختر شعار
                                                                    شركتك.
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-7 col-md-12">
                                                            <img class="shadow rounded" alt=""
                                                                src="<?php echo base_url('assets/admin/blog/'); ?>image-arabic.gif" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="row g-mt-3rem">
                                                <div class="col-12">
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-lg-5 col-md-12">
                                                            <h2 class="manual-headers-red g-mt-3rem">
                                                                تحديث معلومات الحساب
                                                            </h2>
                                                            <h4 class="line-head">لتحديث معلومات ملفك الشخصي:</h4>
                                                            <ul>
                                                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل
                                                                    الدخول
                                                                    باستخدام بيانات التسجيل الخاصة بك.
                                                                </li>
                                                                <li>انقر فوق الزاوية اليمنى واختار الحساب. </li>
                                                                <li>في إعدادات الحساب، قم بتعديل ملفك الشخصي.</li>
                                                                <li>انقر فوق تحديث<span class="bolder">لحفظ التغيرات على
                                                                        ملفك
                                                                        الشخصي.</span></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-7 col-md-12">
                                                            <img class="shadow rounded" alt=""
                                                                src="<?php echo base_url('assets/admin/blog/'); ?>update-account-arabic.gif" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="row g-mt-3rem">
                                                <div class="col-12">
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-lg-5 col-md-12">
                                                            <h2 class="manual-headers-red g-mt-3rem">
                                                                عرض / تنزيل فاتورة الطلب
                                                            </h2>
                                                            <h4 class="line-head">لعرض أو تنزيل فاتورة الطلبات المرتبطة
                                                                بحسابك:
                                                            </h4>
                                                            <ul>
                                                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل
                                                                    الدخول
                                                                    باستخدام بيانات التسجيل الخاصة بك.</li>
                                                                <li> انقر فوق<span class="bolder">الطلبات.</span></li>
                                                                <li>في صفحة<span class="bolder">الطلبات،</span>انقر فوق
                                                                    <span class="bolder">"تحميل"</span>لعرض فاتورة
                                                                    الطلب.
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-7 col-md-12">
                                                            <img class="shadow rounded" alt=""
                                                                src="<?php echo base_url('assets/admin/blog/'); ?>tax-invoice-arabic.gif" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="row g-mt-3rem">
                                                <div class="col-12">
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-lg-5 col-md-12">
                                                            <h2 class="manual-headers-red g-mt-3rem">
                                                                إعادة طلب المنتجات
                                                            </h2>
                                                            <h4 class="line-head">لإعادة طلب المنتجات التي قمت بشرائها
                                                                من قبل:
                                                            </h4>
                                                            <ul>
                                                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل
                                                                    الدخول
                                                                    باستخدام بيانات التسجيل الخاصة بك.</li>
                                                                <li> انقر فوق<span class="bolder">الطلبات.</span></li>
                                                                <li>في صفحة<span class="bolder">الطلبات، </span> انقر
                                                                    فوق
                                                                    <span class="bolder">"إعادة الطلب"</span> لإعادة
                                                                    شراء
                                                                    المنتجات.
                                                                </li>
                                                                <li>في صفحة إعادة<span class="bolder">الطلب،</span>ختر
                                                                    طريقة
                                                                    الدفع.</li>
                                                                <li>انقر فوق<span class="bolder">"الدفع"</span> لفتح
                                                                    صفحة انهاء
                                                                    الطلب.
                                                                </li>
                                                                <li>في صفحة الدفع، قم بتحرير عنوان الشحن / الفواتير إذا
                                                                    لزم
                                                                    الأمر.</li>
                                                                <li>انقر فوق<span class="bolder">"اعتماد
                                                                        الطلب"</span>لتأكيد
                                                                    عملية الشراء.
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-7 col-md-12">
                                                            <img class="shadow rounded" alt=""
                                                                src="<?php echo base_url('assets/admin/blog/'); ?>reorder-arabic.gif" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="row g-mt-3rem">
                                                <div class="col-12">
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-lg-5 col-md-12">
                                                            <h2 class="manual-headers-red g-mt-3rem">
                                                                طلب تسعيرة
                                                            </h2>
                                                            <h4 class="line-head">لطلب عرض أسعار المنتجات من المورد:
                                                            </h4>
                                                            <ul>
                                                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل
                                                                    الدخول
                                                                    باستخدام بيانات التسجيل الخاصة بك.</li>
                                                                <li> انقر على<span class="bolder">التسعيرة.</span></li>
                                                                <li>في صفحة<span class="bolder">التسعيرة،</span>انقر
                                                                    فوق<span class="bolder">طلب تسعيرة.</span></li>
                                                                <li>في صفحة طلب التسعيرة قدم بعض التفاصيل الاساسية مثل:
                                                                    (اسم
                                                                    المنتج، فئة المنتج، لمن الطلب، دورة الشراء، التخصيص،
                                                                    الموعد
                                                                    النهائي للتقديم، رقم المنتج، رمز النظام المنسق،
                                                                    الوحدة،
                                                                    الكمية، موقع التسليم وتاريخ التسليم، مصطلحات التجارة
                                                                    الدولية، شهادات والمزيد من المعلومات إذا لزم الأمر).
                                                                </li>
                                                                <li>انقر فوق الزر إرسال لإرسال طلب التسعيرة.</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-7 col-md-12">
                                                            <img class="shadow rounded" alt=""
                                                                src="<?php echo base_url('assets/admin/blog/'); ?>request-quotation-arabic.gif" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <!-- <div> -->
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>