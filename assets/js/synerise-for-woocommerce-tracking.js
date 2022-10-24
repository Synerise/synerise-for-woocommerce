"use strict";
jQuery(document).ready(function($) {
    setTimeout( function(){
        $( 'input.variation_id' ).change( async function(e) {
            if( '' != $(this).val() ) {
                let variation_id = $(this).val();
                const product_data = await get_product_data(variation_id);
                if(product_data){
                    Object.keys(product_data).forEach(key => {
                        add_meta(key, product_data[key]);
                    });

                    if (typeof SR !== 'undefined') {
                        SR.event.pageVisit();
                    }
                }
            }
        } );
    }, 1000 );

    async function get_product_data(product_id) {
        const path = window.rest.url;

        const response = await $.ajax({
            url: path + 'product-og-data',
            data: {
                product_id
            },
            headers: {'X-WP-Nonce': window.rest.nonce}
        });

        if(response.success === true){
            return response.product_tags;
        }

        return false;
    }

    function add_meta(key, value){
        let meta = document.querySelector(`meta[property='${key}']`);
        if(meta){
            meta.setAttribute('content', value);
        } else {
            $('head').append(`<meta property="${key}" content="${value}" />`);
        }
    }
});