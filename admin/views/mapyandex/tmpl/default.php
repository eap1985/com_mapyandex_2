<?php defined('_JEXEC') or die('Restricted access');?>

<form action="index.php" method="post" name="adminForm">
<div class="adminform">
<div class="cpanel-left">
	<div id="cpanel">
		<?php
		$link = 'index.php?option=com_mapyandex';
		echo $this->MapYandexRenderAdmin->quickIconButton( $link, 'icon-48-mapyandex.png', JText::_('COM_MAPYANDEX_HOME_PAGE') );
		
		$link = 'index.php?option=com_mapyandex&view=mapyandexallmaps';
		echo $this->MapYandexRenderAdmin->quickIconButton( $link, 'icon-48-mapyandexall.png', JText::_('COM_MAPYANDEX_ALLMAPS') );
		
		$link = 'index.php?option=com_mapyandex&view=mapyandexallmaps&layout=form';
		echo $this->MapYandexRenderAdmin->quickIconButton( $link, 'sample-48.png', JText::_( 'COM_MAPYANDEX_YANDEXNEWMAP' ) );
		$link = 'index.php?option=com_mapyandex&view=mapyandexmetki';
		echo $this->MapYandexRenderAdmin->quickIconButton( $link, 'icon-48-mapyandexe.png', JText::_( 'COM_MAPYANDEX_NEWYMAR' ) );
		
		$link = 'index.php?option=com_mapyandex&view=mapyandexcalculator';
		echo $this->MapYandexRenderAdmin->quickIconButton( $link, 'mapcalculator-48.png', JText::_( 'COM_MAPYANDEX_CALCULATOR' ) );

		$link = 'index.php?option=com_mapyandex&view=mapyandexregion';
		echo $this->MapYandexRenderAdmin->quickIconButton( $link, 'regions-48.png', JText::_( 'COM_MAPYANDEX_REGIONS' ) );

		$link = 'index.php?option=com_mapyandex&view=mapyandexroute';
		echo $this->MapYandexRenderAdmin->quickIconButton( $link, 'routes-48.png', JText::_( 'COM_MAPYANDEX_ROUTES' ) );
		
		$link = 'index.php?option=com_mapyandex&view=mapyandexdoc';
		echo $this->MapYandexRenderAdmin->quickIconButton( $link, 'icon-48-mapyandexdoc.png', JText::_( 'COM_MAPYANDEX_DOC' ) );
		?>
				
		<div style="clear:both">&nbsp;</div>
		<p>&nbsp;</p>

	</div>
</div>
		
<div class="cpanel-right">
	<div style="border:1px solid #ccc;background:#fff;margin:15px;padding:15px">
		<div style="float:right;margin:10px;">
			<?php echo JHTML::_('image', 'administrator/components/com_mapyandex/assets/images/logo-slyweb.png', 'slyweb.ru' );?>
		</div>
			
		<?php

		echo '<h3>'.  JText::_('COM_MAPYANDEX_VERSION').'</h3>'
		.'<p>'.  $this->tmpl['version'] .'</p>';

		echo '<h3>'.  JText::_('COM_MAPYANDEX_YM_VERSION').'</h3>'
		.'<p>2.0.10</p>';

		echo '<h3>'.  JText::_('COM_MAPYANDEX_COPYRIGHT').'</h3>'
		.'<p>© 2012 - '.  date("Y"). ' Aleksandr Ermakov</p>'
		.'<p><a href="http://www.slyweb.ru/" target="_blank">www.slyweb.ru</a></p>';

		echo '<h3>'.  JText::_('COM_MAPYANDEX_LICENCE').'</h3>'
		.'<p><a href="http://www.gnu.org/licenses/gpl-2.0.html" target="_blank">GPLv2</a></p>';
		
	
		?>

		
		<p>Yandex™, Yandex Maps™, are registered trademarks of Yandex Inc.</p>
		
		<?php
		echo '<div style="border-top:1px solid #c2c2c2"></div>'
.'<div id="pg-update"><a href="http://www.slyweb.ru/yandexmap/version/index.php?version='.  $this->tmpl['version'] .'" target="_blank">'.  JText::_('COM_MAPYANDEX_CHECK_FOR_UPDATE') .'</a></div>';
		?>
		
	</div>
</div>

</div>

<input type="hidden" name="option" value="com_mapyandex" />
<input type="hidden" name="view" value="mapyandexcp" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>