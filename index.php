<?php
$context = Timber::context();
$args = array(
              'post_type'       => 'post',
              'orderby'         => 'ID',
              'post_status'     => 'publish',
              'order'           => 'DESC',
              'posts_per_page'  => 6,
              'paged'           => -1
            );

$context['posts'] = new Timber\PostQuery($args);
$templates        = array( 'index.twig' );
Timber::render( $templates, $context );
?>
