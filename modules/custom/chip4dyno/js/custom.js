(function($) {
function getChilds(parent_id, element_id, defaultText, defaultValue) {
    var options = '<option value="'+defaultValue+'">Loading...</option>';
    jQuery(element_id).html(options);
    jQuery.ajax({
	type:"post",
        url:"/chip4dyno/"+parent_id+'/0',
	cache:true,
        dataType:'json',
	success:function(data)
	{
            var options = '<option value="'+defaultValue+'">Choose '+defaultText+'</option>';
            if (data.result)
            {
                jQuery.each(data.result,function(id,name) {
                   options+='<option value="'+id+'">'+name+'</option>'; 
                });
             }
            jQuery(element_id).html(options);
    
	}
	});
}    
Drupal.behaviors.custom = {
  attach: function (context, settings) {
    //
    if (jQuery("#edit-field-make-target-id option").length <= 1) {
        getChilds(0, '#edit-field-make-target-id', 'Make', 'All');
    }
    jQuery("#edit-field-make").change(function(){
        jQuery("#edit-field-model").find('option').not(':first').remove();
        jQuery("#edit-field-generation").find('option').not(':first').remove();
        jQuery("#edit-field-engine").find('option').not(':first').remove();
        jQuery("#edit-field-ecu").find('option').not(':first').remove();
        var id = jQuery(this).val();
        console.log(id);
        if (id != '_none') {
            getChilds(id,'#edit-field-model','Model','_none');
        }

    });
    jQuery("#edit-field-model").change(function(){
       jQuery("#edit-field-generation").find('option').not(':first').remove();
       jQuery("#edit-field-engine").find('option').not(':first').remove();
       jQuery("#edit-field-ecu").find('option').not(':first').remove();
        var id = jQuery(this).val();
        console.log(id);
        if (id != '_none') {
            getChilds(id,'#edit-field-generation','Generation','_none');
        }
    });
    jQuery("#edit-field-generation").change(function(){
       jQuery("#edit-field-engine").find('option').not(':first').remove();
       jQuery("#edit-field-ecu").find('option').not(':first').remove();
        var id = jQuery(this).val();
        console.log(id);
        if (id != '_none') {
            getChilds(id,'#edit-field-engine','Engine','_none');
        }
    });
    jQuery("#edit-field-engine").change(function(){
       jQuery("#edit-field-ecu").find('option').not(':first').remove();
        var id = jQuery(this).val();
        console.log(id);
        if (id != '_none') {
            getChilds(id,'#edit-field-ecu','ECU','_none');
        }
    });
    jQuery(".form-item-field-email-list #edit-field-email-list").change(function(){
        var val = jQuery(this).val();
        if (val == 'other') {
            jQuery(".js-form-item-field-email-0-value").show();
        } else {
            jQuery(".js-form-item-field-email-0-value").hide();
            jQuery("#edit-field-email-0-value").val('');

        }
    });
    
    //Search tuning file
    jQuery("#edit-field-make-target-id").change(function(){
        jQuery("#edit-field-model-target-id").find('option').not(':first').remove();
        jQuery("#edit-field-generation-target-id").find('option').not(':first').remove();
        jQuery("#edit-field-engine-target-id").find('option').not(':first').remove();
        var id = jQuery(this).val();
        console.log(id);
        if (id != 'All') {
            getChilds(id,'#edit-field-model-target-id','Model','All');
        }

    });
    jQuery("#edit-field-model-target-id").change(function(){
       jQuery("#edit-field-generation-target-id").find('option').not(':first').remove();
       jQuery("#edit-field-engine-target-id").find('option').not(':first').remove();
        var id = jQuery(this).val();
        console.log(id);
        if (id != 'All') {
            getChilds(id,'#edit-field-generation-target-id','Generation','All');
        }
    });
    jQuery("#edit-field-generation-target-id").change(function(){
       jQuery("#edit-field-engine-target-id").find('option').not(':first').remove();
        var id = jQuery(this).val();
        console.log(id);
        if (id != 'All') {
            getChilds(id,'#edit-field-engine-target-id','Engine','All');
        }
    });
    //Other Email field
    jQuery(".form-item-field-email-list #edit-field-email-list").change(function(){
        var val = jQuery(this).val();
        if (val == 'other') {
            jQuery(".js-form-item-field-email-0-value").show();
        } else {
            jQuery(".js-form-item-field-email-0-value").hide();
            jQuery("#edit-field-email-0-value").val('');

        }
    });
    
    jQuery("#edit-field-tuning-type").change(function(){
        var id = jQuery(this).val();
        jQuery("#edit-field-tuning-options--wrapper").hide();
        jQuery("#edit-field-tuning-options--wrapper .fieldset-wrapper").html('');
        if (id != '_none') {
        jQuery.ajax({
            type:"post",
            url:"/chip4dyno/tuning-options/"+id,
            cache:true,
            dataType:'json',
            success:function(data)
            {
                if (data.result == 'no_result') {
                    jQuery("#edit-field-tuning-options--wrapper").hide();
                }
                else {
                    jQuery("#edit-field-tuning-options--wrapper").show();
                    jQuery("#edit-field-tuning-options--wrapper .fieldset-wrapper").html(data.result);
                }
            }
            });
        }
    });
  }
}
})(jQuery);