<?php
class ro_NectarLove {
	public $post_id;
	 function __construct($post_id = null)   {
		$this->post_id = $post_id;
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_nectar-love', array($this, 'ajax'));
		add_action('wp_ajax_nopriv_nectar-love', array($this, 'ajax'));
	}

	function enqueue_scripts() {
		wp_register_script( 'post-favorite', get_template_directory_uri() . '/assets/js/post-favorite.js', 'jquery', '1.0', TRUE );
		global $post;
		wp_localize_script('post-favorite', 'nectarLove', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'postID' => $post ? $post->ID : 0,
			'rooturl' => home_url()
		));
		wp_enqueue_script('post-favorite');
	}

	function ajax($post_id) {
		//update
		if( isset($_POST['loves_id']) ) {
			$post_id = str_replace('nectar-love-', '', $_POST['loves_id']);
			echo $this->love_post($post_id, 'update');
		}
		//get
		else {
			$post_id = str_replace('nectar-love-', '', $_POST['loves_id']);
			echo $this->love_post($post_id, 'get');
		}
		exit;
	}

	function love_post($post_id, $action = 'get')
	{
		if(!is_numeric($post_id)) return;

		switch($action) {

			case 'get':
				$love_count = get_post_meta($post_id, '_nectar_love', true);
				if( !$love_count ){
					$love_count = 0;
					add_post_meta($post_id, '_nectar_love', $love_count, true);
				}

				return $love_count;
				break;

			case 'update':
				$love_count = get_post_meta($post_id, '_nectar_love', true);
				if( isset($_COOKIE['nectar_love_'. $post_id]) ) return $love_count;

				$love_count++;
				update_post_meta($post_id, '_nectar_love', $love_count);
				setcookie('nectar_love_'. $post_id, $post_id, time()*20, '/');

				return $love_count;
				break;

		}
	}

	function add_love() {
		global $post;

		$output = $this->love_post($post->ID);

  		$class = 'nectar-love';
  		$title = __('Love this', 'robusta');
		if( isset($_COOKIE['nectar_love_'. $post->ID]) ){
			$class = 'nectar-love loved';
			$title = __('You already love this!', 'robusta');
		}
		return '<a href="#" class="'. $class .'" id="nectar-love-'. $post->ID .'" title="'. $title .'"><ins>'. $output .'</ins> <i class="icon icon-heart"></i> <span>likes</span></a>';
	}
}
global $post_favorite;
$post_favorite = new ro_NectarLove();
function post_favorite() {
	global $post_favorite;
	echo $post_favorite->add_love();
}
?>
