<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="widget widget-text-heading <?php echo esc_attr($el_class).' '.esc_attr($style); ?>">
    <?php if ( trim($title)!='' ) { ?>
        <h3 class="title">
            <?php echo trim( $title ); ?>
        </h3>
    <?php } ?>
    <?php if ( trim($descript)!='' ) { ?>
        <div class="description">
            <?php echo trim( $descript ); ?>
        </div>
    <?php } ?>
</div>