<?php
/*
Plugin Name: WP Audio Video Preview
Plugin URI: http://horttcore.de
Description: Display an additional column in media library overview
Version: 1.0
Author: Ralf Hortt
Author URI: http://horttcore.de
License: GPL2
*/


/**
* WP Audio Preview
*/
class WP_Audio_Video_Preview
{


	/**
	 * Constructor
	 *
	 * @access public
	 * @since v1.0
	 * @author Ralf Hortt
	 */
	public function __construct()
	{
		add_filter( 'manage_media_columns', array( $this, 'manage_media_columns' ) );
		add_action( 'manage_media_custom_column', array( $this, 'manage_media_custom_column' ), 10, 2 );
		load_plugin_textdomain( 'wp-audio-video-preview', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}



	/**
	 * Add column
	 *
	 * @access public
	 * @param array $columns Columns
	 * @return array Columns
	 * @since v1.0
	 * @author Ralf Hortt
	 */
	public function manage_media_columns( array $columns ){
		$columns['audio_video_preview']  = __( 'Audio/Video Preview', 'wp-audio-video-preview' );
		return $columns;
	}



	/**
	 * Populate custom columns
	 *
	 * @access public
	 * @param str $column Column
	 * @param int $post_id Post ID
	 * @since v1.0
	 * @author Ralf Hortt
	 */
	public function manage_media_custom_column( $column, $post_id ){
		global $post;

		switch( $column ) :

			case 'audio_video_preview' :
				if ( FALSE !== strpos($post->post_mime_type, 'audio' )  || FALSE !== strpos($post->post_mime_type, 'video' ) ) :
					echo apply_filters( 'the_content', $post->guid );
				endif;
			break;

		endswitch;
	}



}

new WP_Audio_Video_Preview;