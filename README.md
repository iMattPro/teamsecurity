# phpBB Team Security Extension

This is the repository for the development of the Team Security extension for phpBB.

[![Build Status](https://github.com/phpbb-extensions/teamsecurity/actions/workflows/tests.yml/badge.svg)](https://github.com/phpbb-extensions/teamsecurity/actions)
[![codecov](https://codecov.io/gh/phpbb-extensions/teamsecurity/graph/badge.svg?token=giD7YLSzK0)](https://codecov.io/gh/phpbb-extensions/teamsecurity)

This extension adds passive security features to phpBB that allow the board's founder to watch for potential attacks against members of privileged groups, such as Administrators and Moderators.

- Log failed login attempts on accounts of members of selected groups.
- Require more complex passwords for members of selected groups.
- Email the details of each successful Admin Control Panel login.
- Email the details of any changes to user account email addresses.
- Disable deletion of logs and email the details of any delete attempts.
- Only board founders can manage this extension once it has been installed.

Note: This extension is currently under development and is not ready to install on any live forum.

## License
[GNU General Public License v2](https://opensource.org/licenses/GPL-2.0)
