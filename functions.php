<?php   

// language support
function cpanelping_textdomain() {
  load_plugin_textdomain( 'cpp-widgets', false, dirname( plugin_basename( __FILE__ ) ) . '/language/' );
}

// user menus
function cpanelping_fp_panel_menu() {
    if(current_user_can('manage_options'))
    
    // enable panel menu 
    $icon_url_panel = "dashicons-analytics";
    $position_panel = "99"; 
    add_menu_page('CPP Widgets', 'CPP Widgets', 'manage_options', __FILE__, 'cpanelping_fp_panel', $icon_url_panel, $position_panel);
    
}

// on-off buttons
function cpanelping_is_checked($par){
    if (isset($_POST["cpanelping_panel"])) { if(isset($_POST[$par])) $k='checked';else $k=''; update_option($par,$k);} 
}

// input fields
function cpanelping_string_setting($par,$def){
    if (isset($_POST[$par])) { if(isset($_POST[$par]) and $_POST[$par]!='' ) $k=$_POST[$par];else $k=$def; update_option($par,$k);} 
}

// panel page css
function cpanelping_panel_style(){
    wp_register_style( 'cpanelping_wp_admin_css', plugins_url( 'styles/panel.css' , __FILE__ ), false, '1.0.0' );
    wp_enqueue_style( 'cpanelping_wp_admin_css' );
}

//add server monitor widget
function dashboard_add_server_monitor_widget() {

	wp_add_dashboard_widget(
            'dashboard_server_monitor', //Widget slug
            'Server Monitor', //Title
            'dashboard_server_monitor_widget' //Display function
        );	
}

function dashboard_server_monitor_widget() { 
    $monitor_url = get_option("cpanelping_monitor_url");
    echo "<iframe name='checkstatus' src='$monitor_url' marginwidth='1' marginheight='0' height='450' width='100%' border='0' frameborder='0'></iframe>";
}

function frontend_server_monitor_widget() { 
    $monitor_url = get_option("cpanelping_monitor_url");
    echo "<iframe name='checkstatus' src='$monitor_url/widget' marginwidth='1' marginheight='0' height='70' width='100%' border='0' frameborder='0'></iframe>";
}

// Creating the widget
// for the frontend 
class cpp_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'cpp_widget', 

// Widget name will appear in UI
__('Monitor Ports', 'cpp-widgets'), 

// Widget description
array( 'description' => __( 'Display uptime status on the frontend.', 'cpp-widgets' ), ) 
);
}

// Creating widget front-end
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
echo frontend_server_monitor_widget();
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Monitor Ports', 'cpp-widgets' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class cpp_widget ends here

// Register the widget
function cpp_load_widget() {
	register_widget( 'cpp_widget' );
}