<?php

// GET NEW SHOUTS
$shouts = Doctrine_Query::create()
    ->from('Shout s')
    ->orderBy('id Desc')
    ->limit(12)
    ->execute();


// CONDITIONAL GET
$lastModifiedTimestamp = strtotime($shouts[0]->date);
function doConditionalGet($timestamp) {
    // From http://simonwillison.net/2003/Apr/23/conditionalGet/
    // A PHP implementation of conditional get, see 
    //   http://fishbowl.pastiche.org/archives/001132.html
    $last_modified = substr(date('r', $timestamp), 0, -5).'GMT';
    $etag = '"'.md5($last_modified).'"';
    // Send the headers
    header("Last-Modified: $last_modified");
    header("ETag: $etag");
    // See if the client has provided the required headers
    $if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ?
        stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) :
        false;
    $if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ?
        stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) : 
        false;
    if (!$if_modified_since && !$if_none_match) {
        return;
    }
    // At least one of the headers is there - check them
    if ($if_none_match && $if_none_match != $etag) {
        return; // etag is there but doesn't match
    }
    if ($if_modified_since && $if_modified_since != $last_modified) {
        return; // if-modified-since is there but doesn't match
    }
    // Nothing has changed since their last request - serve a 304 and exit
    header('HTTP/1.0 304 Not Modified');
    exit;
}
doConditionalGet($lastModifiedTimestamp);

$lastchanged = date("D, d M Y H:i:s T", $lastModifiedTimestamp);

$smarty->assign('lastchanged', $lastchanged);
$smarty->assign('shouts', $shouts);

header("Content-Type: application/rss+xml");
$smarty->display('rss.tpl');
?>