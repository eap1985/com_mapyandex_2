<?php 
/*
 * @package Joomla 1.5
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @component Yandex Map Component
 * @copyright Copyright (C) Aleksandr Ermakov www.slyweb.ru
 */
defined('_JEXEC') or die('Restricted access'); ?>
<form action="<?php JRoute::_('index.php?option=com_mapyandex'); ?>" method="post" name="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_MAPYANDEX_SEARCH_IN_TITLE'); ?>" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
	</fieldset>
<div id="editcell">
    <table class="adminlist centercolumn">
    <thead>
        <tr>
            <th width="5">
                <?php echo JText::_( 'COM_MAPYANDEX_ID' ); ?>
            </th>

            <th width="20">
              <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->allroute ); ?>);" />
            </th>
			<th width="200">
                <?php echo JText::_( 'COM_MAPYANDEX_NAMEMAP' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'COM_MAPYANDEX_TARIF' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'COM_MAPYANDEX_TARIF_SETTINGS' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'COM_MAPYANDEX_ADDRESS' ); ?>
            </th>
			<th>
                <?php echo JText::_( 'COM_MAPYANDEX_HITS' ); ?>
            </th>
			<th>
                <?php echo JText::_( 'COM_MAPYANDEX_YMCODE' ); ?>
            </th>
        </tr>            
    </thead>
    <?php
    $k = 0;

    for ($i=0, $n=count( $this->allroute ); $i < $n; $i++)
    {
        $row =& $this->allroute[$i];
        $checked    = JHTML::_( 'grid.id', $i, $row->id );
        $link = JRoute::_( 'index.php?option=com_mapyandex&view=mapyandexcalculator&layout=formedit&id='. $row->id );
		$map_calculator_settings = json_decode($row->map_calculator_settings);
		switch ($map_calculator_settings[3]) { 
		case 1:
			$currency = 'рублей';
			break;
		case 2:
			$currency = 'евро';
			break;
		case 3:
			$currency = 'долларов';
			break;
		case 4:
			$currency = 'гривен';
			break;
		}
		
        ?>
        <tr class="<?php echo "row$k"; ?>">
		    <td>
                <?php echo $row->id; ?>
            </td>

            <td>
              <?php echo $checked; ?>
            </td>
			 <td>
               <a href="<?php echo $link; ?>"><?php echo $row->name_map_yandex; ?></a> 
            </td>
            <td>
                <a href="<?php echo $link; ?>"><?php  echo $map_calculator_settings[0].' '.$currency; ?></a>
            </td>
			<td>
                <a href="<?php echo $link; ?>"><?php  echo 'Минимальня стоимость - '.$map_calculator_settings[1].' '.$currency; ?></a>
            </td>
			<td>
                <a href="<?php echo $link; ?>"><?php  echo $row->full_address_map_yandex; ?></a>
            </td>
			<td>
                <?php echo $row->hits; ?>
            </td>
			<td>
                <?php echo '{mapyandex_calculator_id='.$row->id.'}' ?>
            </td>
        </tr>
        <?php
        $k = 1 - $k;
    }
    ?>
<tr>
	<td colspan="8"><?php echo $this->pageNav->getListFooter(); ?></td>
</tr>
    </table>

</div>
 
<input type="hidden" name="option" value="com_mapyandex" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="mapyandexcalculator" />

<?php echo JHtml::_('form.token'); ?>
</form>

