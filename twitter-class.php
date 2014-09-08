<?php
// Specify Hooks/Filters
add_action('admin_init', 'cardsoptions_init_fn' );
add_action('admin_menu', 'cardsoptions_add_page_fn');

// Register our settings. Add the settings section, and settings fields
function cardsoptions_init_fn(){
	register_setting('cards_options', 'cards_options', 'cards_options_validate' );
	add_settings_section('main_section', 'Configuracion', 'section_text_fn', 'twitter-cards-option');
	add_settings_field('plugin_twitter_username', 'Twitter Username:', 'setting_string_fn', 'twitter-cards-option', 'main_section');
}

// Add sub page to the Settings Menu
function cardsoptions_add_page_fn() {
	add_options_page('WP Twitter Cards Shop', 'WP Twitter Cards Shop', 'administrator', 'twitter-cards-option', 'options_page_fn');
}

// ************************************************************************************************************

// Callback functions

// Section HTML, displayed before the first option
function  section_text_fn() {
	echo '<p></p>';
}


// TEXTBOX - Name: cards_options[twitter_username]
function setting_string_fn() {
	$options = get_option('cards_options');
	echo "<input id='plugin_twitter_username' name='cards_options[twitter_username]' size='40' type='text' value='{$options['twitter_username']}' />";
}

// Display the admin options page
function options_page_fn() {
?>
	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Twitter Cards Shops</h2>
		<b>Plugin Diseñado para generar Cards Automaticas en las Tiendas E-Commerces Wordpress.</b><p>
		Con Twitter Cards, puede adjuntar rica fotos, videos y experiencia multimedia a los 
		Tweets que dirigir el tráfico a su sitio web. Basta con añadir unas pocas líneas de 
		HTML a su página web, y los usuarios que Tweet enlaces a su contenido tendrán una
		<b>"tarjeta"</b> añaden al Tweet que es visible a todos sus seguidores. </p>
		<p> Leer mas <a href="https://dev.twitter.com/docs/cards/types/product-card"> Cards - Product-Card</a></p>
		<form action="options.php" method="post">
		<?php settings_fields('cards_options'); ?>
		<?php do_settings_sections('twitter-cards-option'); ?>
		<p class="submit">
			<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		</p>
		</form>
	</div>
<?php
}

// Validate user data for some/all of your input fields
function cards_options_validate($input) {
	// Check our textbox option field contains no HTML tags - if so strip them out
	$input['twitter_username'] =  wp_filter_nohtml_kses($input['twitter_username']);	
	return $input; // return validated input
}