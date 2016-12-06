<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://briancoords.com
 * @since      1.0.0
 *
 * @package    Cb_Rest_Data_Tables
 * @subpackage Cb_Rest_Data_Tables/admin/partials
 */
?>
<form action=""></form>
<div id="app" class="wrap">
  <div class="panel" v-for="(table, tIndex) in tables">
    <h3>{{table.name}}</h3>
    <table class="form-table">
      <tbody>
        <tr class="row">
          <td class="cell" v-for="(header, index) in table.headers">
            <strong>{{header.name}} <span v-on:click="editHeader(tIndex, index)" class="edit-link">&#9998;</span></strong> 
          </td>
          <td class="cell">
            <button v-on:click="addColumn(tIndex)" class="button">+ADD COLUMN</button>
          </td>
        </tr>
        <tr class="row" v-for="(row, rIndex) in table.rows">
          <td class="cell" v-for="(header, hIndex) in table.headers">
            {{row[hIndex]}} <span v-on:click="editCell(tIndex, rIndex, hIndex)" class="edit-link">&#9998;</span>
          </td>
        </tr>
        <tr class="row">
          <td class="cell">
            <button v-on:click="addRow(tIndex)" class="button">+ADD ROW</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="panel">
    <input type="hidden" v-model="returnString()">
<!--    <button class="button button-primary">Save All Changes</button>-->
    <?php submit_button(); ?>
  </div>
</div>