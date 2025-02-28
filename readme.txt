=== Under Construction Access ===
Contributors: chriswhite  
Donate link: https://hchad.com  
Tags: under construction, maintenance mode, site lock, password protection  
Requires at least: 5.0  
Tested up to: 6.4  
Requires PHP: 7.2  
Stable tag: 1.1  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

A simple plugin that blocks access to your WordPress site and requires a password to view pages, with customizable settings for headings and developer credits.

== Description ==

**Under Construction Access** allows you to put your WordPress site in an "under construction" mode, requiring visitors to enter a password before viewing content. Logged-in users and `/wp-admin/` remain accessible at all times.

### Features:
- **Password Protection** – Set a password to restrict site access.
- **Customizable Heading** – Change the H1 heading text displayed on the under-construction page.
- **Developer Credits** – Optionally display a developer credit section, including:
  - Developer icon (image URL).
  - Developer credit text (e.g., "Web Design by Bookieman").
  - Developer URL (clickable link to developer site).
- **Admin Settings Page** – Manage all settings under **Tools > Under Construction**.
- **Admin Access** – WordPress admin panel (`/wp-admin/`) remains accessible whether logged in or out.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/under-construction-access` directory, or install via the WordPress Plugin Directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Go to **Tools > Under Construction** to configure settings.
4. Set your desired password and heading text.
5. (Optional) Add developer credits with an icon, text, and link.

== Frequently Asked Questions ==

= Can I still access the WordPress dashboard while the site is locked? =  
Yes, `/wp-admin/` and logged-in users remain unaffected.

= What happens if I forget the password? =  
Go to **Tools > Under Construction** in the WordPress admin panel to reset the password.

= Is this plugin compatible with all themes? =  
Yes, this plugin works independently of themes.

== Screenshots ==

1. **Frontend Password Prompt** – Visitors must enter a password to view the site.
2. **Admin Settings Page** – Configure password, heading, and developer credits.

== Changelog ==

= 1.1 =
- Added settings page under **Tools**.
- Customizable heading text.
- Developer credit section with icon, text, and URL.

= 1.0 =
- Initial release with password protection.

== Upgrade Notice ==

= 1.1 =  
Adds new customization options. Update to access the settings page.

== Support ==

For support or feature requests, visit [hchad.com](https://hchad.com).

== License ==

This plugin is licensed under the GPL v2 or later.
