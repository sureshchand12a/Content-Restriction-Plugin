function get_tinymce_content(id) {
    var content;
    var inputid = id;
    var editor = tinyMCE.get(inputid);
    var textArea = jQuery('textarea#' + inputid);    
    if (textArea.length>0 && textArea.is(':visible')) {
        content = textArea.val();        
    } else {
        content = editor.getContent();
    }    
    return content;
}


if( jQuery('.color_picker').length > 0 ) jQuery('.color_picker').wpColorPicker();

jQuery(document).on('click', '#updateSettings', function(){

    let pluginEnable = jQuery(document).find('#pluginEnable').is(':checked');
    let modalClose = jQuery(document).find('#modalClose').is(':checked');
    let numberOfVisits = jQuery(document).find('#numberofTimesUserVisit').val();
    let redirectURL = jQuery(document).find('#redirectURL').val();
    let loginURL = jQuery(document).find('#loginURL').val();
    let modalColor = jQuery(document).find('#modalColor').val();
    let restrictionType = jQuery(document).find("input[name='restrictionType']:checked").val();
    let restrictionMessage = get_tinymce_content('restriction_message');

    let snackbarContainer = document.querySelector('#crp_alert');

    if( jQuery(document).find('#numberofTimesUserVisit').parent().hasClass("is-invalid") || numberOfVisits.length <= 0 ){
        snackbarContainer.MaterialSnackbar.showSnackbar({
            message: "Number of visits is the required field.",
            timeout: 2000
        });
        jQuery(document).find('#numberofTimesUserVisit').parent().addClass("is-invalid");
        return false;
    }

    if( restrictionType == 'message' ){
        if( restrictionMessage.length <= 0 ){
            snackbarContainer.MaterialSnackbar.showSnackbar({
                message: "Restriction Message is Required.",
                timeout: 2000
            });
            return false;
        }

        if( jQuery(document).find('#loginURL').parent().hasClass("is-invalid") || loginURL.length <= 0 ){
            snackbarContainer.MaterialSnackbar.showSnackbar({
                message: "Invalid Login URL.",
                timeout: 2000
            });
            jQuery(document).find('#loginURL').parent().addClass("is-invalid");
            return false;
        }
    }else if( restrictionType == 'redirect' ){
        if( jQuery(document).find('#redirectURL').parent().hasClass("is-invalid") || redirectURL.length <= 0 ){
            snackbarContainer.MaterialSnackbar.showSnackbar({
                message: "Redirect URL is Required.",
                timeout: 2000
            });
            jQuery(document).find('#redirectURL').parent().addClass("is-invalid");
            return false;
        }
    }

    let applyFor = [];
    jQuery(document).find('.checkbox_wrapper').find('input').each(function(){
        let checked = jQuery(this).is(":checked");
        if( checked ){
            applyFor.push(jQuery(this).val());
        }
    });

    let button = jQuery(this);
    button.html('Updating . . .').attr('disabled', true);

    jQuery.post(ajaxurl, {
        action : "crp_settings",
        data : JSON.stringify({
            pluginEnable : pluginEnable,
            numberOfVisits : numberOfVisits,
            redirectURL : redirectURL,
            restrictionType : restrictionType,
            restrictionMessage : restrictionMessage,
            modalColor : modalColor,
            modalClose : modalClose,
            loginURL : loginURL,
            applyFor : applyFor
        })
    }).done(function(response){ 
        snackbarContainer.MaterialSnackbar.showSnackbar({
            message: response.toString(),
            timeout: 2000
        });
        button.html('Update Settings').attr('disabled', false);
    }).fail(function(xhr, status, error) {
        snackbarContainer.MaterialSnackbar.showSnackbar({
            message: error.toString(),
            timeout: 2000
        });
        button.html('Update Settings').attr('disabled', false);
    });


    
});