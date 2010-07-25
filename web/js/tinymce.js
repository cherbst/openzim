
var openZIMtinyMce = {

	config : {
	        theme : "advanced",
		theme_advanced_buttons1 : "bold,italic,underline,|,numlist,bullist,|,undo,redo,|,cut,copy,pastetext,|,newdocument,tinyautosave,|,fullscreen",
	        theme_advanced_buttons2 : "",
	        theme_advanced_buttons3 : "",
	        plugins: "autosave, tinyautosave, paste,fullscreen",
		paste_auto_cleanup_on_paste : true,
	        entity_encoding : "raw",
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_path : false,
		cleanup_on_startup : true,
//		theme_advanced_statusbar_location : "bottom",
		paste_preprocess : function(pl, o) {
        		o.content = o.content.replace(/&nbsp;/gi, ' '); 
		},
		width: '100%',
		height: '200',
		valid_elements : "-strong/b,-ol,-ul,li,p,-em,-span[style:text-decoration: underline;]"
       	},

	configNoNumbering : {
		theme_advanced_buttons1 : "bold,italic,underline,undo,redo,|,cut,copy,pastetext,|,newdocument,tinyautosave,|,fullscreen",
		valid_elements : "-strong/b,p,-em,-span[style:text-decoration: underline;]"
	},

	customAddEditor : function ( config, elmID ) {

    		// create a new instance from calling element
		e = new tinymce.Editor(elmID, config );
		e.render();
		tinyMCE.add(e);
	},

	setup : function () {
	  var self = this;		
	  $('textarea').each(function(){
		if ( $(this).hasClass('nonumbering')){
			var config = $.extend({},self.config,self.configNoNumbering);
			self.customAddEditor(config, this.id); 
		}else
			self.customAddEditor(self.config, this.id); 
	  });
	} 
}



$(document).ready(function()
{
  openZIMtinyMce.setup();
  $(document).ajaxComplete(function()
  {
    openZIMtinyMce.setup();
  });
});
