<?php /* Smarty version 2.6.26, created on 2010-07-22 00:36:19
         compiled from getone.tpl */ ?>
    <div class="Discussion">
    <br /><br /><br />
    <a href="/">&lt;-- Back to home</a><br /><br />
    <div style='color:<?php echo $this->_tpl_vars['shout']->color; ?>
'>
        <span class="bigStyleId">Shout #<?php echo $this->_tpl_vars['shout']->id; ?>
</span><br />
        On <?php echo $this->_tpl_vars['shout']->date; ?>
, <?php echo $this->_tpl_vars['shout']->name; ?>
 said: <br />
        <?php echo $this->_tpl_vars['shout']->body; ?>

    </div><br />