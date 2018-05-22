<?php
class CRM_RecalculateRecipients_Run{
  static function run(){

    $currentTime = date('YmdHis');
    try {
      $jobs = civicrm_api3('MailingJob', 'get', ['status' => 'scheduled', 'scheduled_date' => ['<=' => $currentTime]]);
    }
    catch (CiviCRM_API3_Exception $ex) {
      CRM_Core_Error::debug_log_message('Couldn\'t retrieve list of mailings.',
        false, 'civicrm-relculate-recipients');
    }
    foreach($jobs['values'] as $job){
      $mailings[] = $job['mailing_id'];
    }
    $mailings = array_unique($mailings);
    foreach($mailings as $mailing_id){
      try{
        $mailing = civicrm_api3('mailing', 'getsingle', ['id' => $mailing_id]);
        CRM_Mailing_BAO_Mailing::getRecipients($mailing['id'], $mailing['id'], TRUE, $mailing['dedupe_email'], NULL);
      }
      catch (CiviCRM_API3_Exception $ex) {
        // TODO ts
        CRM_Core_Error::debug_log_message(
          ts('Couldn\'t retrieve mailing id: %1', array(1 => $mailing_id))
          , false, 'civicrm-relculate-recipients');
      }
    }
  }
}
