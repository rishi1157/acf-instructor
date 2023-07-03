jQuery(document).ready(function ($) {

  $.ajax({
    url: ajax_object.ajax_url,
    type: 'POST',
    data: {
      action: 'my_ajax_action'
    },
    success: function (response) {
      $('div.mantine-Text-root.ir-parent-settings.mantine-1ic9apo').append(response);

      acf.do_action('append', $('#popup-id'));
    },
    error: function (errorThrown) {
      console.log('Error:', errorThrown);
    }
  });

  jQuery(".mantine-UnstyledButton-root.mantine-Button-root.ir-publish.ir-btn-filled.mantine-g0wba").click(function (event) {
    event.preventDefault();
    var form_data = { "action": "save_app_data)" };
    jQuery("form#acf-form :input").each(function () {
      form_data[jQuery(this).attr("name")] = jQuery(this).val();
    });
    jQuery.post(ajax_object.ajax_url, form_data)
      .done(function (data) {
      console.log(data);
  
      });
    //console.log("Hey ww");
    //document.getElementById('acf-form').submit();
  });

  
});
