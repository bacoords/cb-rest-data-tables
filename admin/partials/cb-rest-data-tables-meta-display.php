<?php

/**
 * Provide a meta box view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://briancoords.com
 * @since      1.0.0
 *
 * @package    Cb_Rest_Data_Tables
 * @subpackage Cb_Rest_Data_Tables/admin/partials
 */

  // Get post meta as JSON object
  wp_localize_script( $this->plugin_name, 'cb_rest_tables', array(
    'tables' => get_post_meta($post->ID, '_cb_rest_table')
  ));


  // Set our Nonce for updating
  wp_nonce_field('cb_rest_tables_nonce', 'cb_rest_tables_nonce');

  // Set up API Url
  $rest_url = get_site_url() . '/wp-json/wp/v2/tables/' . $post->ID;


?>


<div id="app" class="cb-rest-tables">
  
  <div class="cb-panel cb-panel__header">
    <button type="button" v-on:click="addColumn()" class="button">+ADD COLUMN</button>
    <button type="button" v-on:click="addRow()" class="button">+ADD ROW</button>
    <a class="button" href="<?php echo $rest_url; ?>" target="_blank">VIEW REST URL</a>
  </div>

  <div class="cb-panel" v-for="(table, tIndex) in tables">
    <table>
      <tbody>
       
        <tr class="row">
          <th class="cell"><br></th>
          <th class="cell" v-for="(header, index) in table.headers">
            <strong>{{header.name}} <span v-on:click="deleteColumn(index, header)" class="edit-link">&#10060;</span> <span v-on:click="editHeader(index)" class="edit-link">&#9999;</span></strong> 
          </th>
        </tr>
        
        <tr class="row" v-for="(row, rIndex) in table.rows">
          <td class="cell">
            {{rIndex + 1}}
            <span v-on:click="deleteRow(rIndex)" class="edit-link">&#10060;</span> 
          </td>
          <td class="cell" v-for="(header, hIndex) in table.headers">
            {{row[header.name]}} <span v-on:click="editCell(rIndex, header.name)" class="edit-link">&#9999;</span>
          </td>
        </tr>
        
      </tbody>
    </table>
  </div>

  <div v-if="editingCell.a" transition="modal">    
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <h3>
              Update Cell
            </h3>
          </div>

          <div class="modal-body">
            <div>
              <input type="text" v-model="editingCell.n" id="modal-cell-input">
            </div>
          </div>

          <div class="modal-footer">
            <div>
              <button type="button" id="modal-cell-submit" class="button-primary modal-default-button" @click="updateCell(editingCell.r, editingCell.h, editingCell.n)">
                OK
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div v-if="editingHeader.a" transition="modal">    
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <h3>
              Update Header
            </h3>
          </div>

          <div class="modal-body">
            <div>
              <input type="text" v-model="editingHeader.n" id="modal-header-input">
            </div>
          </div>

          <div class="modal-footer">
            <div>
              <button type="button" id="modal-header-submit" class="button-primary modal-default-button" @click="updateHeader(editingHeader.i, editingHeader.n)">
                OK
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
            
  <input type="hidden" name="_cb_rest_tables_previous" value="<?php get_post_meta($post->ID, '_cb_rest_table') ?>">
  <input type="hidden" v-model="returnString()" name="_cb_rest_tables_hidden">

</div>
