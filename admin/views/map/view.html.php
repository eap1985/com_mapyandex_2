<?php
/*
 * @package Joomla 1.5
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @component Yandex Map Component
 * @copyright Copyright (C) Aleksandr Ermakov www.slyweb.ru
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * Hello View
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class MapYandexViewMap extends JView
{

	protected $state;
	protected $item;
	protected $form;
	protected $tmpl;

	function untextnl($text)
	{
		$text = str_replace("<br />","\r\n",$text);
		return $text;
	}
	
	function display($tpl = null)
	{
		//get the hello
		$foobar		= $this->get('Foobar');
		$isNew		= ($foobar->id < 1);

		$this->form		= $this->get('Form');
		
		$tmpl = array();
		$this->params = JComponentHelper::getParams( 'com_mapyandex' );
		JHtml::stylesheet( 'administrator/components/com_mapyandex/assets/mapyandex.css' );
		// prepare the cSS
			$css = '.icon-48-mapyandexe {
				background: url("'.JURI::root(true).'/media/com_mapyandex/colorpicker/images/icon-48-mapyandexe.png") 0 0 no-repeat;
			}';
			
			// add the CSS to the document
		$doc = JFactory::getDocument();
		$doc->addStyleDeclaration($css);


		JToolBarHelper::title(   JText::_( 'COM_MAPYANDEX_NAMECOMPONENT' ), 'mapyandexe' );
		JToolBarHelper::apply('map.apply', 'JTOOLBAR_APPLY');
		JToolBarHelper::save('map.save', 'JTOOLBAR_SAVE');
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->foobar = $this->get('Foobar');


		$this->assignRef( 'tmpl', $tmpl );
		
		$this->metka = $this->get('Metka');
		
		
		parent::display($tpl);
	}
	
	
		
	function addRouteToMap($route)
	{
		$textarray = '';
		$textarrayonput = '';
		$cr = count($route);
		if($route) {
			$i = -1;
			$length = count($route)-1;
			foreach($route as $val) {
			$i++;
						$textarray  .= '\''.$val.'\',';
						
						  if($i == 0) {
							$textbefore = 'Начало пути';
						  } else if($i == $length) {
							$textbefore = 'Конец пути';
						  }	
						  else {
							$textbefore = 'Пункт '.$i;
						  }
						  
						  $textarrayonput  .= '<li class="ui-state-default"><div width="100" align="left" class="key"><label for="foobar">'.$textbefore.'</label></div><div width="100" align="left"><input type="text" name="name_route_yandex[]" class="newroute" size="100" value="'.$val.'" /></div><div class="imgdeleteroute" rel="'.$i.'">'.JHTML::_( 'image', 'administrator/components/com_mapyandex/assets/images/iconfalse.png', JText::_( 'COM_MAPYANDEX_DELETE_ROUTE_ITEM' )).'</div><div>'.JHTML::_( 'image', 'administrator/components/com_mapyandex/assets/images/icon-loading2.gif', JText::_( 'COM_MAPYANDEX_DELETE_ROUTE_ITEM' ),array('class'=>'imgyandexmaploader')).'</div><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></li>';
							

			}
						if($textarray != '') {
							$textarray = substr($textarray, 0, -1);
						}
($this->foobar->map_centering) ? $map_centering = 'true' : $map_centering = 'false'; 
 
			$ymaproute = 'ymaps.route([
							'.$textarray.'
						], {
							// Опции маршрутизатора
		
						}).then(function (route) {
							map.geoObjects.add(route);
							
							   var points = route.getWayPoints();  
							// Задаем стиль метки - иконки будут красного цвета, и
							// их изображения будут растягиваться под контент
			
							points.options.set(\'preset\', \'twirl#redStretchyIcon\');
							route.options.set({ strokeColor: \''.$this->foobar->color_map_route.'\', opacity: '.$this->foobar->map_route_opacity.' });
							points.get(0).properties.set(\'iconContent\', \'Точка отправления\');
							for(i = 0; i <='.($length).';i++) {
								if(i == '.($length).') {		
									points.get('.($length).').properties.set(\'iconContent\', \'Точка прибытия\');
								}
							}
						}, function (error) {
							alert("Возникла ошибка: " + error.message);
						});';
		} else {
			$ymaproute = '';
		}

		return $ymaproute;
	}
}