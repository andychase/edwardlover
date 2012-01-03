<?php
$shoutNumber = $matches;
$pageNumber = -2;

// GET NUMBERED SHOUT
$shouts = Doctrine_Query::create()
    ->from('Shout s')
    ->where('s.id = ' . $shoutNumber)
    ->execute();

$smarty->assign('shout', $shouts[0]);
$smarty->assign('pageContent', $smarty->fetch('getone.tpl'));
$smarty->display('base.tpl');
?>