<?php
$estiloPagina = 'home.css';
require_once 'header.php';

$args = array(
    'post_type' => 'banners',
    'post_status' => 'publish', //status publicado
    'posts_per_page' => 1 //limitando a um post por pagina
);

$query = new WP_Query($args);
if($query -> have_posts()){
    while($query ->have_posts()){
        $query -> the_post();
        ?>
        <main>
            <div class="imagem-banner">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="texto-banner-dinamico">
                <span id="texto-banner"></span>
            </div>
        </main>
        <?php
    }
}



require_once 'footer.php';
?>