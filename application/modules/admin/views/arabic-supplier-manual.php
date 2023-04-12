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
    <button class="got_ac"><a style="color:white" href="<?Php echo base_url('en/admin/manual'); ?>">English</a></button>
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
                        إنشاء علامات تجارية
                      </h4>
                      <h4 class="bolder">
                        اضافة منتجات
                      </h4>
                      <h4 class="bolder">
                        إنشاء قائمة الطلبات
                      </h4>
                      <h4 class="bolder">
                        تأكيد / إلغاء الطلبات
                      </h4>
                      <h4 class="bolder">
                        عرض / تنزيل فاتورة الطلبات
                      </h4>
                      <h4 class="bolder">
                        رفض تسعير الطلبات
                      </h4>
                      <h4 class="bolder">
                        قبول تسعير الطلبات
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
                              <h4 class="line-head">لإعادة تعيين كلمة المرور المرتبطة بحسابك: </h4>
                              <ul>
                                <li>انتقل إلى https://www.port10.sa/en/login وقم بتسجيل الدخول باستخدام بيانات الاعتماد
                                  الحالية الخاصة بحسابك.</li>
                                <li>انقر فوق الزاوية اليمنى العليا واختار إعدادات الحساب.</span>
                                </li>
                                <li>في إعدادات الحساب، انتقل إلى تغيير كلمة المرور وأدخل كلمة المرور الجديدة ثم قم
                                  بتأكيد كلمة المرور الجديدة.</li>
                                <li>اضغط قدم لحفظ كلمة المرور الجديدة.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>change-password-seller-arabic.gif" />
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
                              <h4 class="line-head">لرفع صورة للملف الشخصي المرتبط بحسابك:</h4>
                              <ul>
                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل الدخول باستخدام بيانات التسجيل
                                  الخاصة بك.</li>
                                <li> <span class="bolder">إعدادات الحساب.</span>انقر فوق الزاوية اليمنى العليا واختار
                                </li>
                                <li>في <span class="bolder">إعدادات الحساب،</span> انتقل إلى تحميل الملف الشخصي واختر
                                  شعار شركتك.</li>
                                <li>انقر فوق<span class="bolder">تحميل الملف الشخصي</span>لرفع الصورة لحسابك. </li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>image-seller-arabic.gif" />
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
                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل الدخول باستخدام بيانات التسجيل
                                  الخاصة
                                  بك.
                                </li>
                                <li>انقر فوق الزاوية اليمنى العليا واختار<span class="bolder">إعدادات الحساب. </span>
                                </li>
                                <li>في <span class="bolder">إعدادات الحساب،</span> قم بتغيير معلومات حسابك.</li>
                                <li>انقر فوق<span class="bolder">تحديث الملف الشخصي</span></li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>update-account-seller-arabic.gif" />
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
                                إنشاء علامات تجارية
                              </h2>
                              <h4 class="line-head">لإنشاء علامة تجارية مرتبطة بحسابك:</h4>
                              <ul>
                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل الدخول باستخدام بيانات التسجيل
                                  الخاصة
                                  بك.</li>
                                <li>انقر فوق الزاوية اليمنى العلوية واختار <span class="bolder">العلامات
                                    التجارية.</span>
                                </li>
                                <li>في صفحة<span class="bolder">العلامات التجارية،</span>انقر على <span
                                    class="bolder">إنشاء
                                    علامة تجارية.</span></li>
                                <li>أضف اسم العلامة التجارية.</li>
                                <li>قم بتحميل صورة العلامة التجارية.</li>
                                <li>انقر فوق <span class="bolder">إنشاء</span> لحفظ العلامة التجارية.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>create-brand-seller-arabic.gif" />
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
                                اضافة منتجات
                              </h2>
                              <h4 class="line-head">لإضافة منتج مرتبط بحسابك:</h4>
                              <ul>
                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل الدخول باستخدام بيانات التسجيل
                                  الخاصة
                                  بك.</li>
                                <li>انقر فوق الزاوية اليمنى العليا واختار<span class="bolder">المنتج.</span>.</li>
                                <li>في صفحة<span class="bolder">المنتج،</span>انقر على<span class="bolder">إنشاء
                                    منتج.</span>.</li>
                                <li>قم بإنشاء منتج من هذه الشاشة، تحتاج إلى تقديم بعض التفاصيل مثل: (الاسم، علامة البحث،
                                  الوصف الموجز، العلامة التجارية، الفئة، الفئة الفرعية، الوصف، المواصفات، الحالة، سعر
                                  السوق،
                                  السعر لدينا، حالة المخزون، الكمية في المخزن، جاهز للشحن خلال وصور المنتج).
                                </li>
                                <li>انقر فوق<span class="bolder">قدم</span> لتخزين كافة التفاصيل.
                                </li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>add-product-seller-arabic.gif" />
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
                                إنشاء قائمة الطلبات
                              </h2>
                              <h4 class="line-head">لتصدير قائمة الطلبات المرتبطة بحسابك بتنسيق Microsoft Excel
                              </h4>
                              <ul>
                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل الدخول باستخدام بيانات التسجيل
                                  الخاصة
                                  بك.</li>
                                <li>انقر فوق الزاوية اليمنى العليا واختار<span class="bolder">الطلبات.</span></li>
                                <li>قم بتعيين تاريخ البدء والانتهاء للطلبات التي تريد تصديرها.</li>
                                <li>انقر فوق زر<span class="bolder">ملف إكسل</span>لتصدير قائمة الطلبات.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>export-order-seller-arabic.gif" />
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
                                تأكيد / إلغاء الطلبات
                              </h2>
                              <h4 class="line-head">تأكيد / إلغاء الطلبات المرتبطة بحسابك:
                              </h4>
                              <ul>
                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل الدخول باستخدام بيانات التسجيل
                                  الخاصة
                                  بك.</li>
                                <li>انقر فوق الزاوية اليمنى العليا واختار <span class="bolder">الطلبات.</span></li>
                                <li>في صفحة الطلبات، اختر الطلب الذي ترغب في تحديثه وانقر على<span
                                    class="bolder">شاهد.</span></li>
                                <li>تحت خانة تحديث الطلب، انقر فوق<span class="bolder">حالة الطلب</span>وقم بتحديث حالة
                                  الطلب لـ(مكتمل / إلغاء). </li>
                                <li>انقر فوق الزر<span class="bolder">"تحديث"</span>لحفظ حالة الطلب المحدثة.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>order-status-seller-arabic.gif" />
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
                                عرض / تنزيل فاتورة الطلبات
                              </h2>
                              <h4 class="line-head">لعرض أو تنزيل فاتورة الطلب المرتبطة بحسابك:
                              </h4>
                              <ul>
                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل الدخول باستخدام بيانات التسجيل
                                  الخاصة
                                  بك.</li>
                                <li>انقر فوق الزاوية اليمنى العليا واختار<span class="bolder">الطلبات.</span></li>
                                <li>في صفحة الطلبات، اختر الطلب الذي ترغب في عرضه وانقر على<span class="bolder">فاتورة.
                                    </span">
                                </li>
                                <li>في صفحة الفاتورة، انقر فوق<span class="bolder">تحميل الفاتورة</span>لحفظ الفاترة على
                                  جهازك.
                                </li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>invoice-seller-arabic.gif" />
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
                                رفض تسعير الطلبات
                              </h2>
                              <h4 class="line-head">لرفض عروض تسعير الطلبات المرتبطة بحسابك:
                              </h4>
                              <ul>
                                <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل الدخول باستخدام بيانات التسجيل
                                  الخاصة
                                  بك.</li>
                                <li>انقر فوق الزاوية اليمنى العليا واختار<span class="bolder">تسعيرة.</span></li>
                                <li>في صفحة عرض الأسعار، اختر الطلب الذي ترغب في تحديثه وانقر على<span
                                    class="bolder">معلومات.</span>
                                </li>
                                <li>في صفحة تفاصيل التسعيرة، انقر فوق<span class="bolder">"مرفوض"</span>
                                  لرفض عرض الأسعار.</li>
                                <li>اكتب سبب الرفض وانقر على زر قدم لإرسال جميع التفاصيل إلى المشتري.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>reject-quatation-seller-arabic.gif" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div>
                      <h2 class="manual-headers-red g-mt-3rem">
                        قبول تسعير الطلبات
                      </h2>
                      <div class="row g-mt-3rem">
                        <div class="col-12">
                          <h4 class="line-head">لقبول عروض تسعير الطلبات المرتبطة بحسابك:
                          </h4>
                          <ul>
                            <li>اذهب إلى https://www.port10.sa/en/login وقم بتسجيل الدخول باستخدام بيانات التسجيل الخاصة
                              بك.</li>
                            <li>انقر فوق الزاوية اليمنى العليا واختار <span class="bolder">تسعيرة.</span></li>
                            <li>في صفحة عرض الأسعار، اختر الطلب الذي ترغب في تحديثه وانقر على<span
                                class="bolder">معلومات.</span></li>
                            <li>في صفحة طلب عرض الأسعار، قدم بعض التفاصيل مثل: (الكمية ووصف السلعة والسعر).</li>
                            <li>انقر فوق إرسال لإرسال عرض الأسعار إلى المشتري.</li>
                          </ul>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div>
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