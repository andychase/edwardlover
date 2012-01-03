<?php
require_once('glue.php');

require_once('./doctrine/config.php');
Doctrine::loadModels('models');

require_once('./smarty/Smarty.class.php');
$smarty = new Smarty();
$smarty->compile_dir  = './smarty/templates_c/';
$smarty->config_dir   = './smarty/configs/';
$smarty->cache_dir    = './smarty/cache/';

$urls = array(
    '/' => 'index',
    '/(\d+)' => 'index',
    '/index.php/?\?p\=(\d+)' => 'index',
    
    '/getone/(\d+)' => 'getone',
    '/getone.php/?\?id=(\d+)' => 'getone',
    
    '/about(\.php)?' => 'about',
    '/rss(\.xml|\.php)?' => 'rss'
);

class index {
    function GET($matches) {
        global $smarty;
        $matches = $matches[1];
        require('./controllers/mainpage.php');
    }
    function POST() {
        GET(None);
    }
}

class getone {
    function GET($matches) {
        global $smarty;
        $matches = $matches[1];
        require('./controllers/getone.php');
    }
}

class about {
    function GET() {
        global $smarty;
        $pageNumber = -1;
        $smarty->assign('pageContent', $smarty->fetch('about.tpl'));
        $smarty->display('base.tpl');
    }
}

class rss {
    function GET() {
        global $smarty;
        require('./controllers/rss.php');
    }
}

try {
    glue::stick($urls);
}
catch (Exception $e) {
    $index = new Index();
    $index->GET(None);
}
?>