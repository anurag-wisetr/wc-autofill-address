(function($){
    "use strict";

    class WAA_Autofill_Address{

        constructor(type='billing') {
            this.addresstype=type;
            this.initAutocomplete();
        }

        initAutocomplete(){
            if(document.getElementById(this.addresstype+'-autocomplete').length) {
                this.autocomplete = new google.maps.places.Autocomplete(document.getElementById(this.addresstype + '-autocomplete'), {types: ['geocode']});
                this.autocomplete.setFields(['address_component']);
                google.maps.event.addListener(this.autocomplete, 'place_changed', () => {
                    this.generateAddress();
                });
            }
        }

        generateAddress(){
            let address_data=this.getAddressData();
            for (let i in address_data) {
                if(i=='street_number'){
                    $('#'+this.addresstype+'_address_1').val(address_data[i]['short_name']);
                }else if(i=='route'){
                    $('#'+this.addresstype+'_address_2').val(address_data[i]['long_name']);
                }else if(i=='locality'){
                    $('#'+this.addresstype+'_city').val(address_data[i]['long_name']);
                }else if(i=='administrative_area_level_1'){
                    $('#'+this.addresstype+'_state').val(address_data[i]['short_name']).change();
                }else if(i=='postal_code'){
                    $('#'+this.addresstype+'_postcode').val(address_data[i]['short_name']);
                }
            }
        }

        getAddressData(){
            let place = this.autocomplete.getPlace();
            let components={};
            for (let i = 0; i < place.address_components.length; i++) {
                var fieldType = place.address_components[i].types[0];
                var short_name=place.address_components[i]['short_name'];
                var long_name=place.address_components[i]['long_name'];
                components[fieldType]={'short_name':short_name,'long_name':long_name};
            }
            this.setCountry(components.country.short_name);
            return components;
        }

        setCountry(country){
            $('#'+this.addresstype+'_country').val(country).change();
        }
    }

    waa_google_address_init();

    function waa_google_address_init() {
         new WAA_Autofill_Address();
         new WAA_Autofill_Address('shipping');
    }

})(jQuery);