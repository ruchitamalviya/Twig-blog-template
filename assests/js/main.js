jQuery(document).ready(function(){
    let page = 2;
    jQuery('body').on('click', '.btn_see_more', function() { 
        jQuery(".btn_see_more").prop("disabled",true);
        jQuery.ajax({
            url: see_more_post.ajaxurl,
            data: {action:'load_more_posts',page:page},
            dataType: 'json',
             success: function(res){
                if ( res.success == 1 ) {
                 jQuery(".btn_see_more").prop("disabled",false);
                    if(jQuery.trim(res.posts) != '') {
                        jQuery('.card_section_3').append(res.posts);
                        page++;

                    }
                } else {
                alert("Sorry! an error occurred.");
                }
            },
        });
    });
});