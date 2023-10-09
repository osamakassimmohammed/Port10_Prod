<script type="text/javascript">
   var shippting_api_call=0;
   $(document).on("click","#shipping_rate",function(){
      jsonData = get_details();
      if(jsonData!=false)
      {
         if(shippting_api_call == 0)
         {
           $("#shipping_error").hide();
           $('#loading').show(); 
           $.ajax({
              type: 'POST',
              url: "<?php echo base_url($language.'/Ajax/shipping_rate'); ?>",
              data: jsonData,    
              success: function(response)
              {  
                 console.log(response);     
                 $('#loading').hide();
                 response=$.trim(response);
                 var response = $.parseJSON(response);
                 if(response.status==true)
                 {    
                     if(response.is_single_pro_error==false)
                     {
                        //$("#shipping_rate").attr("disabled", true);
                        $("#ship_li").show();
                        var sale_price = parseFloat($("#total_cost").text().replaceAll(',', ''));
                        $("#ship_cost").text(response.TotalAmount);
                     
                        $("#total_cost").text((sale_price + response.TotalAmount).toLocaleString("en-US"));
                        shippting_api_call++;             
                     }else{
                        $('#shipping_rate').prop('checked', false);
                        var html_tag='';
                        $.each(response.data, function( k, v ) 
                        {
                           if(v.error==1)
                           {
                              html_tag+='<p class="text-danger">'+v.error_message+'</p>';
                           }
                        });
                        swal("",html_tag,'warning');
                        $("#shipping_error").show();
                        $("#shipping_error").html(html_tag);
                     }
                     
                 }else{
                     $('#shipping_rate').prop('checked', false);
                     swal("",response.message);
                     if(response.flag=="redirect")
                     {
                        setTimeout(function(){ window.location=response.url; }, 2000);
                     }
                     $("#ship_li").hide();
                 }
              }
            });   
         }else{
          shippting_api_call = 0;
            location.reload(true)
            // swal("","You already calculated shipping cost","warning");
         }
      }
   }); 

   function get_details()
   {
       var first_name=$("#ck_first_name").val();
       var last_name=$("#ck_last_name").val();
       var phone=$("#ck_phone").val();
       var email=$("#ck_email").val();
       var country=$("#ck_country").val();
       var pincode=$("#ck_pincode").val();
       var state=$("#ck_state").val();
       var city=$("#ck_city").val();    
       var address_1=$("#ck_address_1").val();
       var searchInput=$("#searchInput").val();
       var payment_mode=$("#payment_mode").val();
       var pin_order_ids=$("#pin_order_ids").val();
       var purchasing_mode=$('input[name=purchasing_mode]:checked').val();       
       // var delivery_option=$('input[name=delivery_option]:checked').val();       
       var error=1;
       

       if(first_name=='')
       {
           swal("","<?php echo lang('Enter_Your_First_Name'); ?>","warning");        
           error=0;        
           return false;
       }
       if(last_name=='')
       {
           swal("","<?php echo lang('Enter_Your_Last_Name'); ?>","warning");        
           error=0;        
           return false;
       }

       if(phone=='')
       {
           swal("","<?php echo lang('Enter_your_number'); ?>","warning");              
           error=0;
           return false;
       }

       if(email=='')
       {
           swal("","<?php echo lang('Enter_Your_Email'); ?>","warning");        
           error=0;
           return false;
       }
       if(email!='')
       {
         if(!isValidEmailAddress(email))
         {        
           error=0;        
           swal("","<?php echo lang('Please_Enter_Valid_Email_Id'); ?>","warning");
           return false;
         }                  
       }

       if(address_1=='')
       {
           swal("","<?php echo lang('Enter_Your_Address'); ?>","warning");        
           error=0;
           return false;
       }

       if(country=='')
       {
           swal("","<?php echo lang('Entr_Your_Country'); ?>","warning");        
           error=0;
           return false;
       }

       if(city=='')
       {
           swal("","<?php echo lang('Enter_Your_City'); ?>","warning");        
           error=0;
           return false;
       }

       if(state=='')
       {
           swal("","<?php echo lang('Enter_Your_State'); ?>","warning");        
           error=0;
           return false;
       }

       if(pincode=='')
       {
           swal("","<?php echo lang('Enter_Your_Postal_Code'); ?>","warning");        
           error=0;
           return false;
       }

      var lat=$("#lat").val();
      var lng=$("#lng").val();

       if(searchInput!='')
       {
         if(lat=='' && lng=='')
         {
           swal("","<?php echo lang('Please_select_perfect_google_address'); ?>","warning");        
           error=0;
           return false;
         }
       }
       if(error==1)
       {
         var jsonData = {'first_name':first_name,'last_name':last_name,'payment_mode':payment_mode,'mobile_no':phone,'email':email,'address_1':address_1,'country':country,'city':city,'state':state,'pincode':pincode,'google_address':searchInput,'lat':lat,'lng':lng,'flow_type':g_flow_type,'in_id':g_in_id,'pin_order_ids':pin_order_ids,'purchasing_mode':purchasing_mode,'shippting_api_call':shippting_api_call};
         return jsonData;
       }else{
         swal("","<?php echo lang('Something'); ?>","warning");
         return false;
       }

   }
  $(document).on('submit','#form_place_order',function(e)
  {
    e.preventDefault();
    jsonData = get_details();
    if(jsonData!=false)
    {
       // if(g_is_calculate_rate == 0)
      // {
      //    if(shippting_api_call == 1)
      //    {
      //       swal("","<?php echo lang('Befour_place_order_first_calculate_shipping_cast'); ?>","warning");
      //       return false;
      //    }         
      // }
      $('#loading').show(); 
        $.ajax({
           type: 'POST',
           url: "<?php echo $ajax_url; ?>",
           data: jsonData,    
           success: function(response)
           {       
              $('#loading').hide();
              response=$.trim(response);
              var response = $.parseJSON(response);
              if (response.status==true)
              {
                if(response.flag=="redirect")
                {
                  $('#loading').show();
                  setTimeout(function(){ window.location=response.url; }, 2000);
                }else{
                  swal("",response.message,'success');
                }                                
              }else if(response.status==false)
              {
               swal("",response.message,'warning');
                if(response.flag=="redirect")
                {
                  setTimeout(function(){ window.location=response.url; }, 2000);
                }
                if(response.flag=="shipping_erro")
                { 
                  $("#shipping_error").show();
                  $("#shipping_error").html(response.message);
                }
              }else{
                 swal("","<?php echo lang('Something'); ?>",'warning');
              }
           }
         });    
    }
   
  });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcf4oVp2zfW5qBYMtRD54DApyRolch_qE&libraries=places&callback=initMap" async defer></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNpNhw8Qyac0n7I7gHsVWtr4uc1VNN7dg&libraries=places&callback=initMap" async defer></script> -->
<script type="text/javascript">
   function initMap() {
    var map = new google.maps.Map(document.getElementById('map2'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 13
    });
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {      
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    
        var address = '';
        if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
      
        //Location details
        for (var i = 0; i < place.address_components.length; i++) {
          $('.inputDisabled').prop("disabled", false);
            // if(place.address_components[i].types[0] == 'postal_code'){
            //     document.getElementById('postal_code').value = place.address_components[i].long_name;
            // }
            // if(place.address_components[i].types[0] == 'country'){
            //     document.getElementById('country').value = place.address_components[i].long_name;
            // }
            // if(place.address_components[i].types[0] == 'administrative_area_level_1'){
            //     document.getElementById('administrative_area_level_1').value = place.address_components[i].long_name;
            // }
            // if(place.address_components[i].types[0] == 'locality'){
            //     document.getElementById('locality').value = place.address_components[i].long_name;
            // }
            // if(place.address_components[i].types[0] == 'route'){
            //     document.getElementById('route').value = place.address_components[i].long_name;
            // }
            // if(place.address_components[i].types[0] == 'street_number'){
            //     document.getElementById('street_number').value = place.address_components[i].long_name;
            // }
        }
        // console.log(place);
        // document.getElementById('location').innerHTML = place.formatted_address;
        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();
    });
}
</script>