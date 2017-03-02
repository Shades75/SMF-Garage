/*
SMF Garage (http://www.smfgarage.com)
Version 2.0
smfg_eip.js
*/

/************************************
       SMF Garage Edit in Place
       V1.0
       Programmed by Joe Vasquez
       http://www.joevasquez.info       
*************************************/

//Original code based off of...
/************************************
     Edit in Place for Mootools
      Programmed by Renzoster
     http://www.etececlub.com      
*************************************
  Please do not remove this credits
*************************************/

window.addEvent('domready', function() {
    init();
});

var ajax_url = "index.php?action=garage;sa=update_text";
var txt_empty = "Double-click to edit";
var image_status_div = "updateStatus";
var video_status_div = "updateStatus2";

function init(){
    var tags = ['p', 'div', 'span'];
    tags.forEach(function(eli){
        $$(eli).each(function(el){
            if (el.innerHTML == '' && el.getProperty('class') == 'editin'){
                el.setHTML(txt_empty);
            }
            if (el.getProperty('class') == 'editin'){
                makeEditable(el.getProperty('id'));
            }
        });
    });
}

function updateStatus(obj, message){
    if (image_status_div != "" && obj.test("image")){
    var eip_status = image_status_div;
    }else if(video_status_div != "" && obj.test("video")){
    var eip_status = video_status_div;
    }else{
    var eip_status = obj;
    }
    $(eip_status).innerHTML = message;
}

function makeEditable(id){
    $(id).addEvent('dblclick', function(e){
        edit(id);
    });
    $(id).addEvent('mouseover', function(e){
        showAsEditable(id);
    });
    $(id).addEvent('mouseout', function(e){
        showAsEditable(id, true);
    });
}

function selectall(obj){
    $(obj).focus();
    $(obj).select();
} 

function edit(obj){
    $(obj).setOpacity(0);
    $(obj).setStyle('visibility','hidden');
    $(obj).setStyle('display','none');
    
    var valor = $(obj).getText();
    
    if(valor == txt_empty){
    var textarea = '<textarea id="'+obj+'_edit" name="'+obj+'" rows="1" cols="30" style="overflow: hidden;"></textarea>';
    } else {
    var textarea = '<textarea id="'+obj+'_edit" name="'+obj+'" rows="1" cols="30" style="overflow: hidden;">'+valor+'</textarea>';
    }
    
    ndiv = new Element('div',{id: obj+'_editor'}).setHTML(textarea);
    
    ndiv.injectAfter(obj);    
    selectall(obj+'_edit');
    //check all keys pressed on the text area
    $(obj+'_edit').addEvent('keydown', function(event){
    event = new Event(event);
    //enter and tab keys save the changes
    //if(event.key == 'enter' || event.key == 'tab'){
    if(event.key == 'tab'){
    saveChanges(obj);
    }
 
    //esc cancels the changes
    if(event.key == 'esc'){
    cleanUp(obj);
    updateStatus(obj, "Changes have been discarded.");
    }
    });//end check keys pressed
    
    //mouse leave saves
    $(obj+'_edit').addEvent('blur', function(event){
    event = new Event(event);
    saveChanges(obj);
    });
}

function showAsEditable(obj, clear){
    if (!clear){
        $(obj).addClass('editable');
    }else{
        $(obj).removeClass('editable');
    }
}

function saveChanges(obj){
    var new_content = escape($(obj+'_edit').getValue());
    successful_content = $(obj+'_edit').getValue();

    updateStatus(obj, "Saving...");
    cleanUp(obj, true);

    var success = function(t){editComplete(t, obj);}
    var failure = function(t){editFailed(t, obj);}
    var checkajax = function(t){CheckAjaxOutput(t, obj);}

    var pars = 'id='+obj+'&content='+new_content;
    var myAjax = new Ajax(ajax_url, {
      method: 'post', 
      data: pars, 
      onComplete: checkajax,
      onFailure: failure});
    myAjax.request();
}

function cleanUp(obj, keepEditable){
    $(obj+'_editor').remove();
    $(obj).setOpacity(1);
    $(obj).setStyle('visibility','');
    $(obj).setStyle('display','');
    if (!keepEditable) showAsEditable(obj, true);
}

function CheckAjaxOutput(t, obj){
    if (t == "1"){
    editComplete(t, obj);
    }else{
    editFailed(t, obj);
    }
}

function editComplete(t, obj){
    updateStatus(obj, "Changes saved!");
    $(obj).innerHTML = successful_content;
    showAsEditable(obj, true);
}

function editFailed(t, obj){
    updateStatus(obj, "Changes were not saved.");
//    cleanUp(obj);
}