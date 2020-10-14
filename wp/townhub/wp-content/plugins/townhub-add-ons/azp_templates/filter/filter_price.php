<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $title = $icon = $width = '';
$rmax = $rmin = $rstep = $rfrom = $rto = '';
// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'filter_price',
    'azp-element-' . $azp_mID,
    'filter-gid-item', 
    'filter-gid-wid-' . $width,
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs); 
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot
// $azplgallerystyle = self::buildStyle($azp_attrs);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

$currency_attrs = townhub_addons_get_currency_attrs();
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <div class="filter-item-inner">
        <div class="price-rage-wrap fl-wrap">
        
            <?php
            if( $title != '' || $icon != '' ): ?>
            <div class="price-rage-wrap-title">
                <?php if( $icon != '' ): ?>
                <i class="ffield-icon ffield-icon-before <?php echo esc_attr($icon); ?>"></i>
                <?php endif;?>
                <?php echo $title; ?>
            </div>
            <?php endif;?>
            <div class="price-rage-item fl-wrap">
                <input class="price-slider" data-type="double" data-from="<?php echo floatval($rfrom) * $currency_attrs['rate']; ?>" data-to="<?php echo floatval($rto) * $currency_attrs['rate']; ?>" data-step="<?php echo floatval($rstep) * $currency_attrs['rate']; ?>" data-min="<?php echo floatval($rmin) * $currency_attrs['rate']; ?>" data-max="<?php echo floatval($rmax) * $currency_attrs['rate']; ?>" data-prefix="<?php echo $currency_attrs['symbol']; ?>" data-prettify-separator="<?php echo $currency_attrs['ths_sep']; ?>">
                <input type="hidden" name="fprice" id="price_range_hidden" value="">
            </div>
        </div>
    </div>
</div>
