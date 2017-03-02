/*
SMF Garage (http://www.smfgarage.com)
Version 2.0
smfg_ajax.js
*/

window.addEvent('domready', function(){
    var rebuild_statusFX = new Fx.Slide('rebuild_images_status');
    rebuild_statusFX.hide();
    
    $('smfg_rebuild_images_form').addEvent('submit', function(e) {
    new Event(e).stop();
    var rebuild_status = $('rebuild_images_status');
    rebuild_statusFX.slideIn();
    var form_html = document.getElementById("smfg_rebuild_images_form").innerHTML;
    document.getElementById("smfg_rebuild_images_form").innerHTML = '<br />'+form_html;
    $('rebuild_form_submit').setProperty('value', 'Please wait...');
    $('rebuild_form_submit').setProperty('disabled', true);
    // moved to template so we could use windowbg2 to keep styling consistent with themes
    //$('rebuild_images_status').setStyles('background: #CCCCCC; border: 1px dashed #000; text-align: center; width: 40%; margin-left: auto; margin-right: auto;');
    this.send({
    evalScripts: true,
    update: rebuild_status,
    onComplete: function() {
        rebuild_status.removeClass('ajax-loading');
        }
        });
    });
});

function update_rebuild_status(url){        
//$('rebuild_images_status').setText(current_file);
  new Ajax(url, {
    method: 'get',
    update: $('rebuild_images_status')
  }).request();
}
