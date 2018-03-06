# Recalculate recipients

CiviCRM calculates the recipients for a mailing based on the contacts that are in your include/exclude groups/mailings at the time that you hit the submit button.

This means that any contacts that are added or removed to your groups in the time between when you hit the submit button and the date it is scheduled to go out will not receive your mailing.

This extension causes the recipients of a mailing to be recalculated just before the mail is sent out meaning you'll be sending based on the most up to data.

## Health warning: this extension is not ACL friendly

You should probably not use this extension if you are relying on ACLs to limit the contacts to which CiviMail users can send. As it stands as the CiviMail author's ACLs are not taken into account when the recipients are recalculated (see [issue #1](https://github.com/3sd/civicrm-recalculate-recipients/issues/1) for more details).

## Requirements

## Installation

## Getting started

## Documentation

## Developers

### Tests

## Credits

This extension has been developed by [Michael McAndrew](https://twitter.com/michaelmcandrew) from [Third Sector Design](https://thirdsectordesign.org/) who you can [contact](https://thirdsectordesign.org/contact) for help, support and further development.

## Contributing

Contributions to this repository are very welcome. Feel free to submit a pull request for minor improvements. For larger changes, please create an issue first.

## License

This extension is licensed under [AGPL-3.0](LICENSE.txt).
