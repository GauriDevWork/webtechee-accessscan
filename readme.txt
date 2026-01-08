=== WebTechee AccessScan ===
Contributors: gauri87
Tags: accessibility, a11y, accessibility checker, wcag, alt text, accessibility audit
Requires at least: 5.8
Tested up to: 6.9
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Run automated accessibility scans to detect common accessibility issues on your WordPress site.

== Description ==

**WebTechee AccessScan** helps WordPress site owners and developers quickly identify common accessibility issues on their site.

The plugin performs an automated scan of your published content and highlights issues such as:

* Images missing `alt` attributes
* Empty anchor links without accessible text

The scan runs on demand from the WordPress admin and displays results instantly — no configuration required.

This lightweight, stateless scanner is designed for quick checks during development or content review.

⚠️ This plugin does not store scan data in the database and does not modify your content.

---

== How It Works ==

1. Go to **AccessScan** in the WordPress admin menu
2. Click **Run Scan**
3. Review detected accessibility issues and affected HTML elements
4. Fix issues directly in your content or theme

---

== Features ==

* One-click accessibility scan
* Detects common WCAG-related issues
* Displays affected HTML elements for easier fixes
* Lightweight and fast
* No database tables
* No scheduled tasks
* No front-end scripts added

---

== Free vs Pro ==

This is the **free version** of WebTechee AccessScan.

The free version focuses on:
* Instant scanning
* Common accessibility checks
* No data storage

A **Pro version** is planned with advanced features such as:
* Scan history
* Scheduled scans
* Accessibility scoring
* Exportable reports
* Advanced issue detection

---

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/webtechee-accessscan` directory, or install via the Plugins screen
2. Activate the plugin through the Plugins menu
3. Go to **AccessScan** in the WordPress admin menu
4. Click **Run Scan**

---

== Frequently Asked Questions ==

= Does this plugin modify my site content? =
No. The plugin only scans HTML output and reports issues. It does not change any content.

= Does this plugin store scan results? =
No. Scan results are generated and displayed instantly and are not stored in the database.

= Is this a full accessibility compliance tool? =
No. This plugin detects common accessibility issues and helps identify problem areas. Full WCAG compliance requires manual testing and audits.

= Does it work with page builders? =
Yes. The scanner analyzes rendered HTML, so it works with most themes and page builders.

---

== Screenshots ==

1. AccessScan admin screen
2. Running an accessibility scan
3. Scan results with affected elements

---

== Changelog ==

= 1.0.0 =
* Initial release
* Detect missing image alt attributes
* Detect empty anchor links
* Display affected HTML elements

---

== Upgrade Notice ==

= 1.0.0 =
Initial release.
