<?php
/**
 * Template Name: Template Shop
 */
get_header('shop'); ?>
<!-- Section BreadCrumb -->
<div class="content-box shop effect8  clearfix">
<?php if($architect_option['bread-switch']==true){ ?>
<section class="no-padding-tb">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <ol class="breadcrumb breadcrumb-arc-2">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </ol>         
          </div>
      </div> 
   </div>
</section>
<?php } ?><!--  End Section -->

<Section class="no-padding-top">
    <div class="container">
        <div class="row">                    
            <div class="col-md-12">                   
                <?php while (have_posts()) : the_post()?>                                                                
                    <?php the_content(); ?>
                <?php endwhile; ?>                
            </div>                       
        </div>
    </div>
</Section>
</div>
<?php get_footer('shop'); ?>