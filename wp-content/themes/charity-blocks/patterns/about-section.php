<?php
/**
 * Title: About Section
 * Slug: charity-blocks/about-section
 * Categories: charity-blocks, about-section
 */
?>

<!-- wp:group {"className":"about-sec wow fadeInUp","style":{"typography":{"fontSize":"14px"},"spacing":{"padding":{"right":"0px","left":"0px"}}},"backgroundColor":"second-bg","layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group about-sec wow fadeInUp has-second-bg-background-color has-background" style="padding-right:0px;padding-left:0px;font-size:14px"><!-- wp:spacer {"height":"24px"} -->
<div style="height:24px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"28px","fontStyle":"normal","fontWeight":"700","lineHeight":"1.1","textTransform":"capitalize"}}} -->
<h3 class="wp-block-heading has-text-align-center" style="font-size:28px;font-style:normal;font-weight:700;line-height:1.1;text-transform:capitalize"><?php esc_html_e('About Us','charity-blocks'); ?></h3>
<!-- /wp:heading -->

<!-- wp:separator {"className":"is-style-default","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}},"gradient":"ternary-to-primary"} -->
<hr class="wp-block-separator has-alpha-channel-opacity has-ternary-to-primary-gradient-background has-background is-style-default" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--20)"/>
<!-- /wp:separator -->

<!-- wp:separator {"className":"is-style-default-2","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"gradient":"ternary-to-primary"} -->
<hr class="wp-block-separator has-alpha-channel-opacity has-ternary-to-primary-gradient-background has-background is-style-default-2" style="margin-top:0;margin-bottom:0"/>
<!-- /wp:separator -->

<!-- wp:columns {"verticalAlignment":"center","className":"about-cols"} -->
<div class="wp-block-columns are-vertically-aligned-center about-cols"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"className":"about-img-box-inner","style":{"spacing":{"padding":{"right":"50px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group about-img-box-inner" style="padding-right:50px"><!-- wp:image {"id":19,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"10px","width":"1px"}},"borderColor":"secondary"} -->
<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/cause1.png'); ?>" alt="" class="has-border-color has-secondary-border-color wp-image-19" style="border-width:1px;border-radius:10px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"abt-exp-box","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"10px","width":"1px"}},"backgroundColor":"primary","borderColor":"secondary","layout":{"type":"default"}} -->
<div class="wp-block-group abt-exp-box has-border-color has-secondary-border-color has-primary-background-color has-background" style="border-width:1px;border-radius:10px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color has-link-color" style="margin-top:0;margin-bottom:0;font-size:24px;font-style:normal;font-weight:600"><?php esc_html_e('15 +','charity-blocks'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color has-link-color" style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:500"><?php esc_html_e('years of','charity-blocks'); ?><br><?php esc_html_e('experience','charity-blocks'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"about-text-box"} -->
<div class="wp-block-column is-vertically-aligned-center about-text-box"><!-- wp:paragraph {"align":"right","style":{"typography":{"fontSize":"16px"}}} -->
<p class="has-text-align-right" style="font-size:16px"><?php esc_html_e('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable escontent of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters','charity-blocks'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"right","style":{"typography":{"fontSize":"16px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<p class="has-text-align-right" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0;font-size:16px"><?php esc_html_e('The point of using Lorem Ipsumis that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable escontent of a page when looking.','charity-blocks'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"right","style":{"typography":{"fontSize":"16px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<p class="has-text-align-right" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0;font-size:16px"><?php esc_html_e('The point of using Lorem Ipsumis that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable escontent of a page when looking.','charity-blocks'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"right","style":{"typography":{"fontSize":"16px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<p class="has-text-align-right" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0;font-size:16px"><?php esc_html_e('The point of using Lorem Ipsumis that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable escontent of a page when looking.','charity-blocks'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer {"height":"24px"} -->
<div style="height:24px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group -->