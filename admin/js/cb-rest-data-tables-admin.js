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
    tables : JSON.parse(cb_rest_tables.tables)

  },
  methods: {
    addColumn : function(t) {
      var a = prompt('Column Title:');
      this.tables[t].headers.push({name: a});
      return;
    },
    addRow : function(t) {
      var a = {};
      // this.headers.forEach(function(e, i){
      //   a[e.name] = prompt(e.name);
      // });
      this.tables[t].rows.push(a);
      return;
    },
     editHeader : function(t, i) {
       var a = prompt('Update Header:', this.tables[t].headers[i].name);
       this.$set(this.tables[t].headers[i], 'name', a);
       return;
     },
    editCell : function(t, r, h) {
      var a = prompt('Update Cell:', this.tables[t].rows[r][h]);
      this.$set(this.tables[t].rows[r], h, a);
      // this.rows[r][this.headers[h].name] = a;
      return;
    },
    returnString : function() {
      return JSON.stringify(this.tables);
    }
  }
});