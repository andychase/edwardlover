<?php /* Smarty version 2.6.26, created on 2010-07-22 02:03:32
         compiled from rss.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'rss.tpl', 19, false),array('modifier', 'strip_tags', 'rss.tpl', 19, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version="1.0"<?php echo '?>'; ?>

            <rss version="2.0">
                <channel>
                    <title>EdwardLover</title>
                    <link>http://edwardlover.com/rss.php</link>
                    <description>An Edward Cullen shoutboard -- How much do you love Edward?</description>
                    <language>en-us</language>
                    <pubDate><?php echo $this->_tpl_vars['lastchanged']; ?>
</pubDate>
                    <lastBuildDate><?php echo $this->_tpl_vars['lastchanged']; ?>
</lastBuildDate>
                    <docs>http://cyber.law.harvard.edu/rss/rss.html</docs>
<?php $_from = $this->_tpl_vars['shouts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shout']):
?>
                    <item>
                    <title><?php echo $this->_tpl_vars['shout']->name; ?>
</title>
                    <link>http://edwardlover.com/getone/<?php echo $this->_tpl_vars['shout']->id; ?>
</link>
                    <guid>http://edwardlover.com/getone/<?php echo $this->_tpl_vars['shout']->id; ?>
</guid>
                    <color><?php echo $this->_tpl_vars['shout']->color; ?>
</color>
                    <description><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['shout']->body)) ? $this->_run_mod_handler('truncate', true, $_tmp, 140, "...") : smarty_modifier_truncate($_tmp, 140, "...")))) ? $this->_run_mod_handler('strip_tags', true, $_tmp, false) : smarty_modifier_strip_tags($_tmp, false)); ?>
</description>
                    </item>
<?php endforeach; endif; unset($_from); ?>
                    </channel>
            </rss>