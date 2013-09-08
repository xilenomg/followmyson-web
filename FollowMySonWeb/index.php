<?php
require_once("_config/_config.php");

$user = new User();

# obrigatorio em todas as paginas
$config['title'] = "Location";
$pagina['config'] = $config;

$pageInfo['name'] = 'index';
$pagina['page'] = $pageInfo;

#renderizando
$h2o = new h2o('_templates/web/index.html');
echo $h2o->render($pagina);

?>