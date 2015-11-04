<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Load default language file
 */
System::loadLanguageFile('tl_files');


/**
 * Overwrite some settings
 */
if (Input::get('do') == 'members')
{
	$rootFolder = new Folder('fzh-members-documents');
	$rootFolder->protect();

	$folder = new Folder('fzh-members-documents/'.Input::get('id'));

	Config::set('uploadPath', $folder->path);

	//Config::set('editableFiles', Config::get('templateFiles'));
}


/**
 * Template editor
 */
$GLOBALS['TL_DCA']['tl_fzh_documents'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Folder',
		'validFileTypes'              => 'pdf',
		//'closed'                      => true,
		'notDeletable'				  => true,
		/*'onload_callback' => array
		(
			array('tl_templates', 'addBreadcrumb'),
		)*/
	),
	'label' => array
	(
		'label_callback'          => array('tl_fzh_documents', 'documentLabel')
	),

	// List
	'list' => array
	(
		
		'operations' => array
		(
			'download' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_files']['download'],
				'href'                => 'key=downloadDocument',
				'icon'                => 'system/modules/fzh-members/assets/page_white_put.png'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default' => 'name'
	),

	// Fields
	'fields' => array
	(
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_files']['name'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>32, 'spaceToUnderscore'=>true)
		)
	)
);


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class tl_fzh_documents extends Backend
{

	/**
	 * Add the breadcrumb menu
	 *
	 * @throws RuntimeException
	 */
	public function addBreadcrumb()
	{
		// Set a new node
		if (isset($_GET['node']))
		{
			// Check the path (thanks to Arnaud Buchoux)
			if (Validator::isInsecurePath(Input::get('node', true)))
			{
				throw new RuntimeException('Insecure path ' . Input::get('node', true));
			}

			$this->Session->set('tl_templates_node', Input::get('node', true));
			$this->redirect(preg_replace('/(&|\?)node=[^&]*/', '', Environment::get('request')));
		}

		$strNode = $this->Session->get('tl_templates_node');

		if ($strNode == '')
		{
			return;
		}

		// Check the path (thanks to Arnaud Buchoux)
		if (Validator::isInsecurePath($strNode))
		{
			throw new RuntimeException('Insecure path ' . $strNode);
		}

		// Currently selected folder does not exist
		if (!is_dir(TL_ROOT . '/' . $strNode))
		{
			$this->Session->set('tl_templates_node', '');

			return;
		}

		$strPath = 'templates';
		$arrNodes = explode('/', preg_replace('/^templates\//', '', $strNode));
		$arrLinks = array();

		// Add root link
		$arrLinks[] = '<img src="' . TL_FILES_URL . 'system/themes/' . Backend::getTheme() . '/images/filemounts.gif" width="18" height="18" alt=""> <a href="' . $this->addToUrl('node=') . '" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['selectAllNodes']).'">' . $GLOBALS['TL_LANG']['MSC']['filterAll'] . '</a>';

		// Generate breadcrumb trail
		foreach ($arrNodes as $strFolder)
		{
			$strPath .= '/' . $strFolder;

			// No link for the active folder
			if ($strFolder == basename($strNode))
			{
				$arrLinks[] = '<img src="' . TL_FILES_URL . 'system/themes/' . Backend::getTheme() . '/images/folderC.gif" width="18" height="18" alt=""> ' . $strFolder;
			}
			else
			{
				$arrLinks[] = '<img src="' . TL_FILES_URL . 'system/themes/' . Backend::getTheme() . '/images/folderC.gif" width="18" height="18" alt=""> <a href="' . $this->addToUrl('node='.$strPath) . '" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['selectNode']).'">' . $strFolder . '</a>';
			}
		}

		// Limit tree
		$GLOBALS['TL_DCA']['tl_templates']['list']['sorting']['root'] = array($strNode);

		// Insert breadcrumb menu
		$GLOBALS['TL_DCA']['tl_templates']['list']['sorting']['breadcrumb'] .= '

<ul id="tl_breadcrumb">
  <li>' . implode(' &gt; </li><li>', $arrLinks) . '</li>
</ul>';
	}


	public function documentLabel($row, $label, DataContainer $dc, $args){
		print_r($args);
	}
}
