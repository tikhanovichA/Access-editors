<?php
/**

 */
$action= $modx->newObject('modAction');
$action->fromArray(array(
    'id' => 1,
    'namespace' => 'Access',
    'parent' => 0,
    'controller' => 'index',
    'haslayout' => 1,
    'lang_topics' => 'access:default',
    'assets' => '',
),'',true,true);

/* load action into menu */
$menu= $modx->newObject('modMenu');
$menu->fromArray(array(
    'text' => 'Access',
    'parent' => 'components',
    'description' => 'ac.menu_desc',
    'icon' => '',
    'menuindex' => 0,
    'params' => '',
    'handler' => '',
),'',true,true);
$menu->addOne($action);
unset($action);

return $menu;