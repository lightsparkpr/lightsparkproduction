=== Big Scene ===

Contributors: Bob Wilson
Tags: custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready

Requires at least: 5.8
Tested up to: 5.9
Requires PHP: 5.6
Stable tag: 1.2.3
License: GNU General Public License v3
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html

A theme called Big Scene.

== Description ==

This theme features maximizing the use of images as a way to give a site a unique look.  
It does this by creating a layout that adapts well to a variety of different header videos and header images as well as background images.  
It also gives users the option to decide how to allow mobile browsers to utilize images and videos.  
Users may find that they can create a unique look by just uploading a video and a few images. 
Finally, it includes a sticky navbar and slidepanel menu for mobile browsers.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload Theme and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Changelog ==
= 1.2.3 - February 28 2022 =
* The nav-menu in the js file was updated so that it is checked for existence.  There is a very obscure edge case on 
mobile when the header is in the background:  The image doesn't adjust because an error is thrown in the script file.

= 1.2.2 - February 20 2022 =
* Updated text domain for menu underline, and I updated the .pot file.

= 1.2.1 - February 20 2022 =
* Updated search block so it is consistent on ipad.

= 1.2 - February 16 2022 =
* Lowered the height of post titles on mobile
and added the ability to turn off the page underline to make it easier to build one page sites,
and I updated the .pot file.

= 1.1.1 - February 15 2022 =
* Centered the default block gallery.

= 1.1 - February 2 2021 =
* I updated the customizer so that an updated border color for the extended menu is consistent,
and I renamed the Widgets panel,
and I added top spacing when there are medium or large menu items and there is a logo and the fetured image isn't highlighted,
and I removed featured media from sidebars and sideslide, 
and I added a control in the customizer that gives the ability to remove the page title,
and I stopped the dissappearance of the back to top button at the bottom of the screen on firefox because extra space would be created 
above the footer whenever a single sidebar was present,
and I updated the .pot.

= 1.0.1 - January 26 2021 =
* The blog tag was switched out for the entertainment tag and the custom text color was defined for #bb-popout.

= 1.0 - October 23 2021 =
* The theme was approved by WordPress, and the new download page was added to the footer.

= 0.23 - October 20 2021 =
* Updated rtl header.

= 0.22 - October 15 2021 =
* The z-index for the back to top button had to be adjusted because it was unusable when hovering over some
block patterns.

= 0.20 - 0.21 - October 12 2021 =
* Made changes for theme review.  The issue was an error was being thrown, but it was going undetected 
because an old version of PHP (7.3.9) was being used.  An upgrade to 7.4.24 was made and the error was corrected.

= 0.19 (JS 0.5) - October 5 2021 =
* Updated page title location on highlight featured media.  Changed order of video properties changes in JS.

= 0.16 - 0.18 - September 30 2021 =
* CSS for footer menu and sidebar list.  Added align-wide.  Updated .pot file.  CSS and JS for no descrip no logo.  Updated attribution.

= 0.13 - 0.15 (JS 0.3) - September 28 2021 =
* The width of the screen reader class for the search label had to modified at the JS level because it pushes
the menu button out of position on mobile applications.

= 0.10 - 0.12 - September 27 2021 =
* CSS sub-menu update.  If the text for the search label is deleted, then it breaks the site on mobile.  
Since it doesn't look good in the footer or body anyway, the display has been turned off.
It does not seem to be a problem in the sidebar.

= 0.9 - September 25 2021 =
* Updated file names so that they won't be confused with cached Big Bob files.

= 0.8 - September 24 2021 =
* CSS Adjustments and removal of redundant Google Font calls.

= 0.6 -0.7 - September 23 2021 =
* Updated interpretation of featured video option in video block, added a font selection for title, 
added styling options to featured image blocks, made tagline removal button universal, 
moved some customizer controls from identity to navigation, and made some updates to css and js.

= 0.2 - 0.5 - September 21 2021 =
* CSS and Customizer and JS Script Adjustments.

= 0.1 - September 16 2021 =
* This theme is authored by Bob Wilson.  It is based on my Big Bob theme.  This theme should not be considered a 
pro version of the Big Bob theme.  The Big Bob theme should be considered a beta version of this theme.  It was 
not feasible to retain backwards compatibility without making the customizer far too complicated, so a new theme had to be developed.
The primary updates were performed in the customizer.  The controls are simpler and more powerful.
Controls were added and/or overwritten in the colors section and the site identity section.  All background media
has been merged into a single section, and the controls are much simpler to use.  The bacground media has been designed
so that it will not interfere with anyone trying to add the classic wordpress custom background controls.
The heder media sections have also been merged and simplified.  There are also two new places to add menus.  
And the navbar has several more options, but has fewer controls.  Some of the media is now interpreted differently to make it more versatile, 
and the titles have improved CSS, and I updated the sticky sidebar so that it is more CSS centric and robust, 
and I added the ability to set the title and tagline below the navbar on the homepage, and I added an underline feature for the current page,
and I made it easeir to close the side popout menu, and the positioning style of the titles was updated.  A sidebar menu has 
been added and defined so that it merges with the navbar into the slidepanel on mobile so now you can create a huge sticky menu
on large screens that retains its efficacy on mobile.  I also made some adjustments to the look of the theme.

== Credits ==

* Based on Underscores https://underscores.me/, (C) 2012-2020 Automattic, Inc., [GPLv3 or later](https://www.gnu.org/licenses/gpl-3.0.en.html)
* Based on Big Bob https://bigbobnetwork.com/demo/, (C) 2019 - 2021 Bob Wilson, [GPLv3 or later](https://www.gnu.org/licenses/gpl-3.0.en.html)
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2018 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)
* close-24px.svg, menu-24px.svg, Abel (font), Bebas Neue, Open Font License(https://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL)
* Font Awesome, Font Awesome Free License (https://fontawesome.com/license/free)
* RobotoCondensed (font), Apache License 2.0

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    The Free Software Foundation considers the Apache License, Version 3.0 
    to be a free software license, compatible with version 3 of the GPL. 

        https://www.gnu.org/licenses/gpl-3.0.en.html

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.

Original Screenshot Photo
URL: https://stocksnap.io/photo/surfers-beach-4RUHVKXOYI
License: CC0 License
License URL: https://stocksnap.io/license
Author: Wyncliffe

Updated Screenshot 
Photo
URL: https://stocksnap.io/photo/people-man-191P2Z8N6I
License: CC0 License
License URL: https://stocksnap.io/license
Author: Jesse Darland
Fonts
Alfa Slab One, Bebas Neue, Open Font License(https://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL)

All products are GPL compatible.