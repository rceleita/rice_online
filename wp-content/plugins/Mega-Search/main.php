<?php
/*
Plugin Name: Mega Search : Advanced Ajax Live Search
Plugin URI: http://proword.com/
Description: Mega Search is a Live Ajax Search Plugin for wordpress.
Version: 1.1
Author: Proword
Author URI: http://proword.net/
Text Domain: pw_livesearch
Domain Path: /languages/
*/

if(!class_exists('pw_livesearch_class')){
	
	define( '__PW_LIVESEARCH_ROOT_DIR__', dirname(__FILE__)); //use for include
	
	//USE IN ENQUEUE AND IMAGE
	define( '__PW_LIVESEARCH_CSS_URL__', plugins_url('assets/css/',__FILE__));
	define( '__PW_LIVESEARCH_JS_URL__', plugins_url('assets/js/',__FILE__));
	define ('__PW_LIVESEARCH_URL__',plugins_url('', __FILE__));
	
	//PERFIX
	define ('__PW_LIVESEARCH_FIELDS_PERFIX__', 'custom_ls_' );
	
	//TEXT DOMAIN FOR MULTI LANGUAGE
	define ('__PW_LIVESEARCH_TEXTDOMAIN__', 'pw_livesearch' );
	
	
	include('class/custompost.php');
	
	include('class/customefields.php');
	
	include ('frontend/custom_css.php');
	
	include('includes/TinyMCE_BTN/main.php');

	
	class pw_livesearch_class{
		
		public $custom_field=array();
		
		function __construct(){
			
			include('includes/actions.php');
			
			/* Runs when plugin is activated */
			register_activation_hook( __FILE__ , array( $this, 'my_plugin_install' ) );
			/* Runs on plugin deactivation*/
			register_deactivation_hook( __FILE__ , array(  $this, 'my_plugin_remove' ) );
			
			//ADD IMAGE SIZE
			add_action( 'init', array($this,'pw_livesearch_add_new_image_size') );
			
			add_action('admin_head',array($this,'pw_livesearch_backend_enqueue'));
			add_action( 'wp_head', array($this,'pw_livesearch_frontend_enqueue') );
			
			//ADD SETTING SUBMENU
			add_action('admin_menu', array($this,'pw_livesearch_submenu_page'));
			
			
			add_action('wp_head',array($this,'pw_frontend_enqueue'));
			
			add_shortcode( 'pw-ajax-live-search', array($this,'pw_livesearch_shortcode') );
			
			add_shortcode( 'pw-ajax-live-search-page', array($this,'pw_livesearch_shortcode_page') );
			
		}
		
		function pw_livesearch_add_new_image_size() {
			add_image_size( 'wp_small', 450, 450, true ); //mobile
		}
		
		
		function pw_livesearch_backend_enqueue(){
			//////////////PRIVATE ENQUEUE/////////////
			global $post_type;
			if( 'pw_livesearch' == $post_type || (isset($_GET['post_type']) && 'pw_livesearch' == $_GET['post_type']) )
			{
				include ("includes/admin-embed.php");
			}
		}
		
		function pw_livesearch_frontend_enqueue(){
			
			include ("includes/frontend-embed.php");
			//////////////CUSTOM CSS//////////////         
	       // include ("frontend/custom_css.php"); 
			
		}
		
		function pw_livesearch_submenu_page(){
			add_submenu_page('edit.php?post_type=pw_livesearch', __('Mega Search Settings',__PW_LIVESEARCH_TEXTDOMAIN__), __('Search Settings',__PW_LIVESEARCH_TEXTDOMAIN__), 'manage_options', 'pw_livesearch_option', array($this,'pw_livesearch_option'));
			
			add_submenu_page('edit.php?post_type=pw_livesearch', __('Mega Search  Statistics',__PW_LIVESEARCH_TEXTDOMAIN__), __('Search Statistics',__PW_LIVESEARCH_TEXTDOMAIN__), 'manage_options', 'pw_livesearch_statistics', array($this,'pw_livesearch_statistics'));
		}
		
		function pw_livesearch_option(){
			include __PW_LIVESEARCH_ROOT_DIR__.'/class/pw-livesearch-options.php';
		}
		
		function pw_livesearch_statistics(){
			include __PW_LIVESEARCH_ROOT_DIR__.'/class/pw-livesearch-statistics.php';
		}
		
		function pw_frontend_enqueue(){}
		
		function pw_livesearch_shortcode( $atts, $content = null ) {
			
			extract( shortcode_atts( array(
				'id' => 'on',
				'name' => 'Default NAME',
			), $atts ));
			
			$rand_id=$id.'_'.rand(0,1000);

			/*wp_register_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'front-custom-js'.$rand_id, __PW_LIVESEARCH_JS_URL__.'front-end/custom-search-js.js' , false, '1.0.0' );
			wp_enqueue_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'front-custom-js'.$rand_id );
			wp_localize_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'front-custom-js'.$rand_id, 'params', array(
				'ajaxurl' => admin_url( 'admin-ajax.php'),
				'nonce' => wp_create_nonce( 'pw_livesearch_nonce' ),
				'search_id' => $rand_id,
				'min_character' => get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'min_character',3),
				'default_value' => get_post_meta($id,__PW_LIVESEARCH_FIELDS_PERFIX__.'default_value',true),
			) );*/
							
			include("frontend/frontend.php");
			
			$this->fetch_custom_fields($id);
			livesearch_custom_css($rand_id);
			
			return $final_html;
			
		}
		
		function pw_livesearch_shortcode_page(){
			include("frontend/showmore_frontend.php");
		}
		
		
		function alert($type,$message)
		{
			switch($type)
			{
				case "error":
					return '<div class="ls-message-cnt"><i class="fa fa-times "></i><span>'.$message.'</span></div>';
				break;
				
				case "success":
					return '<div class="message-cnt woo-succ-msg"><i class="fa fa-check"></i><span>'.$message.'</span></div>';
				break;
			}
		}
		
		function check_isset($parameter,$type,$alternative_value)
		{
			switch($type)
			{
				case "theme_option":
					return ((isset($this->theme_option[$parameter]) ? $this->theme_option[$parameter]:$alternative_value));
				break;
				
				case "custom_field":
					return ((isset($this->custom_field[$parameter]) ? $this->custom_field[$parameter]:$alternative_value));
				break;
				
				case "taxonomy":
					return ((isset($this->custom_taxonomy[$parameter]) ? $this->custom_taxonomy[$parameter]:$alternative_value));
				break;
			}
			
		}
		
		function check_empty($parameter,$type,$alternative_value)
		{
			switch($type)
			{
				case "theme_option":
					return ((isset($this->theme_option[$parameter]) ? $alternative_value:$this->theme_option[$parameter]));
				break;
				
				case "custom_field":
					return ((isset($this->custom_field[$parameter]) ? $alternative_value:$this->custom_field[$parameter]));
				break;
				
				case "taxonomy":
					return ((isset($this->custom_taxonomy[$parameter]) ? $alternative_value:$this->custom_taxonomy[$parameter]));
				break;
			}
			
		}
		
		
		function isSerialized($str) {
			return ($str == serialize(false) || @unserialize($str) !== false);
		}
		
		function fetch_custom_fields($post_id)
		{
			$this->custom_field=array();
			$custom_fields = get_post_custom($post_id,true);
			if(is_array($custom_fields))
			{
				foreach ( $custom_fields as $key => $value ) {
					$this->custom_field[$key]=($this->isSerialized($value[0]) ? unserialize($value[0]):$value[0]);
				}
			}
			
		}
		
		public function excerpt($text,$excerpt_length,$content_type='excerpt') {
			global $post;
			if(trim($excerpt_length)=='') $excerpt_length=10;
			$limit=$excerpt_length;
			if($content_type=='excerpt')	
			{
				$excerpt = explode(' ', $text, $limit);
				if (count($excerpt)>=$limit) {
					array_pop($excerpt);
					$excerpt = implode(" ",$excerpt).'...';
				} else {
					$excerpt = implode(" ",$excerpt);
				}	
				$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
				return $excerpt;
			}else{
				$content = explode(' ', $text, $limit);
				if (count($content)>=$limit) {
					array_pop($content);
					$content = implode(" ",$content).'...';
				} else {
					$content = implode(" ",$content);
				}	
				//REMOVE SHORTCODE
				//$content = preg_replace('/\[.+\]/','', $content);
				
				$content = apply_filters('the_content', $content); 
				$content = str_replace(']]>', ']]&gt;', $content);
				return $content;
			}
		}
		
		
		public function get_category_tag( $id = 0, $taxonomy, $before = '', $sep = '', $after = '', $count='all', $exclude = array() ){
			$terms = get_the_terms( $id, $taxonomy );
	
			if ( is_wp_error( $terms ) )
				return $terms;
		
			if ( empty( $terms ) )
				return false;
		
			$counter=0;
			foreach ( $terms as $term ) {
				if($counter<$count || $count=='all'){	
					
					if(!in_array($term->term_id,$exclude)) {
						$link = get_term_link( $term, $taxonomy );
						if ( is_wp_error( $link ) )
							return $link;
						$term_links[] = '<a href="' . $link . '" rel="tag">' . $term->name . '</a>';
					}
					$counter++;
				}
			}
		
			$term_links = apply_filters( "term_links-$taxonomy", $term_links );
		
			return $before . join( $sep, $term_links ) . $after;
		}
		
		
		function my_plugin_install() {

			global $wpdb;
		
			$the_page_title = 'Mega Search Show More Page';
			$the_page_name = 'mega-search-showmore-page';
		
			// the menu entry...
			delete_option("my_plugin_page_title");
			add_option("my_plugin_page_title", $the_page_title, '', 'yes');
			// the slug...
			delete_option("my_plugin_page_name");
			add_option("my_plugin_page_name", $the_page_name, '', 'yes');
			// the id...
			delete_option("my_plugin_page_id");
			add_option("my_plugin_page_id", '0', '', 'yes');
		
			$the_page = get_page_by_title( $the_page_title );
		
			if ( ! $the_page ) {
		
				// Create post object
				$_p = array();
				$_p['post_title'] = $the_page_title;
				$_p['post_content'] = "[pw-ajax-live-search-page]";
				$_p['post_status'] = 'publish';
				$_p['post_type'] = 'page';
				$_p['comment_status'] = 'closed';
				$_p['ping_status'] = 'closed';
				$_p['post_category'] = array(1); // the default 'Uncatrgorised'
		
				// Insert the post into the database
				$the_page_id = wp_insert_post( $_p );
		
			}
			else {
				// the plugin may have been previously active and the page may just be trashed...
		
				$the_page_id = $the_page->ID;
		
				//make sure the page is not trashed...
				$the_page->post_status = 'publish';
				$the_page_id = wp_update_post( $the_page );
		
			}
		
			delete_option( 'my_plugin_page_id' );
			add_option( 'my_plugin_page_id', $the_page_id );
		
		}
		
		function my_plugin_remove() {
		
			global $wpdb;
		
			$the_page_title = get_option( "my_plugin_page_title" );
			$the_page_name = get_option( "my_plugin_page_name" );
		
			//  the id of our page...
			$the_page_id = get_option( 'my_plugin_page_id' );
			if( $the_page_id ) {
		
				wp_delete_post( $the_page_id ); // this will trash, not delete
		
			}
		
			delete_option("my_plugin_page_title");
			delete_option("my_plugin_page_name");
			delete_option("my_plugin_page_id");
		
		}
		
	}
	$GLOBALS['pw_livesearch_class'] = new pw_livesearch_class;
}

class WPSE_OR_Query extends WP_Query 
{       
    protected $meta_or_tax  = FALSE;
    protected $tax_args     = NULL;
    protected $meta_args    = NULL;
	protected $new_where    = NULL;

    public function __construct( $args = array() )
    {
        add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ), 10 );
        add_filter( 'posts_clauses', array( $this, 'posts_clauses' ), 10 );
		add_filter( 'posts_where', array($this,'pw_search_title_func'), 10, 2 );
        parent::__construct( $args );
    }

	function pw_search_title_func( $where, &$wp_query )
	{
		global $wpdb;
		
		if ( $wpse18703_title = $wp_query->get( 'search_title_content_excerpt' ) ) {
			
			$target_field=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'target_field',array('title'));

			
			$condition_items='';
			foreach($target_field as $t_field)
			{
				if($t_field!='custom_field')	
					$condition_items[]=$wpdb->posts . '.post_'.$t_field.' LIKE \'%' . esc_sql( $wpdb->esc_like( $wpse18703_title ) ) . '%\'';
			}
			
			$this->new_where = ' AND (' . implode(' OR ',$condition_items).')';
		}
		return $where;
	}

    public function pre_get_posts( $qry )
    {       
        remove_action( current_filter(), array( $this, __FUNCTION__ ) );            
        // Get query vars
        $this->meta_or_tax = ( isset( $qry->query_vars['meta_or_tax'] ) ) ? $qry->query_vars['meta_or_tax'] : FALSE;
        if( $this->meta_or_tax )
        { 
            $this->tax_args = ( isset( $qry->query_vars['tax_query'] ) ) ? $qry->query_vars['tax_query'] : NULL;
            $this->meta_args = ( isset( $qry->query_vars['meta_query'] ) ) ? $qry->query_vars['meta_query'] : NULL;
            // Unset meta and tax query
            unset( $qry->query_vars['meta_query'] );
            unset( $qry->query_vars['tax_query'] );
        }
    }

    public function posts_clauses( $clauses )
    {       
        global $wpdb;       
        $field = 'ID';
        remove_filter( current_filter(), array( $this, __FUNCTION__ ) );    
        // Reconstruct the "tax OR meta" query
        //TAX,META,WHERE
        if( $this->meta_or_tax && is_array( $this->tax_args ) &&  is_array( $this->meta_args ) && $this->new_where!=''  )
        {
            // Tax query
            $tax_query = new WP_Tax_Query( $this->tax_args );
            $sql_tax = $tax_query->get_sql( $wpdb->posts, $field );
            // Meta query
            $meta_query = new WP_Meta_Query( $this->meta_args );
            $sql_meta = $meta_query->get_sql( 'post', $wpdb->posts, $field );
            // Where part
            if( isset( $sql_meta['where'] ) && $this->new_where!='' && isset( $sql_tax['where'] ) )
            {
                $t = substr( trim( $sql_tax['where'] ), 4 );
                $m = substr( trim( $sql_meta['where'] ), 4 );
				$w= substr( trim( $this->new_where ), 4 );
                $clauses['where'] .= sprintf( 'AND %s AND ( %s OR  %s ) ', $t,$m, $w );              
            }
            // Join/Groupby part
            if( isset( $sql_meta['join'] ) && isset( $sql_tax['join'] ) )
            {
                $clauses['join']    .= sprintf( ' %s %s ', $sql_meta['join'], $sql_tax['join'] );               
                $clauses['groupby'] .= sprintf( ' %s.%s ', $wpdb->posts, $field );
            }    
        
			  return $clauses;
		}   
	
		//TAX,META
		if( $this->meta_or_tax && is_array( $this->tax_args ) &&  is_array( $this->meta_args )  )
        {
            // Tax query
            $tax_query = new WP_Tax_Query( $this->tax_args );
            $sql_tax = $tax_query->get_sql( $wpdb->posts, $field );
            // Meta query
            $meta_query = new WP_Meta_Query( $this->meta_args );
            $sql_meta = $meta_query->get_sql( 'post', $wpdb->posts, $field );
            // Where part
            if( isset( $sql_meta['where'] ) && isset( $sql_tax['where'] ) )
            {
                $t = substr( trim( $sql_tax['where'] ), 4 );
                $m = substr( trim( $sql_meta['where'] ), 4 );
                $clauses['where'] .= sprintf( 'AND %s AND  %s ', $t,$m);              
            }
            // Join/Groupby part
            if( isset( $sql_meta['join'] ) && isset( $sql_tax['join'] ) )
            {
                $clauses['join']    .= sprintf( ' %s %s ', $sql_meta['join'], $sql_tax['join'] );               
                $clauses['groupby'] .= sprintf( ' %s.%s ', $wpdb->posts, $field );
            }    
        
			  return $clauses;
		}
		
		
		//META,WHERE
        if( $this->meta_or_tax && is_array( $this->meta_args ) && $this->new_where!=''  )
        {
           
            // Meta query
            $meta_query = new WP_Meta_Query( $this->meta_args );
            $sql_meta = $meta_query->get_sql( 'post', $wpdb->posts, $field );
            // Where part
            if( isset( $sql_meta['where'] ) && $this->new_where!='' )
            {
                $m = substr( trim( $sql_meta['where'] ), 4 );
				$w= substr( trim( $this->new_where ), 4 );
                $clauses['where'] .= sprintf( 'AND ( %s OR  %s ) ', $m, $w );              
            }
            // Join/Groupby part
            if( isset( $sql_meta['join'] ) )
            {
                $clauses['join']    .= sprintf( ' %s', $sql_meta['join']);               
                $clauses['groupby'] .= sprintf( ' %s.%s ', $wpdb->posts, $field );
            }    
        
			  return $clauses;
		}   
		
		//TAX,WHERE
		if( $this->meta_or_tax && is_array( $this->tax_args ) && $this->new_where!='' )
        {
            // Tax query
            $tax_query = new WP_Tax_Query( $this->tax_args );
            $sql_tax = $tax_query->get_sql( $wpdb->posts, $field );
           
            // Where part
            if($this->new_where!='' && isset( $sql_tax['where'] ) )
            {
                $t = substr( trim( $sql_tax['where'] ), 4 );
				$w= substr( trim( $this->new_where ), 4 );
                $clauses['where'] .= sprintf( 'AND %s AND %s ', $t,$w );              
            }
            // Join/Groupby part
            if( isset( $sql_tax['join'] ) )
            {
                $clauses['join']    .= sprintf( ' %s ', $sql_tax['join'] );               
                $clauses['groupby'] .= sprintf( ' %s.%s ', $wpdb->posts, $field );
            }    
        
			  return $clauses;
		} 
		
		//TAX
		if( $this->meta_or_tax && is_array( $this->tax_args ))
        {
            // Tax query
            $tax_query = new WP_Tax_Query( $this->tax_args );
            $sql_tax = $tax_query->get_sql( $wpdb->posts, $field );
           
            // Where part
            if( isset( $sql_tax['where'] ) )
            {
                $t = substr( trim( $sql_tax['where'] ), 4 );
                $clauses['where'] .= sprintf( 'AND %s', $t);              
            }
            // Join/Groupby part
            if( isset( $sql_tax['join'] ) )
            {
                $clauses['join']    .= sprintf( ' %s ', $sql_tax['join'] );               

                $clauses['groupby'] .= sprintf( ' %s.%s ', $wpdb->posts, $field );
            }    
        
			  return $clauses;
		} 
		
		//META
		if( $this->meta_or_tax && is_array( $this->meta_args )  )
        {
            // Meta query
            $meta_query = new WP_Meta_Query( $this->meta_args );
            $sql_meta = $meta_query->get_sql( 'post', $wpdb->posts, $field );
            // Where part
            if( isset( $sql_meta['where'] ) )
            {
                $m = substr( trim( $sql_meta['where'] ), 4 );
                $clauses['where'] .= sprintf( 'AND %s ', $m);              
            }
            // Join/Groupby part
            if( isset( $sql_meta['join'] ))
            {
                $clauses['join']    .= sprintf( ' %s ', $sql_meta['join']);               
                $clauses['groupby'] .= sprintf( ' %s.%s ', $wpdb->posts, $field );
            } 
			return $clauses;  
        }
		
		//WHERE
		if( $this->meta_or_tax && $this->new_where!='' )
        {
            // Where part
            if($this->new_where!='' )
            {
				$w= substr( trim( $this->new_where ), 4 );
                $clauses['where'] .= sprintf( 'AND %s ',$w );              
            }
            
			
			$clauses['groupby'] .= sprintf( ' %s.%s ', $wpdb->posts, $field ); 
        
			return $clauses;
		} 
		
        return $clauses;
    }

}

?>