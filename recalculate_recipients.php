<?php

require_once 'recalculate_recipients.civix.php';
use CRM_recalculate_recipients_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function recalculate_recipients_civicrm_config(&$config) {
  _recalculate_recipients_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function recalculate_recipients_civicrm_install() {
  _recalculate_recipients_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function recalculate_recipients_civicrm_enable() {
  _recalculate_recipients_civix_civicrm_enable();
}

function recalculate_recipients_civicrm_apiWrappers(&$wrappers, $apiRequest) {
  //&apiWrappers is an array of wrappers, you can add your(s) with the hook.
  // You can use the apiRequest to decide if you want to add the wrapper (eg. only wrap api.Contact.create)
  if ($apiRequest['entity'] == 'Job' && $apiRequest['action'] == 'process_mailing') {
    $wrappers[] = new CRM_RecalculateRecipients_Wrapper();
  }
}
