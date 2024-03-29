<?php
/*
 * @package Joomla 1.5
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @component Yandex Map Component
 * @copyright Copyright (C) Aleksandr Ermakov www.slyweb.ru
 */
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view' );

class MapYandexViewMapYandexAjax extends JView
{
	function display($tpl = null) {
		global $mainframe;
		$tmpl		= array();
		$css = '.icon-48-mapyandexdoc {
				background: url(\'../media/com_mapyandex/colorpicker/images/icon-48-mapyandexdoc.png\') 0 0 no-repeat;
		}';
		$doc =& JFactory::getDocument();
		$doc->addStyleDeclaration($css);
		JToolBarHelper::title(   JText::_( 'INSTRUCTION' ), 'mapyandexdoc' );
		
		$params = &JComponentHelper::getParams( 'com_mapyandex' );
				
		

		$this->assignRef( 'tmpl', $tmpl );
		
		// interrogate the model
		$foobar =& $this->get('Foobar');
	
		$this->assignRef('foobar', $foobar);
		
		parent::display($tpl);
	}
}
?>
