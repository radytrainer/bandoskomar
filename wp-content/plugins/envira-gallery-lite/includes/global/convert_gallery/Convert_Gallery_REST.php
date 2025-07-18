<?php
/**
 * Convert Gallery REST Class.
 *
 * @since 1.9.1
 *
 * @package Envira Gallery
 * @author  Envira Gallery Team <support@enviragallery.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Convert Gallery REST Class.
 */
class Convert_Gallery_REST extends Convert_Gallery_Common {
	/**
	 * Register rest routes.
	 *
	 * @return void
	 */
	public function register_rest_routes() {
		// Rest route for converting single WordPress gallery to Envira Gallery.
		register_rest_route(
			'envira-convert/v1',
			'/convert-gallery',
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'envira_convert_wordpress_gallery' ],
				'permission_callback' => [ $this, 'verify_rest_nonce' ],
			]
		);

		// Rest route for bulk conversion of galleries.
		register_rest_route(
			'envira-convert/v1',
			'/bulk-convert',
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'envira_convert_bulk_galleries' ],
				'permission_callback' => [ $this, 'verify_rest_nonce' ],
			]
		);

		// Rest route for processing the items after bulk conversion starts.
		register_rest_route(
			'envira-convert/v1',
			'/process-gallery',
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'envira_convert_process_items' ],
				'permission_callback' => [ $this, 'verify_rest_nonce' ],
			]
		);
	}

	/**
	 * Verify REST request nonce.
	 *
	 * @param WP_REST_Request $request Request object.
	 * @return bool|WP_REST_Response
	 */
	public function verify_rest_nonce( $request ) {
		// Get the nonce from the request header.
		$nonce = $request->get_header( 'X-WP-Nonce' );

		// Verify the nonce.
		if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
			return new WP_REST_Response( [ 'message' => __( 'Security check failed. You are not authorized. Please refresh and try again.', 'envira-gallery-lite' ) ], 403 );
		}

		// Return true if valid.
		return true;
	}

	/**
	 * Convert single WordPress Gallery to Envira Gallery.
	 *
	 * @param WP_REST_Request $request Request object.
	 * @return WP_REST_Response
	 */
	public function envira_convert_wordpress_gallery( $request ) {
		// Retrieve data from the request.
		$post_id       = absint( $request->get_param( 'postId' ) );
		$columns       = absint( $request->get_param( 'columns' ) );
		$size_slug     = sanitize_text_field( $request->get_param( 'sizeSlug' ) );
		$link_target   = sanitize_text_field( $request->get_param( 'linkTarget' ) );
		$images        = $request->get_param( 'images' );
		$block_content = $request->get_param( 'blockContent' );

		$sanitized_images = array_map(
			function ( $image ) {
				return [
					'id'    => isset( $image['id'] ) ? absint( $image['id'] ) : 0,
					'url'   => isset( $image['url'] ) ? esc_url_raw( $image['url'] ) : '',
					'title' => isset( $image['title'] ) ? sanitize_text_field( $image['title'] ) : '',
					'alt'   => isset( $image['alt'] ) ? sanitize_text_field( $image['alt'] ) : '',
				];
			},
			is_array( $images ) ? $images : []
		);

		// Check that required parameters are provided and valid.
		if ( empty( $sanitized_images ) || ! is_array( $sanitized_images ) ) {
			return new WP_REST_Response(
				[
					'message' => __( 'No images provided. Please add at least one image to continue.', 'envira-gallery-lite' ),
				],
				400
			);
		}

		// Check if each image in the array has the required fields.
		foreach ( $sanitized_images as $image ) {
			if ( empty( $image['id'] ) || empty( $image['url'] ) ) {
				return new WP_REST_Response(
					[
						'message' => __( 'Each image must have an ID and a URL. Please check your images and try again.', 'envira-gallery-lite' ),
					],
					400
				);
			}
		}

		$passed_data = [
			'post_id'       => $post_id,
			'columns'       => $columns,
			'size_slug'     => $size_slug,
			'link_target'   => $link_target,
			'images'        => $sanitized_images,
			'block_content' => $block_content,
		];

		$created_result = $this->create_envira_gallery_using_wp_gallery( $passed_data );

		if ( isset( $created_result['error'] ) && ! empty( $created_result['error'] ) ) {
			return new WP_REST_Response(
				[
					'message' => $created_result['error'],
				],
				400
			);
		} else {
			return new WP_REST_Response( $created_result, 200 );
		}
	}

	/**
	 * Process the bulk conversion of galleries.
	 *
	 * @param WP_REST_Request $request Request object.
	 * @return WP_REST_Response
	 */
	public function envira_convert_bulk_galleries( $request ) {
		// Get form data from the request.
		$selected_posttype = sanitize_text_field( $request->get_param( 'selected_posttype' ) );

		if ( empty( $selected_posttype ) ) {
			return new WP_REST_Response( [ 'message' => __( 'A post type is required for conversion. Please make a selection.', 'envira-gallery-lite' ) ], 400 );
		}

		if ( ! post_type_exists( $selected_posttype ) ) {
			return new WP_REST_Response( [ 'message' => __( 'Post type not recognized. Please check your selection and try again.', 'envira-gallery-lite' ) ], 404 );
		}

		// Get all posts of the given post type.
		$args  = [
			'post_type'   => $selected_posttype,
			'post_status' => 'any',
			'numberposts' => -1,
		];
		$posts = get_posts( $args );

		if ( empty( $posts ) ) {
			return new WP_REST_Response( [ 'message' => __( 'No items found for the selected post type. Please try selecting a different option.', 'envira-gallery-lite' ) ], 400 );
		}

		$found_posts = [];
		foreach ( $posts as $post ) {
			if ( has_block( 'gallery', $post->post_content ) || has_shortcode( $post->post_content, 'gallery' ) ) {
				$found_posts[] = $post->ID;
			}
		}

		if ( empty( $found_posts ) ) {
			return new WP_REST_Response( [ 'message' => __( 'No galleries were found in the selected post type.', 'envira-gallery-lite' ) ], 400 );
		}

		// Send back the found posts.
		return new WP_REST_Response(
			[
				'posts' => $found_posts,
			],
			200
		);
	}

	/**
	 * Process the items after bulk conversion starts.
	 *
	 * @param WP_REST_Request $request Request object.
	 * @return WP_REST_Response
	 */
	public function envira_convert_process_items( $request ) {
		// Get form data from the request.
		$post_id = absint( $request->get_param( 'post_id' ) );
		$post_id = isset( $post_id ) ? $post_id : 0;

		if ( empty( $post_id ) ) {
			return new WP_REST_Response( [ 'error' => __( 'A valid post ID is required.', 'envira-gallery-lite' ) ], 400 );
		}

		// Get the post.
		$post = get_post( $post_id );

		if ( ! $post ) {
			return new WP_REST_Response( [ 'error' => __( 'Post not found.', 'envira-gallery-lite' ) ], 400 );
		}

		$updated_content = $post->post_content; // Start with the current content.
		$needs_update    = false;

		// Process gallery shortcodes.
		$this->process_gallery_shortcodes( $updated_content, $post_id, $needs_update );

		// Parse and process gallery blocks.
		$blocks = parse_blocks( $updated_content );
		$this->process_gallery_blocks( $blocks, $post_id, $needs_update );

		// Update post content if changes were made.
		if ( $needs_update ) {
			// If blocks were processed, serialize back to post content.
			$updated_content = serialize_blocks( $blocks );

			wp_update_post(
				[
					'ID'           => $post_id,
					'post_content' => $updated_content,
				]
			);
			return new WP_REST_Response( [ 'success' => __( 'Galleries converted to Envira Galleries.', 'envira-gallery-lite' ) ], 200 );
		} else {
			return new WP_REST_Response(
				[
					'error'    => __( 'This post contains gallery content that is not compatible with the conversion process.', 'envira-gallery-lite' ),
					'edit_url' => admin_url( 'post.php?post=' . $post_id . '&action=edit' ),
				],
				400
			);
		}
	}
}
