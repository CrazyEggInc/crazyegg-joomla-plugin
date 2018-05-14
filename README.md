# Crazy Egg Joomla! plugin

The official Crazy Egg Plugin for Joomla. The easiest, free way to add your Crazy Egg tracking script to your Joomla site

## Overview

For testing the plug-in, create an account on Joomla.org and install the actual version from zip-archive by
following the [instructions in Crazy Egg Help Center](https://help.crazyegg.com/article/48-joomla-crazy-egg-installation)

![Plug-in screenshot](https://ce-help-center.s3.amazonaws.com/medium/asset/469/55af483d-bdb9-407a-8694-6a70e3239ebd.png)

The plug-in is pretty simple. In admin panel, its UI consists of:
- Description in header
- Account Number input field
- Crazy Egg logo and references

Given the account number, the plug-in builds a URL of the Crazy Egg tracking script and injects it into all pages
of the website.

## Tracking script

The main job of the plug-in is to insert Crazy Egg tracking script into the customer's website.

Currently it inserts the following HTML (for account number 00000011):

```html
<script src="//script.crazyegg.com/pages/scripts/0000/0011.js" async=""></script>
```

By convention, account number is split into 2 quartets used as the last pieces of the file path.
It is injected at the end of the `<head>` section. The script has "async" attribute as recommended by Crazy Egg.

## Testing the plug-in

In order to test local version of the plug-in, pack it into a zip-archive (as described in "Build" section below).
Install it on Joomla website by uploading the archive.

> To verify that plug-in is working correctly, it's enough to enter any valid account number in the input field (e.g. 00000011).
> Then go to any non-admin page (e.g. site homepage), open Dev Tools => Elements tab, and search for "crazyegg" substring. 
> It should reveal the script tag injected into the page with proper URL.
> It means plug-in is working fine! There's no need to check if data is actually tracked - it's job of the main Crazy Egg app.

With each set of changes, you have to uninstall the plug-in and repeat the process from the beginning.

## Files Structure

To learn more about requirements and features of Joomla plug-ins, refer to [their documentation](https://docs.joomla.org/J3.x:Creating_a_Plugin_for_Joomla)

Here we can only briefly describe the purpose of every file in the plug-in.

##### /LICENSE.txt

Standard GNU license file required in every Joomla plug-in.

##### /index.html

To be honest, I have no idea about the purpose of this file. Maybe it's there just for historical reasons and could be removed.
TODO: find it out and update this section

##### /crazyegg.xml

Main manifest file. It contains plug-in metadata as well as describes its UI on the admin page.

Its `<config>` section contains fields displayed on the admin page (Account Number input).

##### /crazyegg.php

Main logic of the plug-in. It follows default structure for all Joomla plug-ins.

The file is executed on each page load (including admin pages) and inserts Crazy Egg tracking script on the page.

Custom logic is kept in the `onBeforeCompileHead()` hook. It is executed, as seen from its name, before page's `<head>` section is compiled.
The function checks if actual page is not admin page to avoid inserting script and tracking extra page views and clicks of website maintainers.

Then it checks account number setting, and if all good, inserts tracking script with required URL to the page.

##### /language/en-GB/

2 language files required for Joomla plug-in. They contain a few tokens used in other plug-in files
and by Joomla system during installation (_sys.ini_ file)

##### /crazyegg/admin/spacerinfo.php

Custom form field containing Crazy Egg logo, plug-in description and references. It is used to insert custom HTML code
into the plug-in UI on the admin page. It's referenced from `crazyegg.xml` manifest as a custom form field: `<field name="spacer_info" ...`

## Build

To build changed files into a final ZIP-archive run the following command:

```
zip -r crazyegg-joomla-plugin.zip plugin
```

or do the same manually: pack `plugin` folder (including the folder itself) into the zip-archive with
 "crazyegg-joomla-plugin.zip" name (the name is important since it's used in the public URL for installing the plug-in).
 
Don't forget to update version specified in manifest (XML file) and *crazyegg.php*

In Crazy Egg app we use absolute URL to the zip-archive with plug-in: https://github.com/CrazyEggInc/crazyegg-joomla-plugin/raw/master/crazyegg-joomla-plugin.zip
So any updates to the archive should not require any updates in-app, unless the URL of the file changes.

## General Notes

#### Versions maintenance
Usually, any breaking changes should be avoided, because we can't force all customers to re-install the plug-in. There
will always be some people using old versions of the plug-in, and we need to make sure they also work (maybe just not as efficiently as new versions).

#### Plug-ins for other platforms

> We have similar plug-ins for other platforms: WordPress, Drupal, Google Tag Manager. They are all quite different, but 
> ideally we should aim to follow the same UI and functionality within all Crazy Egg plug-ins in order to remain consistent.
> When changing this Joomla plug-in, consider making the same changes to all other plug-ins - and vice versa.
