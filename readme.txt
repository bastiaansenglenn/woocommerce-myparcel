=== Plugin Name ===
Contributors: pomegranate
Tags: woocommerce, export, myparcel
Requires at least: 3.5.1 & WooCommerce 2.0+
Tested up to: 3.8.1 & WooCommerce 2.1
Stable tag: 1.3.7
License: GPLv3 or later
License URI: http://www.opensource.org/licenses/gpl-license.php

Export your WooCommerce orders to MyParcel (www.myparcel.nl) and print labels directly from the WooCommerce admin

== Description ==

This WooCommerce extension allows you to export your orders to the MyParcel service (www.myparcel.nl). Single orders exports aswell as batch exports are possible.

= Main features =
- Export single orders or batches of orders
- Define preset MyParcel shipping options (signature required, extra insurance, etc.)
- Modify the MyParcel shipping options per order before exporting
- Extra checkout fields to separate street name, house number and house number suffix for more precise address data
- View the status of the shipment in the order details page
- Add track&trace link to the order confirmation email
- Print MyParcel labels directly from WooCommerce (PDF)

A MyParcel API account is required for this plugin! Get one at info@myparcel.nl

== Installation ==

= Automatic installation =
Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't even need to leave your web browser. To do an automatic install of WooCommerce MyParcel, log in to your WordPress admin panel, navigate to the Plugins menu and click Add New.

In the search field type "WooCommerce MyParcel" and click Search Plugins. You can install it by simply clicking Install Now. After clicking that link you will be asked if you're sure you want to install the plugin. Click yes and WordPress will automatically complete the installation.

= Manual installation via the WordPress interface =
1. Download the plugin zip file to your computer
2. Go to the WordPress admin panel menu Plugins > Add New
3. Choose upload
4. Upload the plugin zip file, the plugin will now be installed
5. After installation has finished, click the 'activate plugin' link

= Manual installation via FTP =
1. Download the plugin file to your computer and unzip it
2. Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installation's wp-content/plugins/ directory.
3. Activate the plugin from the Plugins menu within the WordPress admin.

= Setting up the plugin =
1. Go to the menu `settings > MyParcel`.
2. Fill in your API Details. If you don't have API details, send an email to info@myparcel.nl with your account name and you will be sent all necessary information.
3. Under 'Default export settings' you can set options that should be set by default for the export. You can change these settings per order at the time of export.
4. The plugin is ready to be used!

= Testing =
We advise you to test the whole checkout procedure once to see if everything works as it should. Pay special attention to the following:

The MyParcel plugin adds extra fields to the checkout of your webshop, to make it possible for the client to add street name, number and optional additions separately. This way you can be sure that everything is entered correctly. Because not all checkouts are configured alike, it's possible that the positioning/alignment of these extra fields have to be adjusted.

Moreover, after a label is created, a track&trace code is added to the order. When the order is completed from WooCommerce, this track & trace code is added to the email (when this is enabled in the settings). Check that the code is correctly displayed in your template. You can read how to change the text in the FAQ section.

== Frequently Asked Questions ==

= How do I get an API key? =

Send an email to info@myparcel.nl with your account name and you will be sent all necessary information.

= How do I change the track&trace email text? =
You can change the text (which is placed above the order details table by default) by applying the following filter:
`
add_filter( 'wcmyparcel_email_text', 'wcmyparcel_new_email_text' );
function wcmyparcel_new_email_text($track_trace_tekst) {
	// Tutoyeren ipv vousvoyeren
	$nieuwe_tekst = 'Je kunt je bestelling volgen met het volgende PostNL track&trace nummer:';
	return $nieuwe_tekst;
}
`

== Screenshots ==

1. Export or print myparcel label per order
2. Bulk export or print myparcel labels
3. View the status of the shipment on the order details page.

== Changelog ==

= 1.3.7 =
* Fix: Checkout placeholder data was being saved in older versions of Internet Explorer

= 1.3.6 =
* Feature: Option to download PDF or display in browser
* Fix: warnings when debug set to true & downloading labels directly after exporting
* Fix: WooCommerce 2.1 bug with copying foreign address data

= 1.3.5 =
* Fix: Errors when trashing & restoring trashed orders

= 1.3.4 =
* Fix: Errors on foreign country export
* Fix: legacy address data is now also displayed properly
* Tweak: background scrolling locked when exporting

= 1.3.3 =
* Fix: Checks for required fields
* Tweak: Improved address formatting
* Tweak: Removed placeholders on house number & suffix for better compatibility with old browsers

= 1.3.2 =
* Fix: Description labels for Custom ID ('Eigen kenmerk') & Message ('Optioneel bericht')

= 1.3.1 =
* Fix: button image width

= 1.3.0 =
* New MyParcel icons
* Export & PDF buttons compatible with WC2.1 / MP6 styles
* Button styles are now in CSS instead of inline

= 1.2.0 =
* Feature: The myparcel checkout fields (street name / house number) can now also be modified on the my account page
* Fix: WooCommerce 2.1 compatibility (checkout field localisation is now in WC core)
* Updated MyParcel tariffs

= 1.1.1 =
* Fix: Labels for Custom id ('Eigen kenmerk') & Message ('Optioneel bericht') in the export window were reversed
* Fix: Removed depricated functions for better WooCommerce 2.1 compatibility

= 1.1.0 =
* Made extra checkout fields exclusive for dutch customers.
* Show process indicator during export.
* Various bugfixes.

= 1.0.0 =
* First release.