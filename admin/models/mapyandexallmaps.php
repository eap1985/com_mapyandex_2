<?php
/*
 * @package Joomla 1.5
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @component Yandex Map Component
 * @copyright Copyright (C) Aleksandr Ermakov www.slyweb.ru
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modeladmin');
jimport('joomla.html.pagination');
jimport( 'joomla.application.component.modellist' );

class MapYandexModelMapYandexAllMaps extends JModelAdmin
{
protected	$option 		= 'com_mapyandex';

	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name', 'a.name_map_yandex',

			);
		}

		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
 
                //CHANGE THIS QUERY AS YOU NEED...
                $query->select('id As value, name_map_yandex As name');
		$query->from('#__map_yandex AS a');
		$query->order('a.name');

 
 
		// Filter
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			$query->where('(a.name LIKE '.$search.')');
		}
 
		return $query;
	}
 
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest('filter.search', 'filter_search');
		$this->setState('filter.search', $search);


		// List state information.
		parent::populateState('a.id', 'asc');
	}
	
	var $_foobar;

	public function getForm($data = array(), $loadData = true) {
		
		$app	= JFactory::getApplication();
		$form 	= $this->loadForm('com_mapyandex.mapyandexallmaps', 'map', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	/**
	 * 
	 * @���������� ������ ����� � ���� view.html.php
	 */
	function getFoobar()
	{

	// Create a new query object.
	$db		= JFactory::getDBO();
	$query	= $db->getQuery(true);
	//��������� �������� ��������� ����� � �����...
	$data['task'] = JRequest::getVar('task');
	if($data['task'] !== 'add') {
	$app = JFactory::getApplication(); 
	$limit = JRequest::getVar('limit',$app->getCfg('list_limit'));
	
	$limitstart = JRequest::getVar('limitstart', 0);
		
		$query->select('a.*');
		$query->from('`#__map_yandex` AS a');
		$search = $this->getState('filter.search');
		
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
	
			}
			else
			{
	
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('( a.name_map_yandex LIKE '.$search.')');
			}
		}
		$query->order('ID DESC');
		$query = $db->setQuery( $query, $limitstart, $limit );
		$this->_foobar = $db->loadObjectList();
		
	}
	else {
	
		$query = ' SELECT * '
			. ' FROM #__map_yandex ORDER BY ID DESC';
			$query = $db->setQuery( $query);
		$this->_foobar = $db->loadObjectList();
		}
		return $this->_foobar;
	}

	/**
	 * 
	 * @���������� ������ ����� � ���� view.html.php
	 */

	
	function getReviews()
	{
		global $option, $mainframe;
		$app = JFactory::getApplication(); 
		$limit = JRequest::getVar('limit',
		$app->getCfg('list_limit'));
		$limitstart = JRequest::getVar('limitstart', 0);
		$db = JFactory::getDBO();
		$query = "SELECT count(*) FROM #__map_yandex";
		$db->setQuery( $query );
		$total = $db->loadResult();
		$query = "SELECT * FROM #__map_yandex";
		$db->setQuery( $query, $limitstart, $limit );
		$rows = $db->loadObjectList();
		if ($db->getErrorNum()) {
			echo $db->stderr();
			return false;
		}

		return $this->pageNav = new JPagination($total, $limitstart, $limit);
		
	}
	
	
	function textnl($text)
	{
		$text = str_replace("\r\n","<br />",$text);
		$text = str_replace("\r","<br />",$text);
		$text = str_replace("\n\n", '<p>',$text);
		$text = str_replace("\n", '<br />',$text); 
		$text = addslashes($text);
		return $text;
	}
		
		
	function store($post)
	{	
		$row =& $this->getTable('map');
		
	
		
		$data = JRequest::get( 'post' );
		$data['misil'] = JRequest::getVar('misil', '', 'post', 'string', JREQUEST_ALLOWRAW);
		$data['misilonclick'] = JRequest::getVar('misilonclick', '', 'post', 'string', JREQUEST_ALLOWRAW);
		$data['text_map_yandex'] = JRequest::getVar('jform', '', 'post', 'string', JREQUEST_ALLOWRAW);
		// Bind the form fields to the hello table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the hello record is valid

		(trim($data['width_map_yandex']) !== '') ?  $data['width_map_yandex'] = $data['width_map_yandex'] : $data['width_map_yandex'] = 500;
		(trim($data['height_map_yandex']) !== '') ?  $data['height_map_yandex'] = $data['height_map_yandex'] : $data['height_map_yandex'] = 500;
		$date = date("Y-m-d H:i:s", time());
		$lng = json_encode(array('longitude_map_yandex' => $data['longitude_map_yandex'],'latitude_map_yandex'=>$data['latitude_map_yandex']));
		$el = json_encode($data['yandexel']);
		// Store the web link table to the database
			$db =& $this->getDBO();
			$query = "INSERT INTO ".$db->nameQuote('#__map_yandex') 
			." (`misil`,`misilonclick`,`name_map_yandex`,`defaultmap`, `id_map_yandex`, `city_map_yandex`, `street_map_yandex`, `checked_out`, `ordering`, `published`, `hits`, `catid`, `params`, `width_map_yandex`, `height_map_yandex`, `oblako_width_map_yandex`, `yandexbutton`, `color_map_yandex`, `bradius`, `yandexborder`,`yandexcoord`,`lng`,`yandexzoom`,`yandexel`,`text_map_yandex`,`checked_out_time`) VALUES 
			('".$this->textnl($data['misil'])."','".$this->textnl($data['misilonclick'])."','".$data['name_map_yandex']."','".$data['defaultmap']."','".$data['id_map_yandex']."', '".$data['city_map_yandex']."', '".$data['street_map_yandex']."', 0, 4, 1, 0, 1, '', '".$data['width_map_yandex']."', '".$data['height_map_yandex']."', '".$data['oblako_width_map_yandex']."', '".$data['yandexbutton']."', '".$data['color_map_yandex']."', '".$data['bradius']."', '".$data['yandexzoom']."','".$data['yandexcoord']."','$lng','".$data['yandexzoom']."','".$el."','".$this->textnl($data['text_map_yandex']['text_map_yandex'])."','".$date."')";
			
			$db->setQuery($query);
			
			if (!$db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			

		return true;
	}

	function delete(&$post)
	{

		$cids = $post['cid'];
		$db		=& JFactory::getDBO();
		if (count( $cids )) {
			foreach($cids as $cid) {
			$query = 'DELETE FROM #__map_yandex'
			. ' WHERE id = ' .$cid;
				$db->setQuery( $query );
				if (!$db->query()) {
					JError::raiseWarning( 500, $db->getError() );
				}
			}
		}
		return true;
	}

}


