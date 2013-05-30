<?php 
/*
 * @package Joomla 1.5
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @component Yandex Map Component
 * @copyright Copyright (C) Aleksandr Ermakov www.slyweb.ru
 */
defined('_JEXEC') or die('Restricted access'); 

?>
<form action="<?php echo JRoute::_('index.php?option=com_mapyandex&view=mapyandexmetki'); ?>" method="post" name="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_MAPYANDEX_SEARCH_IN_TITLE'); ?>" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
	</fieldset>
<div id="editcell">
    <table class="adminlist">
    <thead>
        <tr>
            <th width="5">
                <?php echo JText::_( 'COM_MAPYANDEX_ID' ); ?>
            </th>

            <th width="20">
              <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->foobar ); ?>);" />
            </th>
			<th width="200">
                <?php echo JText::_( 'COM_MAPYANDEX_NAMEMARKER' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'COM_MAPYANDEX_TEXTMAR' ); ?>
            </th>
						<th>
                <?php echo JText::_( 'COM_MAPYANDEX_WHERE' ); ?>
            </th>

			<th>
				<?php echo JText::_( 'COM_MAPYANDEX_ICONMARKER' ); ?>

            </th>
				<th>
                <?php echo JText::_( 'COM_MAPYANDEX_WHO' ); ?>
            </th>
            </th>
				<th>
                <?php echo JText::_( 'COM_MAPYANDEX_IMG' ); ?>
            </th>
			<th>
                <?php echo JText::_( 'COM_MAPYANDEX_TIME' ); ?>
            </th>

        </tr>            
    </thead>
    <?php

    $k = 0;
    for ($i=0, $n=count( $this->foobar ); $i < $n; $i++)
    {
        $row =& $this->foobar[$i];
        $checked    = JHTML::_( 'grid.id', $i, $row->id );
        $link = JRoute::_( 'index.php?option=com_mapyandex&view=mapyandexmetki&layout=formedit&id='. $row->id );
 
        ?>
        <tr class="<?php echo "row$k"; ?>">
		    <td>
                <?php echo $row->id; ?>
            </td>
            <td>
              <?php echo $checked; ?>
            </td>
			<td>
               <a href="<?php echo $link; ?>"><?php echo $row->name_marker; ?></a> 
            </td>
            <td>
                <a href="<?php echo $link; ?>"><?php echo (!empty($row->misil)) ? $row->misil : JText::_( 'COM_MAPYANDEX_NO_DESCRIPTION' ); ?></a>
            </td>

			<td style="text-align:center;">
				<a href="<?php echo 'index.php?option=com_mapyandex&view=map&layout=form&id='.$row->id_map;?>" target="_blank"><?php echo $row->id_map;?></a>
            </td>
						<td style="text-align:center;">
				<style type="text/css">
							/* Tooltips */
				.tool-tip {
				   float: left;
				   background: #ffc;
				   border: 1px solid #D4D5AA;
				   padding: 5px;
				   max-width: 200px;
				}
				 
				.tool-title {
				   padding: 0;
				   margin: 0;
				   font-size: 100%;
				   font-weight: bold;
				   margin-top: -15px;
				   padding-top: 15px;
				   padding-bottom: 5px;
				   background: url(../images/selector-arrow.png) no-repeat;
				}
				 
				.tool-text {
				   font-size: 100%;
				   margin: 0;
				}

				/* Tooltips */
				.tip-wrap{
					z-index: 10000;
				}
				.tip {
				   float: left;
				   background: #fff;
				   border: 1px solid #D4D5AA;
				   padding: 5px;
				   max-width: 200px;
				}
				 
				.tip-title {
				   padding: 0;
				   margin: 0;
				   font-size: 100%;
				   font-weight: bold;
				   margin-top: -15px;
				   padding-top: 15px;
				   padding-bottom: 5px;
				   background: url(<?php echo JURI::root(true).'/administrator/components/com_mapyandex/assets/images/tip-arrow.png';?>) no-repeat;
				}
				 
				.tip-text {
				   font-size: 100%;
				   margin: 0;
				}
				</style>
			<?php if($row->deficon !=='') {?>
                <?php 			
				echo JHTML::tooltip (JHTML::_('image', 'administrator/components/com_mapyandex/assets/images/deficon/'.$row->deficon.'.png','','style="margin-bottom: 3px;"'), $title = '', JURI::root(true).'/administrator/components/com_mapyandex/assets/images/icon-16-search.png', JHTML::_('image', '/administrator/components/com_mapyandex/assets/images/icon-16-search.png','','style="margin-bottom: 3px;"'), $href = '',  $alt = 'Такой будет ваша метка!',$class = 'hasTip'); 
				
				} 
				else { 
				echo JHTML::_('image', 'administrator/components/com_mapyandex/assets/images/deficon/whiteSmallPoint.png','','style="width:19px; height:20px; margin-bottom: 3px;"'); }?>
            </td>
			<td style="text-align:center;">
			<?php 	($row->whoadd == 0) ? $row->username = 'Это Вы!' : $row->username = $row->username; 

			if((int)$row->whoadd !==0) {
			if($row->username) { 
				$row->username = '('.$row->username.')';
			} else {
				$row->username = '';
			}
			?>
				<a href="<?php echo JURI::root(true).'/administrator/index.php?option=com_users&view=user&layout=edit&id='.$row->whoadd; ?>"><?php echo 'id - '.$row->whoadd.' '.$row->username; ?></a>
            <?php
			} else { 
				echo $row->username; ?></a>
			<?php
				}  
			?>
			</td>
			
			<td style="text-align:center;">

			<?php if($row->deficon !=='') {?>
                <?php 			
				$userimg = json_decode($row->userimg);
				$userpath = $this->params->get('userpathtoimg');
				
				if(empty($userpath)) {

					$userpath = '/images/mapyandex/yandexmarkerimg/';
				}
				
				if(strpos($userpath,'/') == 0) {
					$userpath = substr($userpath,1);
				
				}
				if($userimg) {
					if(is_file($_SERVER['DOCUMENT_ROOT'].JURI::root(true).'/'.$userpath.$userimg->smallfile)) {
					
						echo JHTML::_('image',$userpath.$userimg->smallfile,'','style="margin-bottom: 3px;"');
					} else {
						echo JHTML::_('image', 'administrator/components/com_mapyandex/assets/images/noimg.jpg','','style="margin-bottom: 3px;"');
					}
				} else {
						echo JHTML::_('image', 'administrator/components/com_mapyandex/assets/images/noimg.jpg','','style="margin-bottom: 3px;"');
					}
				} 
				else { 
					echo JHTML::_('image', 'administrator/components/com_mapyandex/assets/images/deficon/whiteSmallPoint.png','','style="width:19px; height:20px; margin-bottom: 3px;"'); 
				}?>
            </td>

			<td style="text-align:center;">

			<?php
			
				echo JHTML::_('date', $row->checked_out_time);
			
			?>
  
            </td>

        </tr>
        <?php
        $k = 1 - $k;
    }
    ?>
<tr>
	<td colspan="9"><?php echo $this->pageNav->getListFooter(); ?></td>
</tr>
    </table>

</div>

<input type="hidden" name="controller" value="mapyandexmetki" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>

