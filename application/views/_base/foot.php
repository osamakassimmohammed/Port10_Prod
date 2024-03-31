<script type="text/javascript">
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function isNumberdotKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && ((charCode < 48 || charCode > 57) && charCode != 46))
            return false;
        return true;
    }

    $(document).on("keypress", ".isSpecial", function (event) {
        var regex = new RegExp("^[a-zA-Z0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    function isSpecial(string) {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        if (format.test(string)) {
            swal("", "Special characters not allowed", 'warning');
            return false;
        }
    }
</script>

<script type="text/javascript">
    document.getElementsByTagName("html")[0].classList.remove("loading");
    // All browsers
    document.getElementsByTagName("html")[0].className.replace(/loading/, "");
    // Or with jQuery
    $("html").removeClass("loading");
</script>


<?php
foreach ($scripts['foot'] as $file) {
    $url = starts_with($file, 'http') ? $file : base_url($file);
    echo "<script src='$url'></script>" . PHP_EOL;
}

?>


</body>
</html>


<div class="modal--quickview" id="modalQuickView123" style="display: none;">
    <div class="modal-header">
        <div class="modal-header-title">Quick View</div>
    </div>
    <div class="modal-content">
        <div class="modal-body">
            <div class="prd-block" id="prdGalleryModal">
                <div class="prd-block_info">
                    <div class="prd-block_info-row info-row-1 mb-md-1">
                        <div class="info-row-col-1">
                            <h1 class="prd-block_title">Glamor shoes</h1>
                        </div>
                        <div class="info-row-col-2">
                            <div class="product-sku">SKU: <span>#0005</span></div>

                        </div>
                    </div>
                    <div class="prd-block_info-row info-row-2">
                        <form action="#">
                            <div class="info-row-col-3">
                                <div class="prd-block_price"><span
                                        class="prd-block_price--actual">$180.00</span>
                                    <span class="prd-block_price--old">$210.00</span>
                                </div>
                            </div>
                            <div class="info-row-col-4">
                                <div class="prd-block_price"><span
                                        class="prd-block_price--actual">$180.00</span>
                                    <span class="prd-block_price--old">$210.00</span>
                                </div>
                                <div class="prd-block_qty"><span class="option-label">Qty:</span>
                                    <div class="qty qty-changer qty-changer--lg">
                                        <fieldset><input type="button" value="&#8210;"
                                                         class="decrease"> <input
                                                type="text" class="qty-input" value="2"
                                                data-min="0" data-max="10"> <input
                                                type="button" value="+"
                                                class="increase"></fieldset>
                                    </div>
                                </div>
                                <div class="prd-block_options">
                                    <div class="form-group select-wrapper-sm"><select
                                            class="form-control" tabindex="0">
                                            <option value="">36 / silver $34.00</option>
                                            <option value="">38 / silver $34.00</option>
                                            <option value="">36 / gold $45.00</option>
                                            <option value="">38 / gold $45.00</option>
                                        </select></div>
                                </div>
                                <div class="prd-block_actions">
                                    <div class="btn-wrap">
                                        <button class="btn btn--add-to-cart-sm"><i
                                                class="icon icon-handbag"></i><span>Add to cart</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="prd-block_info js-prd-m-holder"></div>
                <!-- Product Gallery -->
                <div class="product-previews-wrapper">
                    <div
                        class="product-quickview-carousel slick-arrows-aside-simple js-product-quickview-carousel">
                        <div>
                            <a href="https://assets.ajio.com/medias/sys_master/root/h9f/he0/13018714767390/-473Wx593H-460342492-blue-MODEL.jpg"
                               data-fancybox="gallery"><img
                                    src="https://assets.ajio.com/medias/sys_master/root/h9f/he0/13018714767390/-473Wx593H-460342492-blue-MODEL.jpg"
                                    alt=""></a></div>

                        <div>
                            <a href="https://assets.ajio.com/medias/sys_master/root/h9f/he0/13018714767390/-473Wx593H-460342492-blue-MODEL.jpg"
                               data-fancybox="gallery"><img
                                    src="https://assets.ajio.com/medias/sys_master/root/h9f/he0/13018714767390/-473Wx593H-460342492-blue-MODEL.jpg"
                                    alt=""></a></div>

                        <div>
                            <a href="https://assets.ajio.com/medias/sys_master/root/h9f/he0/13018714767390/-473Wx593H-460342492-blue-MODEL.jpg"
                               data-fancybox="gallery"><img
                                    src="https://assets.ajio.com/medias/sys_master/root/h9f/he0/13018714767390/-473Wx593H-460342492-blue-MODEL.jpg"
                                    alt=""></a></div>


                    </div>
                    <div class="gdw-loader"></div>
                </div>
                <!-- /Product Gallery -->
                <div class="mt-3 mt-md-4">
                    <h2>Description</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error
                        expedita hic iure nemo, nihil quam. Ab blanditiis eligendi fugit
                        impedit, magni minus omnis placeat recusandae rem, sunt ut vitae
                        voluptates? Fuga pariatur provident reiciendis veritatis
                        voluptates voluptatum. A accusantium aliquam amet deleniti ea
                        esse ex minus obcaecati perferendis tempore? Cupiditate
                        distinctio incidunt molestiae, nam nesciunt non quaerat quas
                        ratione repellendus! Ab aperiam assumenda consequatur delectus
                        ea exercitationem facilis, in itaque iusto labore maiores nemo
                        nostrum odio officiis optio placeat quas qui quibusdam ratione
                        rem soluta suscipit totam voluptas voluptatem voluptatum.</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <tbody>
                            <tr>
                                <td>FABRIC</td>
                                <td>Metallic faux leather</td>
                            </tr>
                            <tr>
                                <td>STYLE</td>
                                <td>Goatskin lining, Strappy silhouette, Chunky heel,
                                    Buckle at ankle
                                </td>
                            </tr>
                            <tr>
                                <td>MANUFACTURE</td>
                                <td>Made in Italy</td>
                            </tr>
                            <tr>
                                <td>MATERIAL</td>
                                <td>Rubber heel patch at leather sole</td>
                            </tr>
                            <tr>
                                <td>WEIGHT</td>
                                <td>0.05, 0.06, 0.07ess cards</td>
                            </tr>
                            <tr>
                                <td>BOX</td>
                                <td>This item cannot be gift-boxed</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
