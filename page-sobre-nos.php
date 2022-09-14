<?php
$estiloPagina = 'sobre_nos.css';
require_once('header.php');



if(have_posts()){//caso tenho algum conteúdo
    ?>
    <main class="main-sobre-nos"> 
        <?php
        while(have_posts()){
            the_post();//pegar um conteúdo salvo no painel administrativo muito importante
            the_post_thumbnail('post-thumbnail', array('class' => 'imagem-sobre-nos')); //imagem do post
            echo '<div class="conteudo container-alura">';
            the_title(before: '<h2>', after: '</h2>'); //titulo
            the_content();//conteúdo
            echo '</div">';
        }
    }
        ?>    
    </main>
<?php

require_once('footer.php');