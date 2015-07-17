<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Fzh-members
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'FzhMembers'      => 'system/modules/fzh-members/FzhMembers.php',
	// Models
	'FzhMembersModel' => 'system/modules/fzh-members/models/FzhMembersModel.php',
));
