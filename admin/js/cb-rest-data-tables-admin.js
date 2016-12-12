(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

// Function to add 'move' ability to arrays
// Source: http://stackoverflow.com/a/5306832
Array.prototype.move = function (old_index, new_index) {
    while (old_index < 0) {
        old_index += this.length;
    }
    while (new_index < 0) {
        new_index += this.length;
    }
    if (new_index >= this.length) {
        var k = new_index - this.length;
        while ((k--) + 1) {
            this.push(undefined);
        }
    }
    this.splice(new_index, 0, this.splice(old_index, 1)[0]);
    return this; // for testing purposes
};


var app = new Vue({
  el: '#app',
  data: {
    tables : JSON.parse(cb_rest_tables.tables),
    showModal: false,
    editingHeader : {
      a : false,
      n : '',
      i : 0
    },
    editingCell : {
      a : false,
      n : '',
      r : 0,
      h : 0
    }
  },
  methods: {
    addColumn : function() {
      var a = prompt('Column Title:');
      if(!this.columnAvailable(a)){
        return;
      }
      this.tables[0].headers.push({name: a});
      return;
    },
    
    addRow : function() {
      var a = {};
      this.tables[0].rows.push(a);
      return;
    },
    
    editHeader : function(i) {
      this.editingHeader = {
        a : true, 
        n : this.tables[0].headers[i].name,
        i : i
      };
//      $('#modal-header-input').submitTarget('#modal-header-submit'); 
//      $('#modal-header-submit').submitTarget('#modal-header-submit'); 
    },
    
    updateHeader : function(i, n){
      if(!this.columnAvailable(n)){
        return;
      }
      this.$set(this.tables[0].headers[i], 'name', n);
      this.closeModals();
    },
    
    editCell : function(r, h) {
      this.editingCell = {
        a : true, 
        n : this.tables[0].rows[r][h],
        r : r,
        h : h,
      };
//      $('#modal-cell-input').submitTarget('#modal-cell-submit'); 
//      $('#modal-cell-submit').submitTarget('#modal-cell-submit'); 
    },
    
    updateCell : function(r, h, n){
      this.$set(this.tables[0].rows[r], h, n);
      this.closeModals();
    },
    
    closeModals : function(){
      this.editingHeader = {
        a : false,
        n : '',
        i : 0
      };
      this.editingCell = {
        a : false,
        n : '',
        r : 0,
        h : 0
      };
    },
    
    deleteRow : function(r){
      this.tables[0].rows.splice(r, 1);
    },
    
    deleteColumn : function(hi, h){
      var self = this;
      this.tables[0].rows.forEach(function(row, index){
        if(self.tables[0].rows[index][h.name]){
          delete self.tables[0].rows[index][h.name];
        }
      });
      this.tables[0].headers.splice(hi, 1);
    },
    
    columnAvailable : function(n){
      var r = true;
      this.tables[0].headers.forEach(function(h){
        if(h.name === n){
          alert('Name Already In Use');
          r = false;
          return;
        }
      });
      return r;
    },
    
    returnString : function() {
      return JSON.stringify(this.tables);
    }
  }
});


Vue.config.devtools = true;