# Recalculate recipients

CiviCRM calculates the recipients for a mailing based on the contacts that are in your include/exclude groups/mailings at the time that you hit the submit button.

This means that any contacts that are added or removed to your groups in the time between when you hit the submit button and the date it is scheduled to go out will not receive your mailing.

This extension causes the recipients of a mailing to be recalculated just before the mail is sent out meaning you'll be sending based on the most up to data.

## Health warning: this extension is not ACL friendly

You should probably not use this extension if you are relying on ACLs to limit the contacts to which CiviMail users can send. As it stands as the CiviMail author's ACLs are not taken into account when the recipients are recalculated (see [issue #1](https://github.com/3sd/civicrm-recalculate-recipients/issues/1) for more details).

## Contributions and improvements

Contributions to this repository are very welcome. You can also contact the maintainer (michaelmcandrew@thirdsectordesign.org) for further development work.
