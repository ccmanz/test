<?php

/*
Plugin Name: My Hello World Plugin
Plugin URI: http://ccmanz.url.ph
Description: Basic Hello World Plugin
Author: Carl
Version: 1.0
Author URI: http://ccmanz.url.ph
*/


//register Plugin Admin Menu
add_action('admin_menu','hello_world_plugin');
function hello_world_plugin (){
	add_menu_page('Hello Page','Hello World','manage_options',__FILE__,'Hello_Admin');
	add_submenu_page( __FILE__,'Hello Submenu','Hi', 'manage_options',__FILE__.'_menu1', Hi_submenu );
}

//Insert Data into Database
global $wpdb;
$first = $_POST['firstname'];
$last = $_POST['lastname'];
	if(isset($_POST['Submit'])) {
		$wpdb->insert("wp_options", array(
			"option_name" => $first,
			"option_value" => $last
			)
		);
		echo '<script language="javascript">';
		echo 'alert("Data Submitted!")';
		echo '</script>';
	}

	
//Hello Menu
function Hello_Admin() {	
?>
	<div class = "wrap">
	<h1>Hello World!<?php 
	print $firstname;
	?></h1>
	</div>
	<form method="POST">
	
	<input type = "submit" name = "Display" value ="Display Data from (wp_options)" class = "button-primary"/><br><br>
	<textarea readonly cols="50" rows="15" name="comment"><?php 
		global $wpdb;
		if(isset($_POST['Display'])) {
		$result = $wpdb->get_results (
					"
					SELECT * FROM wp_options
					WHERE option_id = '540' 
					"
			);
		
			foreach($result as $names){

				$firstname=$names->option_name;
				$lastname=$names->option_value;
			}
		}
		print_r($result);
		


	?></textarea><br>
	<input type = "button" value="Clear" class="button-primary" onclick="this.form.elements['comment'].value='' ">
	</form>
	<h1>Hello <?php echo $firstname . '&nbsp'; echo $lastname; ?>!</h1?
<?php
	
}

//Hi Submenu
function Hi_Submenu(){

	echo '<h2>Enter First Name and Last Name</h2>';
	echo '<br><br><form action = "" method = "POST">';
	echo '<input type="text" name="firstname" placeholder="First Name" required><br>';
	echo '<input type="text" name="lastname" placeholder="Last Name" required><br><br>';
	echo '<input type = "submit" name = "Submit" value ="Submit to (wp_options)" class = "button-primary"><br><br>';
	echo '</form><br>';



}

					
?>




