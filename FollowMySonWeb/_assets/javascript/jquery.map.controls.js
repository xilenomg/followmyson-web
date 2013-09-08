/**
 * Author: Luis Felipe Corrêa Pérez
 * Date: Mon, Sep 2 2013
*/
;

$.fn.mapControl = function(options){
	var controlCollection = $(this);
    
    this.each(function(){
    	var settings = $.extend({
            controlCollection: controlCollection,
        }, options);
    	
    	
    }
}