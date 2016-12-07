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
      this.tables[0].headers.push({name: a});
      return;
    },
    addRow : function() {
      var a = {};
      this.tables[0].rows.push(a);
      return;
    },
    editHeader : function(t, i) {
      this.editingHeader = {
        a : true, 
        n : this.tables[0].headers[i].name,
        i : i
      };
      var self = this;
      document.getElementById('modal-header-input').onkeypress = function(e){
        if (!e) e = window.event;
        var keyCode = e.keyCode || e.which;
        if (keyCode == '13'){
          e.preventDefault();
          self.updateHeader(self.editingHeader.i, self.editingHeader.n);
          return false;
        }
      }
    },
    updateHeader : function(i, n){
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
      var self = this;
      document.getElementById('modal-cell-input').onkeypress = function(e){
        if (!e) e = window.event;
        var keyCode = e.keyCode || e.which;
        if (keyCode == '13'){
          e.preventDefault();
          self.updateCell(self.editingCell.r, self.editingCell.h, self.editingCell.n );
          return false;
        }
      }
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
    returnString : function() {
      return JSON.stringify(this.tables);
    }
  }
});