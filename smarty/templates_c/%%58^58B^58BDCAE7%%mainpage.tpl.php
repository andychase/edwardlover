<?php /* Smarty version 2.6.26, created on 2010-07-21 23:25:31
         compiled from mainpage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'mainpage.tpl', 4, false),array('modifier', 'count', 'mainpage.tpl', 4, false),array('modifier', 'truncate', 'mainpage.tpl', 44, false),)), $this); ?>
    <div class="scoreboard">
        <h4>Who loves Edward the most in the last 30 days?</h4>
<?php $_from = $this->_tpl_vars['peopleShoutCount']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['peopleShoutLoop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['peopleShoutLoop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['person'] => $this->_tpl_vars['count']):
        $this->_foreach['peopleShoutLoop']['iteration']++;
?>
<?php ob_start(); ?><?php echo smarty_function_math(array('equation' => "0.7+(1.65*c/10)+(1.65*(l-i)/10)",'c' => $this->_tpl_vars['count'],'i' => $this->_foreach['peopleShoutLoop']['iteration'],'l' => count($this->_tpl_vars['peopleShoutCount'])), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('personFontSize', ob_get_contents());ob_end_clean(); ?>
        <span style="font-size:<?php echo $this->_tpl_vars['personFontSize']; ?>
em"><?php echo $this->_tpl_vars['person']; ?>
</span><br />
<?php endforeach; endif; unset($_from); ?>
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
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "colors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </select><br />
            <input type="submit" value="Say it!" />
            <input type="button" value="Nevermind."
                   onclick="SwitchVisibility('SetImage');
                   SwitchVisibility('AddButton');" />
        </div>
    </form>
    <br />

    <div class="Discussion">
    <?php $_from = $this->_tpl_vars['shouts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shout']):
?>
        <div style='color:<?php echo $this->_tpl_vars['shout']->color; ?>
'>
            <?php echo $this->_tpl_vars['shout']->name; ?>
 said: <br />
            <?php ob_start(); ?><?php echo $this->_tpl_vars['shout']->id; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('shoutid', ob_get_contents());ob_end_clean(); ?>
            <?php echo ((is_array($_tmp=$this->_tpl_vars['shout']->body)) ? $this->_run_mod_handler('truncate', true, $_tmp, 400, "...<a href='./getone/".($this->_tpl_vars['shoutid'])."'>(more)</a>") : smarty_modifier_truncate($_tmp, 400, "...<a href='./getone/".($this->_tpl_vars['shoutid'])."'>(more)</a>")); ?>

            <br /> on <?php echo $this->_tpl_vars['shout']->date; ?>

        </div><br />
    <?php endforeach; endif; unset($_from); ?>
    </div>
    
    <div class="pages">
    Pages:
    <?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
        <?php if ($this->_tpl_vars['page'][1] == True): ?> <span><?php echo $this->_tpl_vars['page'][0]; ?>
</span>
        <?php else: ?> <a href='./<?php echo $this->_tpl_vars['page'][0]; ?>
'><?php echo $this->_tpl_vars['page'][0]; ?>
</a>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <!-- <span>faq</span> -->
    <a href='./about'>faq</a>
    <a href='rss.xml'>rss</a>
    </div>