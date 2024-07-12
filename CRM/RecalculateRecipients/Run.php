<?php
class CRM_RecalculateRecipients_Run{
  static function run(){

    // If ACLs have been configured and we re-calculate the recipients via a cron
    // job, we run the risk of sending to contacts that the original email author
    // should not have access to. So, check if ACLs are configured for this site
    // and skip if they are.
    $aclCount = \Civi\Api4\ACLEntityRole::get()
      ->setLimit(1)
      ->execute()->count();

    if ($aclCount > 0) {
      return;
    }

    $mailings = $jobs = [];
    $currentTime = date('YmdHis');
    try {
      $jobs = civicrm_api3('MailingJob', 'get', [
        'status' =>  'scheduled',
        'scheduled_date' => ['<=' => $currentTime],
        'option.limit' => 0
      ]);
    }
    catch (CiviCRM_API3_Exception $e) {
      CRM_Core_Error::debug_log_message("Couldn\'t retrieve list of mailings.", false, 'civicrm-relculate-recipients');
    }
    foreach($jobs['values'] as $job){
      $mailings[] = $job['mailing_id'];
    }
    $mailings = array_unique($mailings);
    foreach($mailings as $mailingId){
      try{
        CRM_Mailing_BAO_Mailing::getRecipients($mailingId);
      }
      catch (CiviCRM_API3_Exception $e) {
        CRM_Core_Error::debug_log_message("Couldn't retrieve mailing id: {$mailingId}", false, 'civicrm-relculate-recipients');
      }
    }
  }
}
