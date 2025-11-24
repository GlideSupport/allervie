<?php
/**
 * Functions for custom Gutenberg blocks
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package Allervie
 * @since 1.0.0
 */

/**
 * Register custom Gutenberg blocks
 */
add_action( 'acf/init', 'glide_theme_acf_init' );
function glide_theme_acf_init() {

	if ( function_exists( 'acf_register_block' ) ) {

		// Register a block - Spacer
		acf_register_block(
			array(
				'name'            => 'spacer',
				'title'           => __( 'Theme Spacer', 'alrv_td' ),
				'description'     => __( 'A custom spacer block for theme.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8 0H16V64H8V0Z" fill="#088D8D"/>
				<path d="M8 0H16V64H8V0Z" fill="#088D8D"/>
				<path d="M8 0H16V64H8V0Z" fill="#088D8D"/>
				<path d="M24 56L24 64L-3.49691e-07 64L0 56L24 56Z" fill="#088D8D"/>
				<path d="M24 56L24 64L-3.49691e-07 64L0 56L24 56Z" fill="#088D8D"/>
				<path d="M24 56L24 64L-3.49691e-07 64L0 56L24 56Z" fill="#088D8D"/>
				<path d="M24 0L24 8L-3.49691e-07 8L0 -1.04907e-06L24 0Z" fill="#088D8D"/>
				<path d="M24 0L24 8L-3.49691e-07 8L0 -1.04907e-06L24 0Z" fill="#088D8D"/>
				<path d="M24 0L24 8L-3.49691e-07 8L0 -1.04907e-06L24 0Z" fill="#088D8D"/>
				<path d="M64 0L64 4L36 4L36 -1.31134e-06L64 0Z" fill="#088D8D"/>
				<path d="M64 0L64 4L36 4L36 -1.31134e-06L64 0Z" fill="#088D8D"/>
				<path d="M64 0L64 4L36 4L36 -1.31134e-06L64 0Z" fill="#088D8D"/>
				<path d="M50 16L50 20L36 20L36 16L50 16Z" fill="#088D8D"/>
				<path d="M50 16L50 20L36 20L36 16L50 16Z" fill="#088D8D"/>
				<path d="M50 16L50 20L36 20L36 16L50 16Z" fill="#088D8D"/>
				<path d="M64 8L64 12L36 12L36 8L64 8Z" fill="#088D8D"/>
				<path d="M64 8L64 12L36 12L36 8L64 8Z" fill="#088D8D"/>
				<path d="M64 8L64 12L36 12L36 8L64 8Z" fill="#088D8D"/>
				<path d="M64 44L64 48L36 48L36 44L64 44Z" fill="#088D8D"/>
				<path d="M64 44L64 48L36 48L36 44L64 44Z" fill="#088D8D"/>
				<path d="M64 44L64 48L36 48L36 44L64 44Z" fill="#088D8D"/>
				<path d="M50 60L50 64L36 64L36 60L50 60Z" fill="#088D8D"/>
				<path d="M50 60L50 64L36 64L36 60L50 60Z" fill="#088D8D"/>
				<path d="M50 60L50 64L36 64L36 60L50 60Z" fill="#088D8D"/>
				<path d="M64 52L64 56L36 56L36 52L64 52Z" fill="#088D8D"/>
				<path d="M64 52L64 56L36 56L36 52L64 52Z" fill="#088D8D"/>
				<path d="M64 52L64 56L36 56L36 52L64 52Z" fill="#088D8D"/>
				</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Spacer Block' ),
				'align'           => 'full',
				'supports'        => array(
					'align' => array( 'full' ),
				),
			)
		);

		// Register a block - Button
		acf_register_block(
			array(
				'name'            => 'button',
				'title'           => __( 'Theme Buttons', 'alrv_td' ),
				'description'     => __( 'A custom button block with theme styles.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M64 16L64 20L-3.73004e-07 20L0 16L64 16Z" fill="#088D8D"/>
				<path d="M64 16L64 20L-3.73004e-07 20L0 16L64 16Z" fill="#088D8D"/>
				<path d="M64 16L64 20L-3.73004e-07 20L0 16L64 16Z" fill="#088D8D"/>
				<path d="M64 8L64 12L-3.73004e-07 12L0 8L64 8Z" fill="#088D8D"/>
				<path d="M64 8L64 12L-3.73004e-07 12L0 8L64 8Z" fill="#088D8D"/>
				<path d="M64 8L64 12L-3.73004e-07 12L0 8L64 8Z" fill="#088D8D"/>
				<path d="M64 0L64 4L-3.73004e-07 4L0 -1.31134e-06L64 0Z" fill="#088D8D"/>
				<path d="M64 0L64 4L-3.73004e-07 4L0 -1.31134e-06L64 0Z" fill="#088D8D"/>
				<path d="M64 0L64 4L-3.73004e-07 4L0 -1.31134e-06L64 0Z" fill="#088D8D"/>
				<path d="M64 44L64 48L-3.73004e-07 48L0 44L64 44Z" fill="#088D8D"/>
				<path d="M64 44L64 48L-3.73004e-07 48L0 44L64 44Z" fill="#088D8D"/>
				<path d="M64 44L64 48L-3.73004e-07 48L0 44L64 44Z" fill="#088D8D"/>
				<path d="M64 60L64 64L-3.73004e-07 64L0 60L64 60Z" fill="#088D8D"/>
				<path d="M64 60L64 64L-3.73004e-07 64L0 60L64 60Z" fill="#088D8D"/>
				<path d="M64 60L64 64L-3.73004e-07 64L0 60L64 60Z" fill="#088D8D"/>
				<path d="M64 52L64 56L-3.73004e-07 56L0 52L64 52Z" fill="#088D8D"/>
				<path d="M64 52L64 56L-3.73004e-07 56L0 52L64 52Z" fill="#088D8D"/>
				<path d="M64 52L64 56L-3.73004e-07 56L0 52L64 52Z" fill="#088D8D"/>
				<path d="M28 28L28 36L-7.46008e-07 36L0 28L28 28Z" fill="#088D8D"/>
				<path d="M28 28L28 36L-7.46008e-07 36L0 28L28 28Z" fill="#088D8D"/>
				<path d="M28 28L28 36L-7.46008e-07 36L0 28L28 28Z" fill="#088D8D"/>
				<path d="M64 28L64 36L36 36L36 28L64 28Z" fill="#088D8D"/>
				<path d="M64 28L64 36L36 36L36 28L64 28Z" fill="#088D8D"/>
				<path d="M64 28L64 36L36 36L36 28L64 28Z" fill="#088D8D"/>
				</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Button' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => esc_url( get_template_directory_uri() ) . '/assets/img/admin/block-button.webp',
						),
					),
				),
			)
		);

		// Register a block - ACFBlock
		acf_register_block(
			array(
				'name'            => 'image-alongside-text',
				'title'           => __( 'Image Alongside Text', 'alrv_td' ),
				'description'     => __( 'A custom image alongside text.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M60 40H40V60H60V40ZM36 36V64H64V36H36Z" fill="#088D8D"/>
				<path d="M46.0714 48L40 56.2143V60H60V56.5714L56.0714 51.9286L52.8571 55.5L46.0714 48Z" fill="#088D8D"/>
				<path d="M56 45.5C56 46.8807 54.8807 48 53.5 48C52.1193 48 51 46.8807 51 45.5C51 44.1193 52.1193 43 53.5 43C54.8807 43 56 44.1193 56 45.5Z" fill="#088D8D"/>
				<path d="M28 48L28 52L-1.63189e-07 52L0 48L28 48Z" fill="#088D8D"/>
				<path d="M28 48L28 52L-1.63189e-07 52L0 48L28 48Z" fill="#088D8D"/>
				<path d="M28 48L28 52L-1.63189e-07 52L0 48L28 48Z" fill="#088D8D"/>
				<path d="M28 40L28 44L-1.63189e-07 44L0 40L28 40Z" fill="#088D8D"/>
				<path d="M28 40L28 44L-1.63189e-07 44L0 40L28 40Z" fill="#088D8D"/>
				<path d="M28 40L28 44L-1.63189e-07 44L0 40L28 40Z" fill="#088D8D"/>
				<path d="M14 56L14 60L-1.63189e-07 60L0 56L14 56Z" fill="#088D8D"/>
				<path d="M14 56L14 60L-1.63189e-07 60L0 56L14 56Z" fill="#088D8D"/>
				<path d="M14 56L14 60L-1.63189e-07 60L0 56L14 56Z" fill="#088D8D"/>
				<path d="M64 12L64 16L36 16L36 12L64 12Z" fill="#088D8D"/>
				<path d="M64 12L64 16L36 16L36 12L64 12Z" fill="#088D8D"/>
				<path d="M64 12L64 16L36 16L36 12L64 12Z" fill="#088D8D"/>
				<path d="M64 4L64 8L36 8L36 4L64 4Z" fill="#088D8D"/>
				<path d="M64 4L64 8L36 8L36 4L64 4Z" fill="#088D8D"/>
				<path d="M64 4L64 8L36 8L36 4L64 4Z" fill="#088D8D"/>
				<path d="M50 20L50 24L36 24L36 20L50 20Z" fill="#088D8D"/>
				<path d="M50 20L50 24L36 24L36 20L50 20Z" fill="#088D8D"/>
				<path d="M50 20L50 24L36 24L36 20L50 20Z" fill="#088D8D"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M24 4H4V24H24V4ZM0 0V28H28V0H0Z" fill="#088D8D"/>
				<path d="M10.0714 12L4 20.2143V24H24V20.5714L20.0714 15.9286L16.8571 19.5L10.0714 12Z" fill="#088D8D"/>
				<path d="M22 9.5C22 10.8807 20.8807 12 19.5 12C18.1193 12 17 10.8807 17 9.5C17 8.11929 18.1193 7 19.5 7C20.8807 7 22 8.11929 22 9.5Z" fill="#088D8D"/>
				</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'image', 'along', 'side', 'text' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-image-alongside-text.webp',
						),
					),
				),
			)
		);

		// Register a block - Image Alongside text RH landing 
		acf_register_block(
			array(
				'name'            => 'image-alongside-text-rh-landing',
				'title'           => __( 'Image Alongside Text RH landing', 'alrv_td' ),
				'description'     => __( 'A custom image alongside text.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M60 40H40V60H60V40ZM36 36V64H64V36H36Z" fill="#088D8D"/>
				<path d="M46.0714 48L40 56.2143V60H60V56.5714L56.0714 51.9286L52.8571 55.5L46.0714 48Z" fill="#088D8D"/>
				<path d="M56 45.5C56 46.8807 54.8807 48 53.5 48C52.1193 48 51 46.8807 51 45.5C51 44.1193 52.1193 43 53.5 43C54.8807 43 56 44.1193 56 45.5Z" fill="#088D8D"/>
				<path d="M28 48L28 52L-1.63189e-07 52L0 48L28 48Z" fill="#088D8D"/>
				<path d="M28 48L28 52L-1.63189e-07 52L0 48L28 48Z" fill="#088D8D"/>
				<path d="M28 48L28 52L-1.63189e-07 52L0 48L28 48Z" fill="#088D8D"/>
				<path d="M28 40L28 44L-1.63189e-07 44L0 40L28 40Z" fill="#088D8D"/>
				<path d="M28 40L28 44L-1.63189e-07 44L0 40L28 40Z" fill="#088D8D"/>
				<path d="M28 40L28 44L-1.63189e-07 44L0 40L28 40Z" fill="#088D8D"/>
				<path d="M14 56L14 60L-1.63189e-07 60L0 56L14 56Z" fill="#088D8D"/>
				<path d="M14 56L14 60L-1.63189e-07 60L0 56L14 56Z" fill="#088D8D"/>
				<path d="M14 56L14 60L-1.63189e-07 60L0 56L14 56Z" fill="#088D8D"/>
				<path d="M64 12L64 16L36 16L36 12L64 12Z" fill="#088D8D"/>
				<path d="M64 12L64 16L36 16L36 12L64 12Z" fill="#088D8D"/>
				<path d="M64 12L64 16L36 16L36 12L64 12Z" fill="#088D8D"/>
				<path d="M64 4L64 8L36 8L36 4L64 4Z" fill="#088D8D"/>
				<path d="M64 4L64 8L36 8L36 4L64 4Z" fill="#088D8D"/>
				<path d="M64 4L64 8L36 8L36 4L64 4Z" fill="#088D8D"/>
				<path d="M50 20L50 24L36 24L36 20L50 20Z" fill="#088D8D"/>
				<path d="M50 20L50 24L36 24L36 20L50 20Z" fill="#088D8D"/>
				<path d="M50 20L50 24L36 24L36 20L50 20Z" fill="#088D8D"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M24 4H4V24H24V4ZM0 0V28H28V0H0Z" fill="#088D8D"/>
				<path d="M10.0714 12L4 20.2143V24H24V20.5714L20.0714 15.9286L16.8571 19.5L10.0714 12Z" fill="#088D8D"/>
				<path d="M22 9.5C22 10.8807 20.8807 12 19.5 12C18.1193 12 17 10.8807 17 9.5C17 8.11929 18.1193 7 19.5 7C20.8807 7 22 8.11929 22 9.5Z" fill="#088D8D"/>
				</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'image', 'along', 'side', 'text' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-image-alongside-text.webp',
						),
					),
				),
			)
		);

		// Register a block - ACFBlock
		acf_register_block(
			array(
				'name'            => 'statistics',
				'title'           => __( 'Statistics', 'alrv_td' ),
				'description'     => __( 'A custom statistics.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H4V60H60V4ZM0 0V64H64V0H0Z" fill="#088D8D"/>
				<path d="M21.5854 23.0264V39.5352H17.7644V27.335L14 28.4348V25.5322L21.234 23.0264H21.5854Z" fill="#088D8D"/>
				<path d="M35.7248 36.5265V39.4745H24.2049V36.98L29.5113 31.4015C29.98 30.8648 30.3579 30.3848 30.6452 29.9615C30.9324 29.5306 31.1403 29.1413 31.2688 28.7936C31.4048 28.4459 31.4729 28.1322 31.4729 27.8525C31.4729 27.3763 31.4011 26.9795 31.2574 26.662C31.1214 26.337 30.9173 26.0913 30.6452 25.925C30.3806 25.7587 30.0518 25.6755 29.6587 25.6755C29.2656 25.6755 28.9217 25.7889 28.6269 26.0157C28.3321 26.2425 28.1016 26.5524 27.9353 26.9455C27.7765 27.3385 27.6972 27.7807 27.6972 28.2721H23.8647C23.8647 27.2592 24.1104 26.3332 24.6017 25.4941C25.1006 24.6551 25.7923 23.9861 26.6767 23.4872C27.5611 22.9808 28.5853 22.7275 29.7494 22.7275C30.9664 22.7275 31.9869 22.9165 32.8108 23.2945C33.6347 23.6724 34.2546 24.2204 34.6703 24.9385C35.0936 25.6491 35.3053 26.507 35.3053 27.5124C35.3053 28.0869 35.2146 28.6387 35.0332 29.1678C34.8517 29.6969 34.591 30.2223 34.2508 30.7438C33.9106 31.2579 33.4949 31.787 33.0036 32.3312C32.5198 32.8755 31.968 33.4537 31.3481 34.066L29.2165 36.5265H35.7248Z" fill="#088D8D"/>
				<path d="M41.961 29.9202H43.8206C44.2968 29.9202 44.6861 29.837 44.9884 29.6707C45.2983 29.4969 45.5289 29.255 45.6801 28.9451C45.8312 28.6276 45.9068 28.2534 45.9068 27.8225C45.9068 27.49 45.835 27.1838 45.6914 26.9041C45.5553 26.6244 45.3437 26.4015 45.0564 26.2352C44.7692 26.0613 44.4026 25.9744 43.9566 25.9744C43.6543 25.9744 43.3595 26.0386 43.0722 26.1671C42.785 26.2881 42.5469 26.4619 42.3579 26.6887C42.1765 26.9155 42.0858 27.1914 42.0858 27.5164H38.2534C38.2534 26.5791 38.5104 25.7778 39.0244 25.1126C39.5459 24.4399 40.23 23.9259 41.0766 23.5706C41.9308 23.2078 42.8492 23.0264 43.8319 23.0264C45.0035 23.0264 46.0316 23.2078 46.916 23.5706C47.8004 23.9259 48.4882 24.455 48.9796 25.158C49.4785 25.8534 49.7279 26.7152 49.7279 27.7432C49.7279 28.3101 49.5956 28.843 49.3311 29.3419C49.0665 29.8408 48.6961 30.2792 48.2199 30.6572C47.7437 31.0351 47.1843 31.3337 46.5418 31.5529C45.9068 31.7646 45.2114 31.8704 44.4555 31.8704H41.961V29.9202ZM41.961 32.7661V30.8613H44.4555C45.2794 30.8613 46.0316 30.9557 46.7119 31.1447C47.3922 31.3261 47.978 31.5983 48.4693 31.9611C48.9607 32.3239 49.3386 32.7737 49.6032 33.3104C49.8677 33.8395 50 34.448 50 35.1359C50 35.9069 49.8451 36.5948 49.5351 37.1995C49.2252 37.8042 48.7906 38.3144 48.2312 38.7302C47.6719 39.1459 47.018 39.4634 46.2697 39.6826C45.5213 39.8943 44.7087 40.0001 43.8319 40.0001C43.144 40.0001 42.4562 39.9094 41.7683 39.728C41.0804 39.539 40.453 39.2517 39.8861 38.8662C39.3192 38.4732 38.8619 37.9743 38.5141 37.3696C38.174 36.7573 38.0039 36.0278 38.0039 35.1812H41.8363C41.8363 35.5289 41.9308 35.8464 42.1198 36.1337C42.3163 36.4133 42.5771 36.6363 42.9021 36.8026C43.2272 36.9689 43.5787 37.0521 43.9566 37.0521C44.4253 37.0521 44.8221 36.9651 45.1472 36.7913C45.4797 36.6099 45.733 36.368 45.9068 36.0656C46.0807 35.7633 46.1676 35.4269 46.1676 35.0565C46.1676 34.4971 46.0731 34.0512 45.8842 33.7186C45.7027 33.386 45.4344 33.1441 45.0791 32.9929C44.7314 32.8417 44.3119 32.7661 43.8206 32.7661H41.961Z" fill="#088D8D"/>
				</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'statistics' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-statistics.webp',
						),
					),
				),
			)
		);
		// Register a block - Video.
		acf_register_block(
			array(
				'name'            => 'video',
				'title'           => __( 'Video', 'alrv_td' ),
				'description'     => __( 'A custom video.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="59" viewBox="0 0 64 59" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M64 54.2876C64 56.8861 62.3183 59 60.2513 59H3.74865C1.6817 59 0 56.8861 0 54.2876V4.71237C0 2.11387 1.6817 0 3.74865 0H60.2513C62.3183 0 64 2.11387 64 4.71237V54.2876ZM44.4691 26.8661L22.6513 15.5955C21.9525 15.2352 21.1568 15.3353 20.5292 15.8639C19.9018 16.3925 19.525 17.2797 19.525 18.2292V40.7704C19.525 41.7199 19.9016 42.6071 20.5292 43.1357C20.9077 43.4545 21.3476 43.6175 21.7903 43.6175C22.0814 43.6175 22.374 43.5471 22.6513 43.4041L44.4691 32.1335C45.3187 31.6947 45.8731 30.6543 45.8731 29.4998C45.8731 28.3453 45.3187 27.3053 44.4691 26.8661ZM24.0554 36.5222V22.4774L37.649 29.4998L24.0554 36.5222Z" fill="#088D8D"/>
</svg>
',
				'mode'            => 'edit',
				'keywords'        => array( 'video', 'theme', 'theme video' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-video.webp',
						),
					),
				),
			)
		);
		// Register a block - CheckList.
		acf_register_block(
			array(
				'name'            => 'checklist',
				'title'           => __( 'CheckList', 'alrv_td' ),
				'description'     => __( 'A custom Check List.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M19.4277 18V28.7283L2.99999 28.7283V18L19.4277 18Z" fill="#088D8D"/>
										<path d="M61 18V28.7283L44.5723 28.7283V18L61 18Z" fill="#088D8D"/>
										<path d="M40.5491 18V28.7283L24.1214 28.7283V18L40.5491 18Z" fill="#088D8D"/>
										<path d="M19.4277 35V45.7283H2.99999V35H19.4277Z" fill="#088D8D"/>
										<path d="M61 35V45.7283H44.5723V35H61Z" fill="#088D8D"/>
										<path d="M40.5491 35V45.7283H24.1214V35H40.5491Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'check', 'checklist', 'text' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-checklist.webp',
						),
					),
				),
			)
		);

		// Register a block - Form.
		acf_register_block(
			array(
				'name'            => 'form',
				'title'           => __( 'Form', 'alrv_td' ),
				'description'     => __( 'A custom Form', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H4V60H60V4ZM0 0V64H64V0H0Z" fill="#078D8D"/>
										<path d="M50 46H14V25L32 36L50 25V46Z" fill="#078D8D"/>
										<path d="M50 22L32 33L14 22V18H50V22Z" fill="#078D8D"/>
										</svg>
										',
				'mode'            => 'edit',
				'keywords'        => array( 'form', 'description', 'Form' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-form.webp',
						),
					),
				),
			)
		);

		// Register a block -Logos
		acf_register_block(
			array(
				'name'            => 'logos',
				'title'           => __( 'Logos', 'alrv_td' ),
				'description'     => __( 'A custom Logos.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H40V24H60V4ZM36 0V28H64V0H36Z" fill="#088D8D"/>
										<path d="M46.0714 12L40 20.2143V24H60V20.5714L56.0714 15.9286L52.8571 19.5L46.0714 12Z" fill="#088D8D"/>
										<path d="M56 9.5C56 10.8807 54.8807 12 53.5 12C52.1193 12 51 10.8807 51 9.5C51 8.11929 52.1193 7 53.5 7C54.8807 7 56 8.11929 56 9.5Z" fill="#088D8D"/>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M24 4H4V24H24V4ZM0 0V28H28V0H0Z" fill="#088D8D"/>
										<path d="M10.0714 12L4 20.2143V24H24V20.5714L20.0714 15.9286L16.8571 19.5L10.0714 12Z" fill="#088D8D"/>
										<path d="M22 9.5C22 10.8807 20.8807 12 19.5 12C18.1193 12 17 10.8807 17 9.5C17 8.11929 18.1193 7 19.5 7C20.8807 7 22 8.11929 22 9.5Z" fill="#088D8D"/>
										<path d="M28 36L28 40L-1.63189e-07 40L0 36L28 36Z" fill="#088D8D"/>
										<path d="M28 36L28 40L-1.63189e-07 40L0 36L28 36Z" fill="#088D8D"/>
										<path d="M28 36L28 40L-1.63189e-07 40L0 36L28 36Z" fill="#088D8D"/>
										<path d="M64 36L64 40L36 40L36 36L64 36Z" fill="#088D8D"/>
										<path d="M64 36L64 40L36 40L36 36L64 36Z" fill="#088D8D"/>
										<path d="M64 36L64 40L36 40L36 36L64 36Z" fill="#088D8D"/>
										<path d="M24 56L24 64L16 64L16 56L24 56Z" fill="#088D8D"/>
										<path d="M24 56L24 64L16 64L16 56L24 56Z" fill="#088D8D"/>
										<path d="M24 56L24 64L16 64L16 56L24 56Z" fill="#088D8D"/>
										<path d="M48 56L48 64L40 64L40 56L48 56Z" fill="#088D8D"/>
										<path d="M48 56L48 64L40 64L40 56L48 56Z" fill="#088D8D"/>
										<path d="M48 56L48 64L40 64L40 56L48 56Z" fill="#088D8D"/>
										<path d="M36 56L36 64L28 64L28 56L36 56Z" fill="#088D8D"/>
										<path d="M36 56L36 64L28 64L28 56L36 56Z" fill="#088D8D"/>
										<path d="M36 56L36 64L28 64L28 56L36 56Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Logos', 'description', 'Logos' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-logos.webp',
						),
					),
				),
			)
		);
		// Register a block -information
		acf_register_block(
			array(
				'name'            => 'information',
				'title'           => __( 'Information', 'alrv_td' ),
				'description'     => __( 'A custom Information.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H4V60H60V4ZM0 0V64H64V0H0Z" fill="#088D8D"/>
										<rect x="14" y="22" width="36" height="20" fill="#088D8D"/>
										<path d="M23.08 36H21.4323L23.9429 28.7273H25.9244L28.4316 36H26.7838L24.9621 30.3892H24.9053L23.08 36ZM22.977 33.1413H26.8691V34.3416H22.977V33.1413ZM29.3069 36V28.7273H32.2188C32.7539 28.7273 33.2001 28.8066 33.5576 28.9652C33.9151 29.1238 34.1838 29.344 34.3637 29.6257C34.5436 29.9051 34.6336 30.227 34.6336 30.5916C34.6336 30.8757 34.5768 31.1255 34.4632 31.3409C34.3495 31.554 34.1933 31.7292 33.9944 31.8665C33.7979 32.0014 33.573 32.0973 33.3197 32.1541V32.2251C33.5967 32.237 33.8559 32.3151 34.0974 32.4595C34.3412 32.6039 34.5389 32.8063 34.6904 33.0668C34.8419 33.3248 34.9177 33.6326 34.9177 33.9901C34.9177 34.3759 34.8218 34.7204 34.6301 35.0234C34.4407 35.3241 34.1601 35.562 33.7884 35.7372C33.4168 35.9124 32.9587 36 32.4142 36H29.3069ZM30.8445 34.7429H32.0981C32.5266 34.7429 32.8391 34.6612 33.0356 34.4979C33.2321 34.3321 33.3303 34.112 33.3303 33.8374C33.3303 33.6361 33.2818 33.4586 33.1847 33.3047C33.0877 33.1508 32.9492 33.0301 32.7693 32.9425C32.5917 32.8549 32.3798 32.8111 32.1336 32.8111H30.8445V34.7429ZM30.8445 31.7706H31.9845C32.1952 31.7706 32.3822 31.7339 32.5455 31.6605C32.7113 31.5848 32.8415 31.4782 32.9362 31.3409C33.0332 31.2036 33.0818 31.0391 33.0818 30.8473C33.0818 30.5845 32.9883 30.3726 32.8012 30.2116C32.6166 30.0507 32.3538 29.9702 32.0129 29.9702H30.8445V31.7706ZM42.3351 31.2734H40.7797C40.7513 31.0722 40.6933 30.8935 40.6057 30.7372C40.5181 30.5786 40.4057 30.4437 40.2684 30.3324C40.1311 30.2211 39.9724 30.1359 39.7925 30.0767C39.615 30.0175 39.422 29.9879 39.2137 29.9879C38.8373 29.9879 38.5094 30.0814 38.23 30.2685C37.9507 30.4531 37.734 30.723 37.5802 31.0781C37.4263 31.4309 37.3493 31.8594 37.3493 32.3636C37.3493 32.8821 37.4263 33.3177 37.5802 33.6705C37.7364 34.0232 37.9542 34.2895 38.2336 34.4695C38.5129 34.6494 38.8361 34.7393 39.203 34.7393C39.409 34.7393 39.5996 34.7121 39.7748 34.6577C39.9523 34.6032 40.1098 34.5239 40.2471 34.4197C40.3844 34.3132 40.498 34.1842 40.588 34.0327C40.6803 33.8812 40.7442 33.7083 40.7797 33.5142L42.3351 33.5213C42.2949 33.8551 42.1943 34.1771 42.0333 34.4872C41.8747 34.795 41.6604 35.0708 41.3905 35.3146C41.123 35.5561 40.8034 35.7479 40.4317 35.8899C40.0624 36.0296 39.6446 36.0994 39.1782 36.0994C38.5295 36.0994 37.9495 35.9527 37.4381 35.6591C36.9291 35.3655 36.5267 34.9406 36.2307 34.3842C35.9372 33.8279 35.7904 33.1544 35.7904 32.3636C35.7904 31.5705 35.9395 30.8958 36.2378 30.3395C36.5361 29.7831 36.941 29.3594 37.4523 29.0682C37.9637 28.7746 38.539 28.6278 39.1782 28.6278C39.5996 28.6278 39.9902 28.687 40.3501 28.8054C40.7123 28.9238 41.0331 29.0966 41.3124 29.3239C41.5918 29.5488 41.819 29.8246 41.9942 30.1513C42.1718 30.478 42.2854 30.852 42.3351 31.2734Z" fill="white"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'information', 'description', 'Information' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-information.webp',
						),
					),
				),
			),
		);
		// Register a block -FAQ
		acf_register_block(
			array(
				'name'            => 'faq',
				'title'           => __( 'FAQ', 'alrv_td' ),
				'description'     => __( 'A custom FAQS.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H4V60H60V4ZM0 0V64H64V0H0Z" fill="#088D8D"/>
								<path d="M34.7891 38.1953H28.0625C28.0625 36.8203 28.1562 35.6094 28.3438 34.5625C28.5469 33.5 28.8906 32.5469 29.375 31.7031C29.8594 30.8594 30.5156 30.0781 31.3438 29.3594C32.0781 28.75 32.7109 28.1641 33.2422 27.6016C33.7734 27.0391 34.1797 26.4688 34.4609 25.8906C34.7422 25.3125 34.8828 24.6953 34.8828 24.0391C34.8828 23.2266 34.7656 22.5625 34.5312 22.0469C34.3125 21.5312 33.9766 21.1484 33.5234 20.8984C33.0859 20.6328 32.5312 20.5 31.8594 20.5C31.3125 20.5 30.7969 20.6328 30.3125 20.8984C29.8438 21.1641 29.4609 21.5781 29.1641 22.1406C28.8672 22.6875 28.7031 23.4141 28.6719 24.3203H20.7266C20.7734 21.9922 21.2891 20.1016 22.2734 18.6484C23.2734 17.1797 24.6016 16.1094 26.2578 15.4375C27.9297 14.75 29.7969 14.4062 31.8594 14.4062C34.1406 14.4062 36.1016 14.7578 37.7422 15.4609C39.3828 16.1641 40.6406 17.2109 41.5156 18.6016C42.3906 19.9766 42.8281 21.6719 42.8281 23.6875C42.8281 25.0312 42.5703 26.2031 42.0547 27.2031C41.5547 28.1875 40.875 29.1094 40.0156 29.9688C39.1719 30.8125 38.2266 31.7188 37.1797 32.6875C36.2734 33.4844 35.6562 34.2969 35.3281 35.125C35 35.9375 34.8203 36.9609 34.7891 38.1953ZM27.1016 45.3203C27.1016 44.1953 27.5078 43.2578 28.3203 42.5078C29.1328 41.7422 30.1875 41.3594 31.4844 41.3594C32.7812 41.3594 33.8359 41.7422 34.6484 42.5078C35.4609 43.2578 35.8672 44.1953 35.8672 45.3203C35.8672 46.4453 35.4609 47.3906 34.6484 48.1562C33.8359 48.9062 32.7812 49.2812 31.4844 49.2812C30.1875 49.2812 29.1328 48.9062 28.3203 48.1562C27.5078 47.3906 27.1016 46.4453 27.1016 45.3203Z" fill="#088D8D"/>
								</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'FAQS', 'description' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-faq.webp',
						),
					),
				),
			),
		);

		// Register a block - ACFBlock
		acf_register_block(
			array(
				'name'            => 'conditions-list',
				'title'           => __( 'Conditions List', 'alrv_td' ),
				'description'     => __( 'A custom conditions list.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Icon', 'with', 'description', 'Icon with description' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-conditions-list.webp',
						),
					),
				),
			)
		);

		// Register a block - Pollen Levels
		acf_register_block(
			array(
				'name'            => 'pollen-levels',
				'title'           => __( 'Pollen Levels', 'alrv_td' ),
				'description'     => __( 'A custom pollen levels.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0.000732422 64L0.000732422 0L28.0007 0L28.0007 64H0.000732422Z" fill="#088D8D"/>
										<path d="M36.0007 64L36.0007 0L64.0007 0L64.0007 64H36.0007Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Icon', 'with', 'description', 'Icon with description' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-pollen-levels.webp',
						),
					),
				),
			)
		);

		// Register a block - providers
		acf_register_block(
			array(
				'name'            => 'providers',
				'title'           => __( 'Providers', 'alrv_td' ),
				'description'     => __( 'A custom providers selection block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Icon', 'with', 'description', 'Icon with description' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-providers.webp',
						),
					),
				),
			)
		);

		// Register a block - providers Slider
		acf_register_block(
			array(
				'name'            => 'providers-slider',
				'title'           => __( 'Providers Slider', 'alrv_td' ),
				'description'     => __( 'A custom providers selection block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Providers', 'Slider'),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-providers.webp',
						),
					),
				),
			)
		);

		// Register a block - Services
		acf_register_block(
			array(
				'name'            => 'services',
				'title'           => __( 'Services', 'alrv_td' ),
				'description'     => __( 'A custom services selection block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Icon', 'with', 'description', 'Icon with description' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-services.webp',
						),
					),
				),
			)
		);

		// Register a block - Services Slider 
		acf_register_block(
			array(
				'name'            => 'services-slider',
				'title'           => __( 'Services Slider', 'alrv_td' ),
				'description'     => __( 'A custom services Slider selection block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Services', 'Slider'),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-services.webp',
						),
					),
				),
			)
		);

		// Register a block - Icon with description
		acf_register_block(
			array(
				'name'            => 'iwd',
				'title'           => __( 'Icon with description', 'alrv_td' ),
				'description'     => __( 'A custom icon with description block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Icon', 'with', 'description', 'Icon with description' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-iwd.webp',
						),
					),
				),
			)
		);
		// Register a block - Timing & Shots Timings
		acf_register_block(
			array(
				'name'            => 'timing-shots-schedules',
				'title'           => __( 'Hours of Operation', 'alrv_td' ),
				'description'     => __( 'A custom hours of operation block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0 0H28V28H0V0Z" fill="#088D8D"/>
										<path d="M28 52L28 56L-1.63189e-07 56L0 52L28 52Z" fill="#088D8D"/>
										<path d="M28 52L28 56L-1.63189e-07 56L0 52L28 52Z" fill="#088D8D"/>
										<path d="M28 52L28 56L-1.63189e-07 56L0 52L28 52Z" fill="#088D8D"/>
										<path d="M28 44L28 48L-1.63189e-07 48L0 44L28 44Z" fill="#088D8D"/>
										<path d="M28 44L28 48L-1.63189e-07 48L0 44L28 44Z" fill="#088D8D"/>
										<path d="M28 44L28 48L-1.63189e-07 48L0 44L28 44Z" fill="#088D8D"/>
										<path d="M28 36L28 40L-1.63189e-07 40L0 36L28 36Z" fill="#088D8D"/>
										<path d="M28 36L28 40L-1.63189e-07 40L0 36L28 36Z" fill="#088D8D"/>
										<path d="M28 36L28 40L-1.63189e-07 40L0 36L28 36Z" fill="#088D8D"/>
										<path d="M14 60L14 64L-1.63189e-07 64L0 60L14 60Z" fill="#088D8D"/>
										<path d="M14 60L14 64L-1.63189e-07 64L0 60L14 60Z" fill="#088D8D"/>
										<path d="M14 60L14 64L-1.63189e-07 64L0 60L14 60Z" fill="#088D8D"/>
										<path d="M36 0H64V28H36V0Z" fill="#088D8D"/>
										<path d="M64 52L64 56L36 56L36 52L64 52Z" fill="#088D8D"/>
										<path d="M64 52L64 56L36 56L36 52L64 52Z" fill="#088D8D"/>
										<path d="M64 52L64 56L36 56L36 52L64 52Z" fill="#088D8D"/>
										<path d="M64 44L64 48L36 48L36 44L64 44Z" fill="#088D8D"/>
										<path d="M64 44L64 48L36 48L36 44L64 44Z" fill="#088D8D"/>
										<path d="M64 44L64 48L36 48L36 44L64 44Z" fill="#088D8D"/>
										<path d="M64 36L64 40L36 40L36 36L64 36Z" fill="#088D8D"/>
										<path d="M64 36L64 40L36 40L36 36L64 36Z" fill="#088D8D"/>
										<path d="M64 36L64 40L36 40L36 36L64 36Z" fill="#088D8D"/>
										<path d="M50 60L50 64L36 64L36 60L50 60Z" fill="#088D8D"/>
										<path d="M50 60L50 64L36 64L36 60L50 60Z" fill="#088D8D"/>
										<path d="M50 60L50 64L36 64L36 60L50 60Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( '' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-timing-schedules.webp',
						),
					),
				),
			)
		);

		// Register a block - Tabbed Content
		acf_register_block(
			array(
				'name'            => 'tabbed-content',
				'title'           => __( 'Tabbed Content', 'alrv_td' ),
				'description'     => __( 'A custom Tabbed Content block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0 0H64V28H0V0Z" fill="#088D8D"/>
										<path d="M0 36H16V64H0V36Z" fill="#088D8D"/>
										<path d="M24 36H40V64H24V36Z" fill="#088D8D"/>
										<path d="M48 36H64V64H48V36Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Icon', 'with', 'description', 'Icon with description' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-tabbed-content.webp',
						),
					),
				),
			)
		);

		// Register a block - Testimonial
		acf_register_block(
			array(
				'name'            => 'testimonial',
				'title'           => __( 'Testimonial', 'alrv_td' ),
				'description'     => __( 'A custom testimonial block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M30 19H14V35H21V45H26L30 34V19Z" fill="#088D8D"/>
										<path d="M50 19H34V35H41V45H46L50 34V19Z" fill="#088D8D"/>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H4V60H60V4ZM0 0V64H64V0H0Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Icon', 'with', 'description', 'Icon with description' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-testimonial.webp',
						),
					),
				),
			)
		);

		// Register a block - Featured Text
		acf_register_block(
			array(
				'name'            => 'featured-text',
				'title'           => __( 'Featured Text', 'alrv_td' ),
				'description'     => __( 'A custom featured text block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M64.0001 0L64.0001 4L6.06622e-05 4L6.10352e-05 -1.31134e-06L64.0001 0Z" fill="#088D8D"/>
										<path d="M64.0001 0L64.0001 4L6.06622e-05 4L6.10352e-05 -1.31134e-06L64.0001 0Z" fill="#088D8D"/>
										<path d="M64.0001 0L64.0001 4L6.06622e-05 4L6.10352e-05 -1.31134e-06L64.0001 0Z" fill="#088D8D"/>
										<path d="M64.0001 0L64.0001 12L5.99161e-05 12L6.10352e-05 -1.31134e-06L64.0001 0Z" fill="#088D8D"/>
										<path d="M64.0001 0L64.0001 12L5.99161e-05 12L6.10352e-05 -1.31134e-06L64.0001 0Z" fill="#088D8D"/>
										<path d="M64.0001 0L64.0001 12L5.99161e-05 12L6.10352e-05 -1.31134e-06L64.0001 0Z" fill="#088D8D"/>
										<path d="M32.0001 32L32.0001 36L6.06622e-05 36L6.10352e-05 32L32.0001 32Z" fill="#088D8D"/>
										<path d="M32.0001 32L32.0001 36L6.06622e-05 36L6.10352e-05 32L32.0001 32Z" fill="#088D8D"/>
										<path d="M32.0001 32L32.0001 36L6.06622e-05 36L6.10352e-05 32L32.0001 32Z" fill="#088D8D"/>
										<path d="M64.0001 16L64.0001 20L6.06622e-05 20L6.10352e-05 16L64.0001 16Z" fill="#088D8D"/>
										<path d="M64.0001 16L64.0001 20L6.06622e-05 20L6.10352e-05 16L64.0001 16Z" fill="#088D8D"/>
										<path d="M64.0001 16L64.0001 20L6.06622e-05 20L6.10352e-05 16L64.0001 16Z" fill="#088D8D"/>
										<path d="M64 44L64 48L-3.73004e-07 48L0 44L64 44Z" fill="#088D8D"/>
										<path d="M64 44L64 48L-3.73004e-07 48L0 44L64 44Z" fill="#088D8D"/>
										<path d="M64 44L64 48L-3.73004e-07 48L0 44L64 44Z" fill="#088D8D"/>
										<path d="M64 24L64 28L-3.73004e-07 28L0 24L64 24Z" fill="#088D8D"/>
										<path d="M64 24L64 28L-3.73004e-07 28L0 24L64 24Z" fill="#088D8D"/>
										<path d="M64 24L64 28L-3.73004e-07 28L0 24L64 24Z" fill="#088D8D"/>
										<path d="M32 60L32 64L-3.73004e-07 64L0 60L32 60Z" fill="#088D8D"/>
										<path d="M32 60L32 64L-3.73004e-07 64L0 60L32 60Z" fill="#088D8D"/>
										<path d="M32 60L32 64L-3.73004e-07 64L0 60L32 60Z" fill="#088D8D"/>
										<path d="M64 52L64 56L-3.73004e-07 56L0 52L64 52Z" fill="#088D8D"/>
										<path d="M64 52L64 56L-3.73004e-07 56L0 52L64 52Z" fill="#088D8D"/>
										<path d="M64 52L64 56L-3.73004e-07 56L0 52L64 52Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Icon', 'with', 'description', 'Icon with description' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-featured-text.webp',
						),
					),
				),
			)
		);

		// Register a block - Section Head
		acf_register_block(
			array(
				'name'            => 'section-head',
				'title'           => __( 'Section Head', 'alrv_td' ),
				'description'     => __( 'A custom Section Head block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H4V60H60V4ZM0 0V64H64V0H0Z" fill="#088D8D"/>
<path d="M39 28.2222V34.8022H25V28.2222H39ZM25 15V49H17V15H25ZM47 15V49H39V15H47Z" fill="#088D8D"/>
</svg>
',
				'mode'            => 'edit',
				'keywords'        => array( 'Icon', 'with', 'description', 'Icon with description' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-section-head.webp',
						),
					),
				),
			)
		);

		// Register a block - Numbered Text Block
		acf_register_block(
			array(
				'name'            => 'numbered-text',
				'title'           => __( 'Numbered Text', 'alrv_td' ),
				'description'     => __( 'A custom numbered text block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H4V60H60V4ZM0 0V64H64V0H0Z" fill="#088D8D"/>
										<path d="M21.5854 23.0263V39.5351H17.7644V27.3349L14 28.4348V25.5321L21.234 23.0263H21.5854Z" fill="#088D8D"/>
										<path d="M35.7246 36.5265V39.4745H24.2047V36.98L29.5111 31.4015C29.9797 30.8648 30.3577 30.3848 30.6449 29.9615C30.9322 29.5306 31.14 29.1413 31.2685 28.7936C31.4046 28.4459 31.4726 28.1322 31.4726 27.8525C31.4726 27.3763 31.4008 26.9795 31.2572 26.662C31.1211 26.337 30.917 26.0913 30.6449 25.925C30.3804 25.7587 30.0515 25.6755 29.6585 25.6755C29.2654 25.6755 28.9215 25.7889 28.6267 26.0157C28.3319 26.2425 28.1013 26.5524 27.935 26.9455C27.7763 27.3385 27.6969 27.7807 27.6969 28.2721H23.8645C23.8645 27.2592 24.1102 26.3332 24.6015 25.4941C25.1004 24.6551 25.792 23.9861 26.6764 23.4872C27.5608 22.9808 28.5851 22.7275 29.7492 22.7275C30.9662 22.7275 31.9866 22.9165 32.8106 23.2945C33.6345 23.6724 34.2543 24.2204 34.6701 24.9385C35.0934 25.6491 35.305 26.507 35.305 27.5124C35.305 28.0869 35.2143 28.6387 35.0329 29.1678C34.8515 29.6969 34.5907 30.2223 34.2506 30.7438C33.9104 31.2579 33.4947 31.787 33.0033 32.3312C32.5195 32.8755 31.9677 33.4537 31.3479 34.066L29.2163 36.5265H35.7246Z" fill="#088D8D"/>
										<path d="M41.961 29.9201H43.8205C44.2967 29.9201 44.686 29.837 44.9884 29.6707C45.2983 29.4968 45.5289 29.2549 45.68 28.945C45.8312 28.6275 45.9068 28.2533 45.9068 27.8225C45.9068 27.4899 45.835 27.1838 45.6914 26.9041C45.5553 26.6244 45.3437 26.4014 45.0564 26.2351C44.7692 26.0612 44.4026 25.9743 43.9566 25.9743C43.6542 25.9743 43.3594 26.0386 43.0722 26.1671C42.7849 26.288 42.5468 26.4619 42.3579 26.6886C42.1764 26.9154 42.0857 27.1913 42.0857 27.5163H38.2533C38.2533 26.579 38.5103 25.7778 39.0243 25.1126C39.5459 24.4398 40.23 23.9258 41.0766 23.5706C41.9308 23.2077 42.8492 23.0263 43.8319 23.0263C45.0035 23.0263 46.0315 23.2077 46.9159 23.5706C47.8003 23.9258 48.4882 24.455 48.9795 25.1579C49.4784 25.8534 49.7279 26.7151 49.7279 27.7431C49.7279 28.31 49.5956 28.843 49.331 29.3418C49.0665 29.8407 48.6961 30.2792 48.2199 30.6571C47.7436 31.0351 47.1843 31.3336 46.5418 31.5528C45.9068 31.7645 45.2114 31.8703 44.4555 31.8703H41.961V29.9201ZM41.961 32.7661V30.8612H44.4555C45.2794 30.8612 46.0315 30.9557 46.7118 31.1447C47.3921 31.3261 47.978 31.5982 48.4693 31.961C48.9606 32.3239 49.3386 32.7736 49.6031 33.3103C49.8677 33.8394 50 34.4479 50 35.1358C50 35.9068 49.845 36.5947 49.5351 37.1994C49.2252 37.8041 48.7906 38.3144 48.2312 38.7301C47.6718 39.1459 47.018 39.4633 46.2696 39.6825C45.5213 39.8942 44.7087 40 43.8319 40C43.144 40 42.4561 39.9093 41.7683 39.7279C41.0804 39.5389 40.453 39.2517 39.8861 38.8662C39.3191 38.4731 38.8618 37.9742 38.5141 37.3695C38.174 36.7572 38.0039 36.0278 38.0039 35.1812H41.8363C41.8363 35.5289 41.9308 35.8464 42.1197 36.1336C42.3163 36.4133 42.5771 36.6363 42.9021 36.8026C43.2271 36.9689 43.5786 37.052 43.9566 37.052C44.4252 37.052 44.8221 36.9651 45.1471 36.7912C45.4797 36.6098 45.7329 36.3679 45.9068 36.0656C46.0807 35.7632 46.1676 35.4268 46.1676 35.0564C46.1676 34.4971 46.0731 34.0511 45.8841 33.7185C45.7027 33.3859 45.4344 33.144 45.0791 32.9928C44.7314 32.8417 44.3119 32.7661 43.8205 32.7661H41.961Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Icon', 'with', 'description', 'Icon with description' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-numbered-text.webp',
						),
					),
				),
			)
		);
		// Register a block - Riskfactor
		acf_register_block(
			array(
				'name'            => 'riskfactor',
				'title'           => __( 'Riskfactor', 'alrv_td' ),
				'description'     => __( 'A custom riskfactor.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H40V24H60V4ZM36 0V28H64V0H36Z" fill="#088D8D"/>
										<path d="M46.0714 12L40 20.2143V24H60V20.5714L56.0714 15.9286L52.8571 19.5L46.0714 12Z" fill="#088D8D"/>
										<path d="M56 9.5C56 10.8807 54.8807 12 53.5 12C52.1193 12 51 10.8807 51 9.5C51 8.11929 52.1193 7 53.5 7C54.8807 7 56 8.11929 56 9.5Z" fill="#088D8D"/>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M24 4H4V24H24V4ZM0 0V28H28V0H0Z" fill="#088D8D"/>
										<path d="M10.0714 12L4 20.2143V24H24V20.5714L20.0714 15.9286L16.8571 19.5L10.0714 12Z" fill="#088D8D"/>
										<path d="M22 9.5C22 10.8807 20.8807 12 19.5 12C18.1193 12 17 10.8807 17 9.5C17 8.11929 18.1193 7 19.5 7C20.8807 7 22 8.11929 22 9.5Z" fill="#088D8D"/>
										<path d="M28 36L28 40L-1.63189e-07 40L0 36L28 36Z" fill="#088D8D"/>
										<path d="M28 36L28 40L-1.63189e-07 40L0 36L28 36Z" fill="#088D8D"/>
										<path d="M28 36L28 40L-1.63189e-07 40L0 36L28 36Z" fill="#088D8D"/>
										<path d="M64 36L64 40L36 40L36 36L64 36Z" fill="#088D8D"/>
										<path d="M64 36L64 40L36 40L36 36L64 36Z" fill="#088D8D"/>
										<path d="M64 36L64 40L36 40L36 36L64 36Z" fill="#088D8D"/>
										<path d="M24 56L24 64L16 64L16 56L24 56Z" fill="#088D8D"/>
										<path d="M24 56L24 64L16 64L16 56L24 56Z" fill="#088D8D"/>
										<path d="M24 56L24 64L16 64L16 56L24 56Z" fill="#088D8D"/>
										<path d="M48 56L48 64L40 64L40 56L48 56Z" fill="#088D8D"/>
										<path d="M48 56L48 64L40 64L40 56L48 56Z" fill="#088D8D"/>
										<path d="M48 56L48 64L40 64L40 56L48 56Z" fill="#088D8D"/>
										<path d="M36 56L36 64L28 64L28 56L36 56Z" fill="#088D8D"/>
										<path d="M36 56L36 64L28 64L28 56L36 56Z" fill="#088D8D"/>
										<path d="M36 56L36 64L28 64L28 56L36 56Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'risk', 'factor', 'description', 'riskfactor' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-riskfactor.webp',
						),
					),
				),
			)
		);
		// Register a block -Mid Page
		acf_register_block(
			array(
				'name'            => 'midpagecta',
				'title'           => __( 'midpagecta', 'alrv_td' ),
				'description'     => __( 'A custom midpagecta.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										</svg>
										',
				'mode'            => 'edit',
				'keywords'        => array( 'midpagecta', 'description', 'MidPAge Cta' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-midpagecta.webp',
						),
					),
				),
			),
		);
		// Register a block -3 Column CTA
		acf_register_block(
			array(
				'name'            => 'three-column-cta',
				'title'           => __( '3 Column CTA', 'alrv_td' ),
				'description'     => __( 'A custom 3 column CTA.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0 0H16V64H0V0Z" fill="#088D8D"/>
										<path d="M24 0H40V64H24V0Z" fill="#088D8D"/>
										<path d="M48 0H64V64H48V0Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'midpagecta', 'description', 'MidPAge Cta' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-three-column-cta.webp',
						),
					),
				),
			),
		);
		// Register a block - List
		acf_register_block(
			array(
				'name'            => 'list',
				'title'           => __( 'Glide List', 'alrv_td' ),
				'description'     => __( 'A custom Glide list', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M64 0L64 12L20 12L20 -1.31134e-06L64 0Z" fill="#088D8D"/>
										<path d="M64 0L64 12L20 12L20 -1.31134e-06L64 0Z" fill="#088D8D"/>
										<path d="M64 0L64 12L20 12L20 -1.31134e-06L64 0Z" fill="#088D8D"/>
										<path d="M0 0H12V12H0V0Z" fill="#088D8D"/>
										<path d="M64 52L64 64L20 64L20 52L64 52Z" fill="#088D8D"/>
										<path d="M64 52L64 64L20 64L20 52L64 52Z" fill="#088D8D"/>
										<path d="M64 52L64 64L20 64L20 52L64 52Z" fill="#088D8D"/>
										<path d="M0 52H12V64H0V52Z" fill="#088D8D"/>
										<path d="M64 26L64 38L20 38L20 26L64 26Z" fill="#088D8D"/>
										<path d="M64 26L64 38L20 38L20 26L64 26Z" fill="#088D8D"/>
										<path d="M64 26L64 38L20 38L20 26L64 26Z" fill="#088D8D"/>
										<path d="M0 26H12V38H0V26Z" fill="#088D8D"/>
										</svg>
',
				'mode'            => 'edit',
				'keywords'        => array( 'list', 'List' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-list.webp',
						),
					),
				),
			)
		);
		// Register a block - Pollen Count
		acf_register_block(
			array(
				'name'            => 'pollen-count',
				'title'           => __( 'Pollen CTA', 'alrv_td' ),
				'description'     => __( 'A custom glide pollen count block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H4V60H60V4ZM0 0V64H64V0H0Z" fill="#088D8D"/>
<path d="M21.5854 23.0263V39.5351H17.7644V27.3349L14 28.4348V25.5321L21.234 23.0263H21.5854Z" fill="#088D8D"/>
<path d="M35.7246 36.5265V39.4745H24.2047V36.98L29.5111 31.4015C29.9797 30.8648 30.3577 30.3848 30.6449 29.9615C30.9322 29.5306 31.14 29.1413 31.2685 28.7936C31.4046 28.4459 31.4726 28.1322 31.4726 27.8525C31.4726 27.3763 31.4008 26.9795 31.2572 26.662C31.1211 26.337 30.917 26.0913 30.6449 25.925C30.3804 25.7587 30.0515 25.6755 29.6585 25.6755C29.2654 25.6755 28.9215 25.7889 28.6267 26.0157C28.3319 26.2425 28.1013 26.5524 27.935 26.9455C27.7763 27.3385 27.6969 27.7807 27.6969 28.2721H23.8645C23.8645 27.2592 24.1102 26.3332 24.6015 25.4941C25.1004 24.6551 25.792 23.9861 26.6764 23.4872C27.5608 22.9808 28.5851 22.7275 29.7492 22.7275C30.9662 22.7275 31.9866 22.9165 32.8106 23.2945C33.6345 23.6724 34.2543 24.2204 34.6701 24.9385C35.0934 25.6491 35.305 26.507 35.305 27.5124C35.305 28.0869 35.2143 28.6387 35.0329 29.1678C34.8515 29.6969 34.5907 30.2223 34.2506 30.7438C33.9104 31.2579 33.4947 31.787 33.0033 32.3312C32.5195 32.8755 31.9677 33.4537 31.3479 34.066L29.2163 36.5265H35.7246Z" fill="#088D8D"/>
<path d="M41.961 29.9201H43.8205C44.2967 29.9201 44.686 29.837 44.9884 29.6707C45.2983 29.4968 45.5289 29.2549 45.68 28.945C45.8312 28.6275 45.9068 28.2533 45.9068 27.8225C45.9068 27.4899 45.835 27.1838 45.6914 26.9041C45.5553 26.6244 45.3437 26.4014 45.0564 26.2351C44.7692 26.0612 44.4026 25.9743 43.9566 25.9743C43.6542 25.9743 43.3594 26.0386 43.0722 26.1671C42.7849 26.288 42.5468 26.4619 42.3579 26.6886C42.1764 26.9154 42.0857 27.1913 42.0857 27.5163H38.2533C38.2533 26.579 38.5103 25.7778 39.0243 25.1126C39.5459 24.4398 40.23 23.9258 41.0766 23.5706C41.9308 23.2077 42.8492 23.0263 43.8319 23.0263C45.0035 23.0263 46.0315 23.2077 46.9159 23.5706C47.8003 23.9258 48.4882 24.455 48.9795 25.1579C49.4784 25.8534 49.7279 26.7151 49.7279 27.7431C49.7279 28.31 49.5956 28.843 49.331 29.3418C49.0665 29.8407 48.6961 30.2792 48.2199 30.6571C47.7436 31.0351 47.1843 31.3336 46.5418 31.5528C45.9068 31.7645 45.2114 31.8703 44.4555 31.8703H41.961V29.9201ZM41.961 32.7661V30.8612H44.4555C45.2794 30.8612 46.0315 30.9557 46.7118 31.1447C47.3921 31.3261 47.978 31.5982 48.4693 31.961C48.9606 32.3239 49.3386 32.7736 49.6031 33.3103C49.8677 33.8394 50 34.4479 50 35.1358C50 35.9068 49.845 36.5947 49.5351 37.1994C49.2252 37.8041 48.7906 38.3144 48.2312 38.7301C47.6718 39.1459 47.018 39.4633 46.2696 39.6825C45.5213 39.8942 44.7087 40 43.8319 40C43.144 40 42.4561 39.9093 41.7683 39.7279C41.0804 39.5389 40.453 39.2517 39.8861 38.8662C39.3191 38.4731 38.8618 37.9742 38.5141 37.3695C38.174 36.7572 38.0039 36.0278 38.0039 35.1812H41.8363C41.8363 35.5289 41.9308 35.8464 42.1197 36.1336C42.3163 36.4133 42.5771 36.6363 42.9021 36.8026C43.2271 36.9689 43.5786 37.052 43.9566 37.052C44.4252 37.052 44.8221 36.9651 45.1471 36.7912C45.4797 36.6098 45.7329 36.3679 45.9068 36.0656C46.0807 35.7632 46.1676 35.4268 46.1676 35.0564C46.1676 34.4971 46.0731 34.0511 45.8841 33.7185C45.7027 33.3859 45.4344 33.144 45.0791 32.9928C44.7314 32.8417 44.3119 32.7661 43.8205 32.7661H41.961Z" fill="#088D8D"/>
</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'list', 'List' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-pollen-cta.webp',
						),
					),
				),
			)
		);

				// Register a block - Pollen Count
		acf_register_block(
			array(
				'name'            => 'pollen-count-accuweather',
				'title'           => __( 'Pollen Count (AccuWeather)', 'alrv_td' ),
				'description'     => __( 'A custom glide pollen count block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H4V60H60V4ZM0 0V64H64V0H0Z" fill="#088D8D"/>
<path d="M21.5854 23.0263V39.5351H17.7644V27.3349L14 28.4348V25.5321L21.234 23.0263H21.5854Z" fill="#088D8D"/>
<path d="M35.7246 36.5265V39.4745H24.2047V36.98L29.5111 31.4015C29.9797 30.8648 30.3577 30.3848 30.6449 29.9615C30.9322 29.5306 31.14 29.1413 31.2685 28.7936C31.4046 28.4459 31.4726 28.1322 31.4726 27.8525C31.4726 27.3763 31.4008 26.9795 31.2572 26.662C31.1211 26.337 30.917 26.0913 30.6449 25.925C30.3804 25.7587 30.0515 25.6755 29.6585 25.6755C29.2654 25.6755 28.9215 25.7889 28.6267 26.0157C28.3319 26.2425 28.1013 26.5524 27.935 26.9455C27.7763 27.3385 27.6969 27.7807 27.6969 28.2721H23.8645C23.8645 27.2592 24.1102 26.3332 24.6015 25.4941C25.1004 24.6551 25.792 23.9861 26.6764 23.4872C27.5608 22.9808 28.5851 22.7275 29.7492 22.7275C30.9662 22.7275 31.9866 22.9165 32.8106 23.2945C33.6345 23.6724 34.2543 24.2204 34.6701 24.9385C35.0934 25.6491 35.305 26.507 35.305 27.5124C35.305 28.0869 35.2143 28.6387 35.0329 29.1678C34.8515 29.6969 34.5907 30.2223 34.2506 30.7438C33.9104 31.2579 33.4947 31.787 33.0033 32.3312C32.5195 32.8755 31.9677 33.4537 31.3479 34.066L29.2163 36.5265H35.7246Z" fill="#088D8D"/>
<path d="M41.961 29.9201H43.8205C44.2967 29.9201 44.686 29.837 44.9884 29.6707C45.2983 29.4968 45.5289 29.2549 45.68 28.945C45.8312 28.6275 45.9068 28.2533 45.9068 27.8225C45.9068 27.4899 45.835 27.1838 45.6914 26.9041C45.5553 26.6244 45.3437 26.4014 45.0564 26.2351C44.7692 26.0612 44.4026 25.9743 43.9566 25.9743C43.6542 25.9743 43.3594 26.0386 43.0722 26.1671C42.7849 26.288 42.5468 26.4619 42.3579 26.6886C42.1764 26.9154 42.0857 27.1913 42.0857 27.5163H38.2533C38.2533 26.579 38.5103 25.7778 39.0243 25.1126C39.5459 24.4398 40.23 23.9258 41.0766 23.5706C41.9308 23.2077 42.8492 23.0263 43.8319 23.0263C45.0035 23.0263 46.0315 23.2077 46.9159 23.5706C47.8003 23.9258 48.4882 24.455 48.9795 25.1579C49.4784 25.8534 49.7279 26.7151 49.7279 27.7431C49.7279 28.31 49.5956 28.843 49.331 29.3418C49.0665 29.8407 48.6961 30.2792 48.2199 30.6571C47.7436 31.0351 47.1843 31.3336 46.5418 31.5528C45.9068 31.7645 45.2114 31.8703 44.4555 31.8703H41.961V29.9201ZM41.961 32.7661V30.8612H44.4555C45.2794 30.8612 46.0315 30.9557 46.7118 31.1447C47.3921 31.3261 47.978 31.5982 48.4693 31.961C48.9606 32.3239 49.3386 32.7736 49.6031 33.3103C49.8677 33.8394 50 34.4479 50 35.1358C50 35.9068 49.845 36.5947 49.5351 37.1994C49.2252 37.8041 48.7906 38.3144 48.2312 38.7301C47.6718 39.1459 47.018 39.4633 46.2696 39.6825C45.5213 39.8942 44.7087 40 43.8319 40C43.144 40 42.4561 39.9093 41.7683 39.7279C41.0804 39.5389 40.453 39.2517 39.8861 38.8662C39.3191 38.4731 38.8618 37.9742 38.5141 37.3695C38.174 36.7572 38.0039 36.0278 38.0039 35.1812H41.8363C41.8363 35.5289 41.9308 35.8464 42.1197 36.1336C42.3163 36.4133 42.5771 36.6363 42.9021 36.8026C43.2271 36.9689 43.5786 37.052 43.9566 37.052C44.4252 37.052 44.8221 36.9651 45.1471 36.7912C45.4797 36.6098 45.7329 36.3679 45.9068 36.0656C46.0807 35.7632 46.1676 35.4268 46.1676 35.0564C46.1676 34.4971 46.0731 34.0511 45.8841 33.7185C45.7027 33.3859 45.4344 33.144 45.0791 32.9928C44.7314 32.8417 44.3119 32.7661 43.8205 32.7661H41.961Z" fill="#088D8D"/>
</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'list', 'List' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-pollen-cta.webp',
						),
					),
				),
			)
		);


		// Register a block - Pollen Count
		acf_register_block(
			array(
				'name'            => 'featured-providers',
				'title'           => __( 'Providers (Single Location)', 'alrv_td' ),
				'description'     => __( 'A custom glide pollen count block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '',
				'mode'            => 'edit',
				'keywords'        => array( 'list', 'List' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-list.webp',
						),
					),
				),
			)
		);
				// Register a block - Pollen Count
		acf_register_block(
			array(
				'name'            => 'featured-services',
				'title'           => __( 'Services (Single Location)', 'alrv_td' ),
				'description'     => __( 'A custom glide pollen count block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '',
				'mode'            => 'edit',
				'keywords'        => array( 'list', 'List' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-list.webp',
						),
					),
				),
			)
		);
				// Register a block - Pollen Count
		acf_register_block(
			array(
				'name'            => 'featured-conditions',
				'title'           => __( 'Conditions (Single Location)', 'alrv_td' ),
				'description'     => __( 'A custom glide pollen count block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '',
				'mode'            => 'edit',
				'keywords'        => array( 'list', 'List' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-list.webp',
						),
					),
				),
			)
		);

		// Register a block - JumpLink
		acf_register_block(
			array(
				'name'            => 'jumplink',
				'title'           => __( 'JumpLink', 'alrv_td' ),
				'description'     => __( 'A custom JumpLink.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => 'editor-unlink',
				'mode'            => 'edit',
				'keywords'        => array( 'jump', 'link' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/jumplink.webp',
						),
					),
				),
			)
		);


		// Register a block - News
		acf_register_block(
			array(
				'name'            => 'articles',
				'title'           => __( 'Articles', 'alrv_td' ),
				'description'     => __( 'A custom News.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => 'welcome-write-blog',
				'mode'            => 'edit',
				'keywords'        => array( 'jump', 'link' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/jumplink.webp',
						),
					),
				),
			)
		);


		// Register a block - News
		acf_register_block(
			array(
				'name'            => 'ppc-locations',
				'title'           => __( 'PPC Locations', 'alrv_td' ),
				'description'     => __( 'A custom PPC Location.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => 'welcome-write-blog',
				'mode'            => 'edit',
				'keywords'        => array( 'jump', 'link' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/ppc-locations.webp',
						),
					),
				),
			)
		);

		// Register a block - PPC Locations
		acf_register_block(
			array(
				'name'            => 'ppc-locations',
				'title'           => __( 'PPC Locations', 'alrv_td' ),
				'description'     => __( 'A custom PPC Location.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => 'welcome-write-blog',
				'mode'            => 'edit',
				'keywords'        => array( 'jump', 'link' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/ppc-locations.webp',
						),
					),
				),
			)
		);
		// Register a block - PPC Map
		acf_register_block(
			array(
				'name'            => 'ppc-map',
				'title'           => __( 'PPC Map', 'alrv_td' ),
				'description'     => __( 'A custom PPC Map.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => 'welcome-write-blog',
				'mode'            => 'edit',
				'keywords'        => array( 'jump', 'link' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/ppc-map.webp',
						),
					),
				),
			)
		);

			// Register a block - PPC Review
		acf_register_block(
			array(
				'name'            => 'ppc-reviews',
				'title'           => __( 'PPC Reviews', 'alrv_td' ),
				'description'     => __( 'A custom PPC Reviews.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => 'welcome-write-blog',
				'mode'            => 'edit',
				'keywords'        => array( 'jump', 'link' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/ppc-reviews.webp',
						),
					),
				),
			)
		);

			// Register a block - PPC Review slider 
		acf_register_block(
			array(
				'name'            => 'ppc-reviews-slider',
				'title'           => __( 'PPC Reviews slider', 'alrv_td' ),
				'description'     => __( 'A custom PPC Reviews slider.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => 'welcome-write-blog',
				'mode'            => 'edit',
				'keywords'        => array( 'PPC', 'Reviews','slider'),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/ppc-reviews.webp',
						),
					),
				),
			)
		);


		// Register a block - Location Filter
		acf_register_block(
			array(
				'name'            => 'location-filter',
				'title'           => __( 'Location Filter', 'alrv_td' ),
				'description'     => __( 'A custom Location Filter block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H4V60H60V4ZM0 0V64H64V0H0Z" fill="#088D8D"/>
<path d="M39 28.2222V34.8022H25V28.2222H39ZM25 15V49H17V15H25ZM47 15V49H39V15H47Z" fill="#088D8D"/>
</svg>
',
				'mode'            => 'edit',
				'keywords'        => array( 'Location', 'filter', 'Map' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-section-head.webp',
						),
					),
				),
				'enqueue_assets' => function(){
					wp_enqueue_script('jquery-ui-autocomplete');
					wp_enqueue_script('locations-scripts');
					wp_enqueue_script('googleapis');
				},
			)
		);

		// Register a block - Custom Tabs
		acf_register_block(
			array(
				'name'            => 'custom-tabs',
				'title'           => __( 'Custom Tabs', 'alrv_td' ),
				'description'     => __( 'A custom Tabs Block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0 0H64V28H0V0Z" fill="#088D8D"/>
										<path d="M0 36H16V64H0V36Z" fill="#088D8D"/>
										<path d="M24 36H40V64H24V36Z" fill="#088D8D"/>
										<path d="M48 36H64V64H48V36Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'jump', 'link' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
			)
		);

		// Register a block - Custom Quote block
		acf_register_block(
			array(
				'name'            => 'custom-quote',
				'title'           => __( 'Custom Quote', 'alrv_td' ),
				'description'     => __( 'A custom quote block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M30 19H14V35H21V45H26L30 34V19Z" fill="#088D8D"/>
										<path d="M50 19H34V35H41V45H46L50 34V19Z" fill="#088D8D"/>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M60 4H4V60H60V4ZM0 0V64H64V0H0Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'quote', 'testimonial', 'custom', 'custom-quote' ),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-custom-quote.webp',
						),
					),
				),
			)
		);

		// Register a block - Locations 
		acf_register_block(
			array(
				'name'            => 'locations',
				'title'           => __( 'Locations', 'alrv_td' ),
				'description'     => __( 'A custom locations selection block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 46L41 64L23 64L23 46L41 46Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M41 23L41 41L23 41L23 23L41 23Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M18 46L18 64L-8.39259e-07 64L0 46L18 46Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L46 41L46 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 23L64 41L63 41L63 23L64 23Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L46 64L46 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M64 46L64 64L63 64L63 46L64 46Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L-8.39259e-07 41L0 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										<path d="M18 23L18 41L17 41L17 23L18 23Z" fill="#088D8D"/>
										</svg>',
				'mode'            => 'edit',
				'keywords'        => array( 'Locations'),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-services.webp',
						),
					),
				),
			)
		);


		// Register a block - Providers Slider Hub PPC
		acf_register_block(
			array(
				'name'            => 'providers-slider-hub-ppc',
				'title'           => __( 'Providers Slider (HUB - PPC  Single Page)', 'alrv_td' ),
				'description'     => __( 'A custom providers selection block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => 'welcome-write-blog',
				'mode'            => 'edit',
				'keywords'        => array( 'Providers', 'Slider', 'Providers Hub', 'Providers Ppc'),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-providers.webp',
						),
					),
				),
			)
		);

		// Register a block - Closure List
		acf_register_block(
			array(
				'name'            => 'closure-summary',
				'title'           => __( 'Closure Summary', 'alrv_td' ),
				'description'     => __( 'A custom closure selection block.', 'alrv_td' ),
				'render_callback' => 'glide_acf_block_callback',
				'category'        => 'glide-blocks',
				'icon'            => 'welcome-write-blog',
				'mode'            => 'edit',
				'keywords'        => array( 'closure', 'summary', 'closure summary'),
				'align'           => 'wide',
				'supports'        => array(
					'align' => false,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/assets/img/admin/block-closure-list.webp',
						),
					),
				),
			)
		);


	}
}
