var placeSearch, billingautocomplete,shippingautocomplete;

    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {

        shippingautocomplete = new google.maps.places.Autocomplete(
            document.getElementById('shipping-autocomplete'), {types: ['geocode']});

        billingautocomplete = new google.maps.places.Autocomplete(
            document.getElementById('billing-autocomplete'), {types: ['geocode']});

        billingautocomplete.setFields(['address_component']);
        shippingautocomplete.setFields(['address_component']);

        billingautocomplete.addListener('place_changed', fillInBillingAddress);
        shippingautocomplete.addListener('place_changed', fillInShippingAddress);
    }

    function fillInBillingAddress(){
        var place = billingautocomplete.getPlace();
        fillInAddress(place,'billing');
    }

    function fillInShippingAddress(){
        var place = shippingautocomplete.getPlace();
        fillInAddress(place,'shipping');
    }

    function fillInAddress(place,type) {

        console.log(place.address_components);
        setCountry(place,type);
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            console.log(addressType);
            if(addressType=='street_number'){
                jQuery('#'+type+'_address_1').val(place.address_components[i]['short_name']);
            }
            if(addressType=='route'){
                jQuery('#'+type+'_address_2').val(place.address_components[i]['long_name']);
            }
            if(addressType=='locality'){
                jQuery('#'+type+'_city').val(place.address_components[i]['long_name']);
            }
            if(addressType=='administrative_area_level_1'){
                // alert(place.address_components[i]['short_name']);
                jQuery('#'+type+'_state').val(place.address_components[i]['short_name']).change();
            }
            if(addressType=='postal_code'){
                jQuery('#'+type+'_postcode').val(place.address_components[i]['short_name']);
            }
        }
    }

    function setCountry(place,type){
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if(addressType=='country'){
                jQuery('#'+type+'_country').val(place.address_components[i]['short_name']).change();
                break;
            }
        }
    }


    function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle(
                {center: geolocation, radius: position.coords.accuracy});
            autocomplete.setBounds(circle.getBounds());
          });
        }
    }