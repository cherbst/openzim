/* 
 * Author: Christoph Herbst 
 * Date: 07.2010
 *
 */

var openZIMformsave = {
        autosave : 900000,
	doSave: function() {
      	     $('.form_loader').show();
      
	      // do not do ajax call if there are any
	      // non-empty file inputs
	      if ( $("input:file[value|='']").length > 0 )
		return true;
	
	      tinyMCE.triggerSave(); 
	      $('#form_data').load(
	        $('#ajax_form').attr('action') + ' #form_data',
	        $('#ajax_form').serializeArray(),
	         function() { $('.form_loader').hide(); }
	      );
	      return false;
	},

	cancel: function() {
	    if(typeof this.timeoutID == "number") {
	      window.clearTimeout(this.timeoutID);
	      delete this.timeoutID;
	    }
	},

	setTimeout: function() {
	  var self = this;
	  self.cancel();
	  self.timeoutID = window.setTimeout(function(){
	  			$('#ajax_form').submit();
			   }, self.autosave);
	},

	setup: function() {
	  var self = this;
	  self.setTimeout();
	  $('#ajax_form').submit(function()
  	  {
		self.setTimeout();
		return self.doSave();
	  });
	}
}

$(document).ready(function()
{
	openZIMformsave.setup();
});

