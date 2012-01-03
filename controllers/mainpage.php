<?php
// Get page variables
$pageNumber = $matches;

// Page Numbers
$shoutCount = count(Doctrine_Query::create()
    ->from('Shout s')
    ->orderBy('id Desc')
    ->execute());

$pages = Array();
for($i = 0; $i < $shoutCount/10; $i += 1) {
    if ($pageNumber == $i) {
        $pages[$i] = Array($i, True);
    }
    else {
        $pages[$i] = Array($i, False);
    }

}

if ($pageNumber == -1) {
    $pages[$i+1] = Array("faq", True);
}



// POST IF NEEDED

if ($_POST["body"] !== null && $_POST["body"] !== "" && $_POST["typeno"] == "") {
    $shout = new Shout();
    $shout['body'] = nl2br(
                     stripslashes(
                     htmlspecialchars(
                                $_POST["body"])));

    

    if ($_POST["name"] == "") {$_POST["name"] = "Anonymous Edward Lover";}
    $shout['name'] = stripslashes(htmlspecialchars($_POST["name"]));
    $shout['color'] = stripslashes(htmlspecialchars($_POST["color"]));
    $today = getdate();
    $today = $today['year'] . '-'. $today['mon'] . '-' . $today['mday'];
    $shout['date'] = $today;
    $shout->save();

}



// GET NEW SHOUTS
$shouts = Doctrine_Query::create()
    ->from('Shout s')
    ->orderBy('id Desc')
    ->offset($pageNumber*10)
    ->limit(10)
    ->execute();



// GET SHOUT SCOREBOARD

$monthlyshouts = Doctrine_Query::create()
    ->from('Shout s')
    ->orderBy('id Desc')
    ->where('s.date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)')
    ->execute();



//[person[date, date], person[date,date]]
if (count($monthlyshouts) > 0) {
    $PeopleShoutCount = array();
    
    foreach ($monthlyshouts as $shout) {
        $shoutname = $shout->name;
        $shoutname = str_replace (" ", "", $shoutname);
        $shoutname = strtolower($shoutname);
        if ($shoutname != "Anonymous Edward Lover") {
            if ($peopleShoutCount[$shoutname] == null){
                $peopleShoutCount[$shoutname] = array();
            }
            $peopleShoutCount[$shoutname][] = $shout->date;
        }
    }



    // Remove duplicate dates, count dates, sort and reverse.
    foreach ($peopleShoutCount as &$person) {
        $person = array_unique($person);
        $person = count($person);
    }
    
    asort($peopleShoutCount);
    $peopleShoutCount = array_reverse($peopleShoutCount, true);


}


$pageHeader = <<<HEREDOC

    <script type="text/javascript">

    function SwitchVisibility(obj) {

        var el = document.getElementById(obj);

        if ( el.style.display != "none" ) {

            el.style.display = 'none';

        }

        else {

            el.style.display = '';

        }

    }

    </script>



HEREDOC;



$smarty->assign('peopleShoutCount', $peopleShoutCount);

$smarty->assign('shouts', $shouts);

$smarty->assign('pages', $pages);

$smarty->assign('pageHeader', $pageHeader);

$smarty->assign('pageContent', $smarty->fetch('mainpage.tpl'));



$smarty->display('base.tpl');

?>