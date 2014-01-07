<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package    MetaModels
 * @subpackage Core
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace MetaModels\DcGeneral\Events\Table\InputScreen;

use DcGeneral\Contao\BackendBindings;
use DcGeneral\Contao\View\Contao2BackendView\Event\ManipulateWidgetEvent;

/**
 * Retrieve the wizard for the panel picker.
 *
 * @package MetaModels\DcGeneral\Events\Table\InputScreen
 */
class PropertyPanelLayout
{
	/**
	 * Calculate the wizard.
	 *
	 * @param ManipulateWidgetEvent $event The event.
	 *
	 * @return void
	 */
	public static function getWizard(ManipulateWidgetEvent $event)
	{
		if (version_compare(VERSION, '3.0', '<'))
		{
			$link = ' <a href="system/modules/metamodels/popup.php?tbl=%1$s&fld=%2$s&inputName=ctrl_%3$s&id=%4$s&item=PALETTE_PANEL_PICKER" rel="lightbox[files 765 60%%]" data-lightbox="files 765 60%%">%5$s</a>';
		}
		else
		{
			$link = ' <a href="system/modules/metamodels/popup.php?tbl=%1$s&fld=%2$s&inputName=ctrl_%3$s&id=%4$s&item=PALETTE_PANEL_PICKER" onclick="Backend.getScrollOffset();Backend.openModalIframe({\'width\':765,\'title\':\'%6$s\',\'url\':this.href,\'id\':\'%4$s\'});return false">%5$s</a>';
		}

		$event->getWidget()->wizard = sprintf(
			$link,
			$event->getEnvironment()->getDataDefinition()->getName(),
			$event->getProperty()->getName(),
			$event->getProperty()->getName(),
			$event->getModel()->getId(),
			BackendBindings::generateImage(
				'system/modules/metamodels/html/panel_layout.png',
				$event->getEnvironment()->getTranslator()->translate('panelpicker', 'tl_metamodel_dca'),
				'style="vertical-align:top;"'
			),
			addslashes($event->getEnvironment()->getTranslator()->translate('panelpicker', 'tl_metamodel_dca'))
		);
	}
}