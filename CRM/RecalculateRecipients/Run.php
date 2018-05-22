<?php
class CRM_RecalculateRecipients_Run{
  static function run(){

    $currentTime = date('YmdHis');
    $jobs = civicrm_api3('MailingJob', 'get',
      [
        'status' =>  'scheduled',
        'scheduled_date' => ['<=' => $currentTime],
        'options' => ['limit' => 100],
      ]
    );
    foreach($jobs['values'] as $job){
      $mailings[] = $job['mailing_id'];
    }
    $mailings = array_unique($mailings);
    foreach($mailings as $mailing_id){
      $mailing = civicrm_api3('mailing', 'getsingle', ['id' => $mailing_id]);
      CRM_Mailing_BAO_Mailing::getRecipients($mailing['id'], $mailing['id'], TRUE, $mailing['dedupe_email'], NULL);
    }
  }
}
