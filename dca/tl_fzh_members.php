<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   fzh
 * @author    Samuel Heer
 * @license   GNU/LGPL
 * @copyright Samuel Heer 2014
 */


/**
 * Table tl_fzh_members
 */
$GLOBALS['TL_DCA']['tl_fzh_members'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'onsubmit_callback' 		  => array(
			array('tl_fzh_members','checkMemberState')	
			),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('surname'),
			'flag'                    => 1,
			'panelLayout'			  => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('surname','name'),
			'showColumns'			  => true
		),

		'global_operations' => array
		(
			'export' => array(
				'label'					=>&$GLOBALS['TL_LANG']['tl_fzh_members']['export'],
				'href'                => 'key=export',
				'class'               => 'header_xls_export',
				'attributes'          => 'onclick="Backend.getScrollOffset()"',
				),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fzh_members']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			/*'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fzh_members']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),*/
			/*'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fzh_members']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),*/
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fzh_members']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Select
	'select' => array
	(
		'buttons_callback' => array()
	),

	// Edit
	'edit' => array
	(
		'buttons_callback' => array()
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('directDebitingSystem'),
		'default'                     => '{personal_legend},name,surname,birthday,gender;{address_legend},street,zip,city,country,addressNotAvailable;{contact_legend},mail,newsletter,phone;{accountData_legend},directDebitingSystem;{administration_legend},entrySource,joiningDate,exitDate,memberState,exitReason,ransomed;'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'directDebitingSystem'			=> 'accountHolder,bank,iban,swift'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['name'],
			'exclude'                 => true,
			'sorting' 				  => true,
			'search'				  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'alpha','mandatory' => true, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"

		),
		'surname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['surname'],
			'exclude'                 => true,
			'sorting' 				  => true,
			'search'				  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'alpha', 'mandatory' => true, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'street' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['street'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'alphanumeric', 'mandatory' => true, 'maxlength'=>255,'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'zip' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['zip'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'digit', 'mandatory' => true, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(5) NOT NULL default ''"
		),
		'city' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['city'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'alpha', 'mandatory' => true, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'country' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['country'],
			'exclude'                 => true,
			'sorting'				  => true,
			'inputType'               => 'select',
			'options'				  => array('D','CH','A','F'),
			'eval'                    => array('rgxp' => 'alpha', 'mandatory' => true, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'addressNotAvailable' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['addressNotAvailable'],
			'default'				  => false,
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'					  => array('mandatory' => false, 'tl_class' => 'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'birthday' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['birthday'],
			'exclude'                 => true,
			'sorting' 				  => true,
			'inputType'               => 'text',
			'flag'                    => 6,
			'eval'                    => array('datepicker' => true, 'rgxp' => 'date', 'mandatory' => false, 'tl_class' => 'w50 wizard clr'),
			'sql'                     => "varchar(11) NOT NULL default ''"
		),
		'gender' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['gender'],
			'exclude'                 => true,
			'sorting' 				  => true,
			'filter'				  => true,
			'inputType'               => 'select',
			'options'				  => array('male', 'female'),
			'reference'				  => &$GLOBALS['TL_LANG']['tl_fzh_members']['gender'],
			'eval'                    => array('mandatory' => true, 'tl_class' => 'w50', 'includeBlankOption' => true,),
			'sql'                     => "varchar(31) NOT NULL default ''"
		),
		'mail' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['mail'],
			'exclude'                 => true,
			'search'				  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'email', 'mandatory' => false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'newsletter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['newsletter'],
			'default'				  => false,
			'exclude'                 => true,
			'filter'				  => true,
			'inputType'               => 'checkbox',
			'eval'					  => array('mandatory' => false, 'tl_class' => 'w50 m12'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'phone' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['phone'],
			'exclude'                 => true,
			'sorting' 				  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'phone', 'mandatory' => false, 'tl_class' => 'w50'),
			'sql'                     => "varchar(11) NOT NULL default ''"
		),
		'directDebitingSystem' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['directDebitingSystem'],
			'exclude'                 => true,
			'filter'				  => true,
			'inputType'               => 'checkbox',
			'eval'					  => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'accountHolder' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['accountHolder'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'alnum', 'mandatory' => false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'bank' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['bank'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'alnum', 'mandatory' => false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'iban' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['iban'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'alnum', 'mandatory' => false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'swift' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['swift'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'alnum', 'mandatory' => false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'joiningDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['joiningDate'],
			'exclude'                 => true,
			'sorting' 				  => true,
			'flag'                    => 6,
			'inputType'               => 'text',
			'eval'                    => array('datepicker' => true, 'rgxp' => 'date', 'mandatory' => false, 'tl_class' => 'w50 wizard'),
			'sql'                     => "varchar(11) NOT NULL default ''"
		),
		'exitDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['exitDate'],
			'exclude'                 => true,
			'sorting' 				  => true,
			'flag'                    => 6,
			'inputType'               => 'text',
			'eval'                    => array('datepicker' => true, 'rgxp' => 'date', 'mandatory' => false, 'tl_class' => 'w50 wizard'),
			'sql'                     => "varchar(11) NOT NULL default ''"
		),
		'exitReason' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['exitReason'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'memberState' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['memberState'],
			'default'				  => true,
			'exclude'                 => true,
			'filter'				  => true,
			'inputType'               => 'checkbox',
			'eval'					  => array('mandatory' => false, 'tl_class' => 'w50', 'disabled'=> true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'ransomed' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['ransomed'],
			'default'				  => false,
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'					  => array('mandatory' => false, 'tl_class' => 'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'entrySource' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fzh_members']['entrySource'],
			'exclude'                 => true,
			'sorting'				  => true,
			'inputType'               => 'select',
			'options'				  => array('website','altbestand'),
			'reference'				  => &$GLOBALS['TL_LANG']['tl_fzh_members']['entrySource'],
			'eval'                    => array('rgxp' => 'alpha', 'mandatory' => true, 'maxlength'=>255 ),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
	)
);

class tl_fzh_members extends Backend
{

	public function checkMemberState(DataContainer $dc){
		// Return if there is no active record (override all)
		if (!$dc->activeRecord)
		{
			return;
		}
	
		$activeModel = \FzhMembersModel::findByPk($dc->activeRecord->id);
		if(($dc->activeRecord->exitDate && $dc->activeRecord->exitDate < time()) || $dc->activeRecord->addressNotAvailable == 1){
			$activeModel->memberState = '';
		}
		else{
			$activeModel->memberState = 1;
		}
		$activeModel->save();
		
	}

}
