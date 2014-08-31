<?php
/* 
* REFS TECNOLOGIA 
* Adicione aqui todos os tipos de posts customizados para o thema  
*/

add_action('init', 'post_types_adding');

function post_types_adding() {
  registrarTipo("Slides", "slider", 'gallery.png');   
  registrarTipo("bug-fix", "bug-fix", "gallery.png"); // por algum motivo se não colocar um item entre o 1º e 2º item o segundo não aparece
  registrarTipo("Servicos", "servicos", 'servicos.png');
  //registrarTipo("Imagens", "imagens_empresa", 'camera-icon.png');
  //registrarTipo("Clientes", "clientes", 'parceiros.png', array('thumbnail', 'title'));
  //registrarTipo("Depoimentos", "depoimentos", 'testimonials.png', array('editor')); 
  //registrarTipo("Perguntas", "question", 'cursos.png', array("title"));
}
?>