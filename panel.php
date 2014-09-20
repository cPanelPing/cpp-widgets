<?php

function cpanelping_fp_panel() {

    cpanelping_string_setting("cpanelping_monitor_url",'');
 
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div><h2><?php _e( 'cPanelPing Widgets', 'cpp-widgets' ); ?></h2>

<form action="" method="post">

<div id="poststuff">
<div class="postbox">
<table class="form-table">
<tbody>

<h3><?php _e( 'Your Monitor', 'cpp-widgets' ); ?></h3>

<tr valign="top">
<th scope="row"><label for="home"><?php _e( 'Address', 'cpp-widgets' ); ?> <span style="font-weight:normal"><?php _e( '(required)', 'cpp-widgets' ); ?></span></label></th>
<td>
<label for="cpanelping_monitor_url">
<input type="text" name="cpanelping_monitor_url" value="<?php echo get_option("cpanelping_monitor_url");?>" placeholder="<?php _ex( 'http://my.cpanelping.com/yourpage', 'placeholder text', 'cpp-widgets' ); ?>" style="margin-left:5px;margin-right:5px;width:300px">
</label>
<span style="margin-left:5px;margin-right:5px;font-size:small"><?php _e( "Type your public monitor page url.", 'cpp-widgets' ); ?></span><br />
<div style="font-size:small;border:1px dotted #e1e1e1;margin-left:5px;margin-right:5px;margin-top:15px;padding:5px;">
<?php _e( 'You can retreive your public monitor url from your cPanelPing.com <b>Settings</b> page. Enter for example, <code>http://my.cpanelping.com/yourpage</code>. Please make sure you enter the full url to your public monitor including the <code>http://</code>.', 'cpp-widgets' ); ?><br />
<br />
<?php _e( 'Please note, you must have your public monitor enabled for this to work. To enable it, turn it <code>ON</code> from within your cPanelPing.com <b>Settings</b> page.', 'cpp-widgets' ); ?>
</div>
</td
</tr>

</tbody></table>
</div></div>

<p style="border-bottom: 1px dashed #CCCCCC;padding-bottom: 20px">
<input type="hidden" name="cpanelping_panel" value="1">
<input type="submit" class="button button-primary" value="<?php _e( 'Save Changes', 'cpp-widgets' ); ?>">
</p>

</form>
<style>
th label{padding-left:10px}
th,td{border-left: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1;border-top: 1px solid #e1e1e1}
h3{color:#464646}
input{font-size: 14px}
.form-table{margin-top: 0px}
.thickbox {opacity:1.0}
.thickbox:hover {opacity:0.7}
#range_one {font-weight:bold}
</style>
</div>
<?php

}//end: cpanelping_fp_panel