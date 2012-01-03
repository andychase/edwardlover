    <div class="scoreboard">
        <h4>Who loves Edward the most in the last 30 days?</h4>
{foreach from=$peopleShoutCount item=count key=person name=peopleShoutLoop}
{capture assign=personFontSize}{math equation="0.7+(1.65*c/10)+(1.65*(l-i)/10)" c=$count i=$smarty.foreach.peopleShoutLoop.iteration l=$peopleShoutCount|@count}{/capture}
{* base amount + (variable * number of posts / 10) + (variable * position in scoreboard(length - iterator) / 10) *}
        <span style="font-size:{$personFontSize}em">{$person}</span><br />
{/foreach}
	<span style="color:white;font-size:8pt;"><i>Note: shouting more than once per day will not effect your placement on the scoreboard</i></span>
    </div>



    <form action="/index" method="post">
        <div>
        <input type="button" id="AddButton" value="Say something!"
            onclick="SwitchVisibility('SetImage');
            SwitchVisibility('AddButton');" />
        </div>


        <div id="SetImage" style="display:none">
            Your name?<br />
            <input type="text" name="name" /> <input type="text" name="typeno" id="typeno" /> <br />
            What would you like to say (About EDWARD!!!): <br />
            <textarea name="body" class="inputfield" rows="2" cols="21"></textarea><br />
            What color would you use?: <br />

            <select name="color">
            {include file="colors.tpl"}
            </select><br />
            <input type="submit" value="Say it!" />
            <input type="button" value="Nevermind."
                   onclick="SwitchVisibility('SetImage');
                   SwitchVisibility('AddButton');" />
        </div>
    </form>
    <br />

    <div class="Discussion">
    {foreach from=$shouts item=shout}
        <div style='color:{$shout->color}'>
            {$shout->name} said: <br />
            {capture assign=shoutid}{$shout->id}{/capture}
            {$shout->body|truncate:400:"...<a href='./getone/$shoutid'>(more)</a>"}
            <br /> on {$shout->date}
        </div><br />
    {/foreach}
    </div>
    
    <div class="pages">
    Pages:
    {foreach from=$pages item=page}
        {if $page[1] == True} <span>{$page[0]}</span>
        {else} <a href='./{$page[0]}'>{$page[0]}</a>
        {/if}
    {/foreach}
    <!-- <span>faq</span> -->
    <a href='./about'>faq</a>
    <a href='rss.xml'>rss</a>
    </div>