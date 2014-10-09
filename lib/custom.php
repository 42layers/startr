<?php
global $theme_options;
/**
 * Custom functions
 */

// GA Hook
add_action('wp_footer', 'statrAnalytics');

// Google Analytics Code
function statrAnalytics() {
	global $theme_options;
	echo $theme_options['google-analytics'];
}

/*
 *
 * Social Icons generator
 * - Tem como função retornar os icones sociais adicionados no redux, já formatadinhos, bastando apenas estilizar
 * - via LESS, aceita social netwroks passadas por parametro
 *
 */

function makeSocialIcons($social = array('facebook', 'twitter', 'instagram', 'pinterest', 'google-plus', 'skype')) {
	global $theme_options;

	// Contéudo
	$content = "<div class='social-icons'>";

	// Rodamos um pequeno loop para montar os icones que retornaremos
	foreach ($social as $social) {
		if ($theme_options[$social] && $theme_options[$social] !== "") 
			$content .= "<a href='{$theme_options[$social]}' target='_blank'><i class='fa fa-{$social}'></i></a>";
	}

	// Fechamos div
	$content .= "</div>";

	// Retornamos Resultado
	return $content;
}

/*
 *
 * Telefones List Generator
 * - Tem como função gerar uma lista dos telefones entrados no redux, aceita como parametros o numero de telefones a mostrar
 *
 */

function makePhones($qtd = 1) {
	global $theme_options;

	// O que cortar, para facilitar
	$cut = 'tel';
	
	// Contéudo
	$content = "<div class='contact-phones'>";

	// Cortamos a array de números e retornamos só o que nos interessa
	$selection = array_slice($theme_options[$cut], 0, $qtd);

	foreach ($selection as $selection) { 
		$content .= "<span class='contact-phone'>{$selection}</span>";
	}

	// Fechamos div
	$content .= "</div>";

	// Retornamos Resultado
	return $content;
}

/*
 *
 * Email List Generator
 * - Tem como função gerar uma lista dos emails entrados no redux, aceita como parametros o numero de emails a mostrar
 *
 */

function makeEmails($qtd = 1) {
	global $theme_options;

	// O que cortar, para facilitar
	$cut = 'email';
	
	// Contéudo
	$content = "<div class='contact-emails'>";

	// Cortamos a array de números e retornamos só o que nos interessa
	$selection = array_slice($theme_options[$cut], 0, $qtd);

	foreach ($selection as $selection) { 
		$content .= "<span class='contact-email'><a href='mailto:{$selection}'>{$selection}</a></span>";
	}

	// Fechamos div
	$content .= "</div>";

	// Retornamos Resultado
	return $content;
}

/*
 *
 * Endereço Generator
 * - Concatena as informações postas no redux para gerar um endereço final (pode ser usado para gerara mapas também)
 * - Passe que endereço gerar (o redux atualmente suporta até quatro)
 */

function makeAddress($i = 1, $htmltags = true) {
	global $theme_options;

	// Contéudo
	$content = "";
	if ($htmltags) $content .= "<address>";

	// Adicionamos as opções recentes
	$content .= $theme_options["street-{$i}"].", ".$theme_options["number-{$i}"];
	$content .= ($htmltags) ? "<br>" : " - ";
	$content .= $theme_options["city-{$i}"].", ".$theme_options["state-{$i}"];
	$content .= ($htmltags) ? "<br>" : " - ";
	$content .= $theme_options["cep-{$i}"];

	// Fechamos div
	if ($htmltags) $content .= "</address>";

	// Retornamos Resultado
	return $content;
}

/*
 *
 * Slider Generator
 * - Gera um Slider, com os controles e tudo mais, bastando apenas estilizar via less
 * - Aceita como parametros o post type a ser puxado e o por page
 *
 */

function makeSlider($taxonomy, $post_type, $speed) {

}

function makePagination($wp_query) {

    $big = 999999999; // This needs to be an unlikely integer

    // For more options and info view the docs for paginate_links()
    // http://codex.wordpress.org/Function_Reference/paginate_links
    $paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'mid_size' => 5,
        'prev_text'    => __('« Anterior'),
		'next_text'    => __('Próximo »'),
    ) );

    // Display the pagination if more than one page is found
    if ($paginate_links) {
        echo '<nav class="post-nav">';
        echo $paginate_links;
        echo '</nav>';
    }
}