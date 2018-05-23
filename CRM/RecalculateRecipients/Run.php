<?php
class CRM_RecalculateRecipients_Run{
  static function run(){

    $currentTime = date('YmdHis');
    $jobs = civicrm_api3('MailingJob', 'get', [
      'status' =>  'scheduled',
      'scheduled_date' => ['<=' => $currentTime],
      'option.limit' => 0
    ]);
    foreach($jobs['values'] as $job){
      $mailings[] = $job['mailing_id'];
    }
    $mailings = array_unique($mailings);
    foreach($mailings as $mailingId){
      CRM_Mailing_BAO_Mailing::getRecipients($mailingId);
    }
  }
}
