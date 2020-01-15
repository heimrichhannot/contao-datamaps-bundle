<?php
/**
 * Contao Open Source CMS
 * 
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 * @package datamaps
 * @author Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\DataMapsBundle\ContentElement;


use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\System;
use HeimrichHannot\Datamaps\DataMapConfig;
use HeimrichHannot\Datamaps\DataMapsModel;

class DatamapElement extends ContentElement
{
	protected $strTemplate = 'ce_datamap';

	protected $objConfig;

	public function generate()
	{
        $this->objConfig = DataMapsModel::findByPk($this->datamap);
        if ($this->objConfig === null) return '';

		if (System::getContainer()->get('huh.utils.container')->isBackend())
		{
		    $template = new BackendTemplate('be_wildcard');
		    $template->title = $this->headline;

		    $template->wildcard = $GLOBALS['TL_LANG']['tl_datamaps_elements']['references']['CONFIG'] ?: 'Configuration'.': '.$this->objConfig->title;
			return $template->parse();
		}

		return parent::generate();
	}

	protected function compile()
	{
		DataMapConfig::createConfigJs($this->objConfig); // $this is needed for reference (replaceinserttags)
		$this->Template->datamapCssID = DataMapConfig::getCssIDFromModel($this->objConfig);
		$this->Template->datamapCssClass = DataMapConfig::getCSSClassFromModel($this->objConfig);
	}
}