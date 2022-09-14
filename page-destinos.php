<?php
$estiloPagina = 'destinos.css';
require_once 'header.php';

?>
<!-- Seção de pesquisa de posts -->
<form action="#" class="container-alura formulario-pesquisa-paises">
    <h2>Conheça Nossos Destinos</h2>
    <select name="paises" id="paises">
        <option value="">--Selecione--</option>
        <?php
            $paises = get_terms(array('taxonomy' => 'paises')); //pegando os termos com a taxonomia paises criada no functions.php
            foreach($paises as $pais){?>
                <option value="<?= $pais->name?>"
                <?= !empty($_GET['paises']) && $_GET['paises'] === $pais->name ? 'selected' : '' ?>><?= $pais->name?></option>
            <?php }
        ?>
    </select>
    <input type="submit" value="Pesquisar">
</form>
<!-- Termina a seção de pesquisa de posts -->
<?php


if(!empty($_GET['paises'])){ //se o filtro de paises nao for vazio 
    $paisSelecionado = array(array(
        'taxonomy' => 'paises',
        'field' => 'name',
        'terms' => $_GET['paises'] //get o resultado da url paises
    ));
    
}

$args = array(
    'post_type' => 'destinos',
    'tax_query' => !empty($_GET['paises']) ? $paisSelecionado : '' //se o usuário filtrou o país, senao query vazia retorna todos paises
    ); //busca todas as cidades cadastradas no post customizado destinos
    
$query = new WP_Query($args);
if($query -> have_posts()){
    echo '<main class="page-destinos">';
    echo '<ul class="lista-destinos container-alura">';
    while($query -> have_posts()){
        echo '<li class="col-md-3 destinos">';
        $query -> the_post();
        the_post_thumbnail();
        the_title(before: '<p class = "titulo-destino">', after: '</p>');
        the_content();
        echo '</li>';
    }
    echo '</ul>';
    echo '</main>';
}
        ?>
    </main>
<?php
require_once 'footer.php';