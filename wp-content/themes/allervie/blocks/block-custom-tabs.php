<?php
/**
 * Block Name: Tabs
 *
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package Allervie
 * @since 1.0.0
 */

// Get all the fields from ACF for this block ID
// $block_fields = get_fields( $block['id'] );
$block_fields = get_fields_escaped( $block['id'] );
// $block_fields = get_fields_escaped( $block['id'] ,'sanitize_text_field' ); // if want to remove all html

// Set the block name for it's ID & class from it's file name
$block_glide_name = $block['name'];
$block_glide_name = str_replace( 'acf/', '', $block_glide_name );

// Set the preview thumbnail for this block for gutenberg editor view.
if ( isset( $block['data']['preview_image_help'] ) ) {    /* rendering in inserter preview  */
	echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
}

// create align class ("alignwide") from block setting ("wide").
$align_class = $block['align'] ? 'align' . $block['align'] : '';

// Get the class name for the block to be used for it.
$class_name = ( isset( $block['className'] ) ) ? $block['className'] : null;

// Making the unique ID for the block.
$id = 'block-' . $block_glide_name . '-' . $block['id'];
	
// Making the unique ID for the block.
if ( $block['name'] ) {
	$block_name = $block['name'];
	$block_name = str_replace( '/', '-', $block_name );
	$name       = 'block-' . $block_name;
}

//Block Variables 
$alrv_blk_tabs = (isset($block_fields['alrv_blk_tabs'])) ? $block_fields['alrv_blk_tabs'] : null;
$alrv_blk_tab_title = (isset($block_fields['alrv_blk_tab_title'])) ? $block_fields['alrv_blk_tab_title'] : null;
?>

<section id="custom-tabs" class="custom-tabs-block<?php echo $id; ?>">
    <div id="<?php echo $id; ?>" class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?> page-section ">
        <div class="tab-block">
            <?php if (!empty($alrv_blk_tab_title)) { ?>
                <div class="section-head center-align">
                    <h2><?php echo $alrv_blk_tab_title; ?></h2>
                </div>
            <?php } ?>
            <div id="content">
                <div class="tabContainer">
                    <ul class="tabs">
                        <?php $tab_index = 1; ?>
                        <?php $active_condition = $id .'1'; ?>
                        <?php foreach ($alrv_blk_tabs as $tab): ?>
                            <?php $alrv_blk_tab_class =  $tab['alrv_blk_tab_class']; ?>
                            <li><a src="tab<?php echo $tab_index; ?><?php echo $id; ?>" href="javascript:void(0);" class="<?php echo ($tab_index == $active_condition) ? 'active' : ''; ?> <?php echo $alrv_blk_tab_class; ?>"><?php echo $tab['alrv_blk_tab_title']; ?><?php echo ($tab['alrv_blk_new_badge'][0]=='new') ? '<span>New</span>' : ''; 	?></a></li>
                            <?php $tab_index++; ?>
                        <?php endforeach; ?>
                    </ul>
                    <div class="line"></div>
                    <div class="tabContent">
                        <?php $content_index = 1; ?>
                        <?php foreach ($alrv_blk_tabs as $tab):
                        $alrv_blk_tab_headline =  $tab['alrv_blk_tab_headline']; 
                        $alrv_blk_tab_class =  $tab['alrv_blk_tab_class']; 
                        $alrv_blk_tab_description = $tab['alrv_blk_tab_description'];
                        $alrv_blk_content_type =  $tab['alrv_blk_content_type']; 
                        $alrv_blk_tab_content =  html_entity_decode($tab['alrv_blk_tab_content']); 
                        $alrv_blk_tab_form =  $tab['alrv_blk_tab_form']; 
                        $alrv_blk_tab_button =   $tab['alrv_blk_tab_button']; 
                        ?>
                            <div id="tab<?php echo $content_index; ?><?php echo $id; ?>" class="<?php echo $alrv_blk_tab_class; ?> tab_content_item<?php echo $content_index; ?>" style="display: <?php echo ($content_index === 1) ? 'block' : 'none'; ?>;">
                                <?php if(!empty($alrv_blk_tab_headline) || !empty($alrv_blk_tab_description)) { ?>
                                    <div class="title-row">
                                        <?php if(!empty($alrv_blk_tab_headline)) { ?>
                                            <h5><?php echo $alrv_blk_tab_headline; ?></h5>
                                        <?php } ?>
                                        <?php if(!empty($alrv_blk_tab_description)) { ?>
                                            <p><?php echo $alrv_blk_tab_description; ?></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <?php if($alrv_blk_content_type == 'form') { 
                                    if($alrv_blk_tab_form){
                                        echo do_shortcode( '[gravityform id="' . $alrv_blk_tab_form . '" title=false description=false ajax=true]' );
                                    }
                                } 
                                else { 
                                    if(!empty($alrv_blk_tab_content)) { ?>
                                        <div class="content-row">
                                            <?php echo html_entity_decode($alrv_blk_tab_content) ; ?>
                                        </div>
                                    <?php }                             
                                } ?>
                                <?php if(!empty($alrv_blk_tab_button)) { ?>
                                    <div class="button-row">
                                        <?php echo glide_acf_button( $alrv_blk_tab_button, 'button large-btn' ); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php $content_index++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    jQuery('.custom-tabs-block<?php echo $id; ?> .tabs li a').click(function(e) {
        e.preventDefault();
        var tabId = jQuery(this).attr('src');
        jQuery('.custom-tabs-block<?php echo $id; ?> .tabs li a').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.custom-tabs-block<?php echo $id; ?> .tabContent > div').hide();
        jQuery('#' + tabId).show();
    });

    //Scroll to Make an Appointment form on click of submi a request button
    jQuery('.submit-request').on('click', function(e) {
        var makeAppointmentTab = jQuery('.make-an-appointment').closest('div[id^="tab"]').attr('id');

        // Activate the tab
        jQuery('.tabs a').removeClass('active');
        jQuery('.tabs a[href="#' + makeAppointmentTab + '"]').addClass('active');
        
        // Show the tab content
        jQuery('.tabContent > div').hide();
        jQuery('#' + makeAppointmentTab).show();

    });

    //Scroll to Book an Appointment
    jQuery('.book-online').on('click', function(e) {
        var bookOnlineTab = jQuery('.book-online-tab').closest('div[id^="tab"]').attr('id');

        // Activate the tab
        jQuery('.tabs a').removeClass('active');
        jQuery('.tabs a[href="#' + bookOnlineTab + '"]').addClass('active');
        
        // Show the tab content
        jQuery('.tabContent > div').hide();
        jQuery('#' + bookOnlineTab).show();

    });

</script>