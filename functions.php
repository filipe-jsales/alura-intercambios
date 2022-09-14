<?php

function alura_intercambios_registrar_taxonomia(){
    register_taxonomy(
        'paises',//taxonomia chamada de paises
        'destinos', //vinculando ao post customizado Destinos
        array(
            'labels' => array('name' => 'Países'), //nome na barra lateral esquerda
            'hierarchical' => true
        )
    );
}

add_action('init', 'alura_intercambios_registrar_taxonomia');

function alura_intercambios_registrar_post_customizado(){
    register_post_type('destinos',
        array(
            'labels' => array('name' => 'Destinos'), //nome do post customizado
            'public' => true, //visivel aos administradores
            'menu_position' => 0, //posição na barra lateral esquerda
            'supports' => array('title', 'editor', 'thumbnail'), //display title content and image
            'menu_icon' => 'dashicons-admin-site' //add icon 
        )
    );
}
add_action('init', 'alura_intercambios_registrar_post_customizado');

function alura_intercambios_adicionar_recursos_ao_tema(){
    add_theme_support(feature: 'custom-logo'); //adiciona logo customizada ao tema
    add_theme_support(feature: 'post-thumbnails');//adiciona imagem ao post
}
//action hook after_setup_theme ao começar a inicializar os códigos dos temas
add_action('after_setup_theme', 'alura_intercambios_adicionar_recursos_ao_tema');

function alura_intercambios_registrar_menu(){//função para chamar o menu
    register_nav_menu(//função para habilitar o menu
        location: 'menu-navegacao',
        description: 'Menu de navegação'
    );
}
//action hook init ao inicializar
add_action('init', 'alura_intercambios_registrar_menu');

function alura_intercambios_adicionar_post_customizado_banner(){
    register_post_type('banners',
    array(
        'labels' => array('name' => 'Banner'), //nome do post customizado
        'public' => true, //visivel aos administradores
        'menu_position' => 1, //posição na barra lateral esquerda
        'supports' => array('title', 'thumbnail'), //display title content and image
        'menu_icon' => 'dashicons-format-image' //add icon 
        )
    );
}

add_action('init', 'alura_intercambios_adicionar_post_customizado_banner');

function alura_intercambios_adicionar_registrar_metabox(){
    add_meta_box(
        id: 'ai_registrando_metabox',
        title: 'Texto para a home',
        callback: 'ai_funcao_callback',
        screen: 'banners'
    );
}

add_action('add_meta_boxes', 'alura_intercambios_adicionar_registrar_metabox');

function ai_funcao_callback($post){

    $texto_home_1 = get_post_meta($post->ID, '_texto_home_1', true);
    $texto_home_2 = get_post_meta($post->ID, '_texto_home_2', true);
    ?>
    <label for="texto_home_1">Texto 1</label>
    <input type="text" name="texto_home_1" value="<?= $texto_home_1?>" style="width: 100%;"/>
    <br>
    <br>
    <label for="texto_home_2">Texto 2</label>
    <input type="text" name="texto_home_2" value="<?= $texto_home_2 ?>" style="width: 100%;"/>
    
    <?php
}

function alura_intercambios_salvar_dados_metabox($post_id){
    foreach($_POST as $key=>$value){
        if($key !== 'texto_home_1' && $key !== 'texto_home_2'){ //caso os dados nao sejam o do metabox o wordpress irá tratar
            continue;
        }

        update_post_meta(
            $post_id,
            '_' . $key,
            $_POST[$key]
        );
    }
}
add_action('save_post', 'alura_intercambios_salvar_dados_metabox');

function alura_intercambios_adicionar_scripts(){
    if(is_front_page()){
        wp_enqueue_script('typed-js', get_template_directory_uri() . '/js/typed.min.js', array(), false, true);
        wp_enqueue_script('texto-banner-js', get_template_directory_uri() . '/js/texto-banner.js', array('typed-js'), false, true);
    }
}

add_action('wp_enqueue_scripts', 'alura_intercambios_adicionar_scripts');