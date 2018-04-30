<?php

require_once 'contactsource.civix.php';
use CRM_Contactsource_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function contactsource_civicrm_config(&$config) {
  _contactsource_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function contactsource_civicrm_xmlMenu(&$files) {
  _contactsource_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function contactsource_civicrm_install() {
  _contactsource_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function contactsource_civicrm_postInstall() {
  _contactsource_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function contactsource_civicrm_uninstall() {
  _contactsource_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function contactsource_civicrm_enable() {
  _contactsource_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function contactsource_civicrm_disable() {
  _contactsource_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function contactsource_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _contactsource_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function contactsource_civicrm_managed(&$entities) {
  _contactsource_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function contactsource_civicrm_caseTypes(&$caseTypes) {
  _contactsource_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function contactsource_civicrm_angularModules(&$angularModules) {
  _contactsource_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function contactsource_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _contactsource_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function contactsource_civicrm_entityTypes(&$entityTypes) {
  _contactsource_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_post()
 *
 * Updates a custom field contact_source to show who added the contact
 *
 * @param $op
 * @param $objectName
 * @param $objectId
 * @param $objectRef
 *
 * @throws \CiviCRM_API3_Exception
 */
function contactsource_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  if (($op !== 'create') || ($objectName !== 'Individual')) {
    return;
  }

  // Contact create
  $params = array('id' => $objectRef->id, 'loggedInContactId' => CRM_Core_Session::getLoggedInContactID());
  contactsource_updatecontactaddedby($params);
}

/**
 * Update the contact record with the "Added By" contact ID
 * @param $params
 *
 * @throws \CiviCRM_API3_Exception
 */
function contactsource_updatecontactaddedby($params) {
  if (empty($params['id']) || empty($params['loggedInContactId'])) {
    return;
  }
  $customField = CRM_Contactsource_Utils::getCustomByName('Contact_Added_By');
  $contactParams = array(
    'id' => $params['id'],
    $customField => $params['loggedInContactId'],
  );
  civicrm_api3('Contact', 'create', $contactParams);
}

