# uk.co.mjwconsult.contactsource

![Screenshot](/images/screenshot.png)

This extension adds an "Added By" field to the contact record and automatically fills it with the logged in Contact ID when a new contact is created.
This allows an organisation to search/track contacts by who added them.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v5.4+
* CiviCRM 4.7

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl uk.co.mjwconsult.contactsource@https://github.com/mattwire/uk.co.mjwconsult.contactsource/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/mattwire/uk.co.mjwconsult.contactsource.git
cv en contactsource
```

## Usage

Just enable the extension in the usual way.  There is no configuration.

## Known Issues

None.
