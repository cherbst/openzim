function initTinyMce () {
        tinyMCE.init({
        	mode : "textareas",
	        theme : "advanced",
		theme_advanced_buttons1 : "bold,italic,underline,|,undo,redo,|,cut,copy,pastetext,|,newdocument,tinyautosave,|,fullscreen",
	        theme_advanced_buttons2 : "",
	        theme_advanced_buttons3 : "",
	        plugins: "autosave, tinyautosave, paste,fullscreen",
		paste_auto_cleanup_on_paste : true,
	        entity_encoding : "raw",
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_path : false,
//		theme_advanced_statusbar_location : "bottom",
		paste_preprocess : function(pl, o) {
        		o.content = o.content.replace(/&nbsp;/gi, ' '); 
		},
		width: '100%',
		height: '200',
		valid_elements : "-strong/b,p,-em,-span[style:text-decoration: underline;]"
	});
}

$(document).ready(function()
{
  initTinyMce();
  $(document).ajaxComplete(function()
  {
    initTinyMce();
  });
});
