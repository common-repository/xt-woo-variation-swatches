=== XT Variation Swatches for WooCommerce ===

Plugin Name: XT Variation Swatches or WooCommerce
Contributors: XplodedThemes
Author: XplodedThemes
Author URI: https://www.xplodedthemes.com
Tags: woocommerce, variation swatches, color swatches, image swatches, label swatches, product attributes, smart variation swatches, variation swatches for woocommerce
Requires at least: 4.6
Tested up to: 6.6
Stable tag: 1.9.3
Requires PHP: 5.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A Smart Variation Swatches for WooCommerce that transforms variation dropdowns to beautiful color, image or label swatches. Image swatches will automatically be applied for variation color attributes that contains an image.

== Description ==

XT Variation Swatches is a WooCommerce extension that transforms variation dropdowns to beautiful color, image or label swatches. Image swatches will automatically be applied for variation color attributes that contains an image.

The plugin offers an aesthetic and professional experience to select attributes for variation products. It turns the product variation select options fields into radio images, colors, and label.

XT Variation Swatches for WooCommerce not only offers the color, image and label attributes in the single WooCommerce product page. It also enables them within the catalog page as well as product quick view modals including XT Quick View.

With a friendly and easy-to-use interface, you can add a default color, image or label to each attribute in the attribute management page. It can also help you pick the right style for quick-add attribute right inside the editing product page.

If a color attribute is associated with a variation image, image swatches can automatically be applied.

**Demo**

[https://demos.xplodedthemes.com/woo-variation-swatches/](https://demos.xplodedthemes.com/woo-variation-swatches/)

**Free Version**

- Live Preview Customizer (Limited Options)
- Attribute types: (Dropdown, Label, Color, Image)
- Swatch Style: (Square, Circle, Rounded)
- Adjust Swatch (Width, Height, Alignment)
- Customize options for single product / archives page independently
- Attribute Quick Edit Supported
- Automatically convert Dropdowns to Label Swatch by default
- Automatically convert Color Dropdowns to Image Swatch if variation has an image

**Premium Features**

Fully customizable right from WordPress Customizer with Live Preview.

- All Free Features
- Live Preview Customizer
- Attribute Label Position (Above / Before Swatches)
- Hide Attribute Label
- Hide Variation Reset Link
- Adjust Swatches Container Spacing
- Adjust Swatch Vertical & Horizontal Gap
- Adjust Swatch (Width, Height, Font Size, Colors)
- Enable Tooltip (Text or Image)
- Adjust Tooltip Background & Text Color
- Adjust Tooltip Image Size
- Adjust Tooltip Border Size & Radius
- Override global swatch settings within product page
- Mix swatch types for the same product. ex. Image / Color
- Enable Catalog Mode
- Support display in Quick Views
- Automated Updates & Security Patches
- Priority Email & Help Center Support

**Compatible With <a target="_blank" href="https://xplodedthemes.com/products/woo-floating-cart/">XT Floating Cart</a>**
**Compatible With <a target="_blank" href="https://xplodedthemes.com/products/woo-quick-view/">XT Quick View</a>**
**Supported By <a target="_blank" href="https://wordpress.org/plugins/appmaker-woocommerce-mobile-app-manager/">AppMaker</a>**

**Translations**

- English - default

*Note:* All our plugins are localized / translatable by default. This is very important for all users worldwide. So please contribute your language to the plugin to make it even more useful.

== Installation ==

Installing "XT Variation Swatches" can be done by following these steps:

1. Download the plugin from the customer area at "XplodedThemes.com"
2. Upload the plugin ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
3. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

#### V.1.9.3 - 14.09.2024
- **update**: Freemius SDK update v2.8.0
- **fix**: Security Fix

#### V.1.9.2 - 29.07.2024
- **update**: Freemius SDK update v2.7.3
- **support**: WordPress 6.6
- **support**: WooCommerce 9.1

#### V.1.9.1 - 01.02.2024
- **update**: Freemius SDK update v2.6.2
- **support**: WordPress 6.4

#### V.1.9.0 - 25.08.2023
- **update**: Added WooCommerce HPOS Support

#### V.1.8.8 - 24.07.2023
- **update**: Freemius SDK update v2.5.10

#### V.1.8.7 - 08.03.2023
- **support**: Removed xt-observers-polyfill script, since the plugin does not support old browsers anymore.
- **update**: XT Framework update

#### V.1.8.6 - 14.02.2023
- **update**: XT Framework update
- **support**: Better theme support

#### V.1.8.5 - 28.09.2022
- **support**: PHP 8 support: Removed deprecated warnings
- **update**: XT Framework update

#### V.1.8.4 - 12.09.2022
- **update**: XT Framework update
- **update**: Freemius SDK update

#### V.1.8.3 - 17.03.2022
- **fix**:  Fix JS error occurring on swatch click when it's value contains a space

#### V.1.8.2 - 16.03.2022
- **fix**: Minor CSS fixes for disabled attribute swatches

#### V.1.8.1 - 03.03.2022
- **new**: Added option to allow disabled attribute swatches to be clicked. This is need to support 3rd party plugins such as the **Back In Stock Notifier** plugin: **https://wordpress.org/plugins/back-in-stock-notifier-for-woocommerce/**
- **fix**: Minor CSS fixes
- **fix**: Freemius Security Fix
- **update**: XT Framework update

#### V.1.8.0 - 07.02.2022
- **fix**: Fixed support for Bundled & Composite products
- **update**: XT Framework update

#### V.1.7.9 - 27.11.2021
- **fix**: Minor fix: Remove local dev css path from scss files

#### V.1.7.8 - 20.11.2021
- **fix**: Fix error in backend

#### V.1.7.7 - 16.11.2021
- **update**: XT Framework update

#### V.1.7.6 - 10.11.2021
- **update**: Modify plugin name to avoid trademark violation with WooCommerce

#### V.1.7.5 - 04.08.2021
- **fix**: CSS fixes for out of stock / unavailable variations (cross blur)
- **fix**: Fix outdated "shipping.php" template warning in woocommerce status report
- **fix**: XT Framework customizer CSS fixes

#### V.1.7.4 - 08.07.2021
- **new**: **pro** Added global option to Hide out of stock variations. If a variation is out of stock, it will either be hidden, blurred or blurred & crossed depending on the selected "Disabled Attribute Behavior" option within the "Look & Feel" section.
- **new**: **pro** Added new **Color Swatch Caption** option same as **Image Swatch Caption**. The attribute value will be displayed below each swatch and the font size will automatically be adjusted based on the swatch size.
- **new**: Added global option to completely disable Ajax Variation Threshold
- **enhance**: Moved Catalog Mode and Display Settings into a separate section within the customizer.

#### V.1.7.2 - 28.06.2021
- **support**: CodeCanyon version has been retired, and will no longer be maintained or updated. License migration required. More Info: **https://xplodedthemes.com/codecanyon-license-migration/**

#### V.1.7.1 - 02.06.2021
- **update**: XT Framework update

#### V.1.7.0 - 01.06.2021
- **fix**: Fixed issue with composite products
- **fix**: Minor CSS fixes

#### V.1.6.9 - 20.05.2021
- **fix**: Fixed error: Cannot use object of type stdClass as array. Happens with some themes.
- **update**: XT Framework update

#### V.1.6.8 - 12.04.2021
- **fix**: Minor fixes

#### V.1.6.7 - 31.03.2021
- **support**: Multisite - Network Level License Management
- **update**: XT Framework update

#### V.1.6.6 - 23.03.2021
- **fix**: XT Framework update / fixes

#### V.1.6.5 - 22.03.2021
- **update**: XT Framework update
- **fix**: Minor Fixes

#### V.1.6.4 - 03.03.2021
- **update**: XT Framework update

#### V.1.6.3 - 03.03.2021
- **fix**: Minor CSS Fixes
- **enhance**: For image swatches, use custom image size based on the swatch size set within the customizer
- **update**: XT Framework update

#### V.1.6.1 - 26.01.2021
- **new**: Auto select attributes based on pre defined values within the query string.
- **fix**: Minor Fixes

#### V.1.6.0 - 23.01.2021
- **fix**: Fixed issue with Woo Add To Cart, ajax add to cart option not disabling correctly.
- **update**: XT Framework update

#### V.1.5.9.1 - 04.01.2021
- **fix**: Fixed conflict when swatches are loaded within a quick view modal.

#### V.1.5.9 - 18.12.2020
- **fix**: Fix issue where after selecting an attribute then clearing and selecting another one was always reverting to the first selection. This was only happening on mobile and only if some options were disabled / blurred.

#### V.1.5.8 - 17.12.2020
- **fix**: Fix issue with disabled options within the product level swatches tab.
- **support**: Better support for XT Quick View

#### V.1.5.7 - 15.12.2020
- **fix**: Minor fixes

#### V.1.5.6 - 15.12.2020
- **new**: Added flex mode for label swatches.
- **support**: Added support for WP 5.6
- **support**: Added support for Loco Translate by adding a loco.xml bundle config file.
- **update**: Updated translation file

#### V.1.5.5 - 16.11.2020
- **fix**: Fix issue with single add to cart notices not being cleared properly on page reload.
- **fix**: Fix issue (firefox only) with swatch modal / drawer quickly closing after switching variation.

#### V.1.5.4 - 09.11.2020
- **support**: Support legacy themes that do not support srcset on shop product images. Make sure image size / ratio stays the same after switching variation.
- **enhance**: On shop page, reset image on clear.

#### V.1.5.3 - 04.11.2020
- **new**: Added an option to disable the **Auto Select First Attribute Option**
- **support**: Woo Add To Cart Module: Fire the native **adding_to_cart** and **added_to_cart** events on single pages so other cart plugins can also listen to them and perform actions.

#### V.1.5.2 - 30.10.2020
- **fix**: Fix issue with touch events on mobile

#### V.1.5.1 - 28.10.2020
- **fix**: Fix issue with swatches not initializing on pages with infinite scrolls
- **enhance**: Instant clicks on mobile. Replace all click events with touchstart on mobile which removes the extra 300ms delay.
- **update**: XT Framework update

#### V.1.5.0 - 27.10.2020
- **new**: **pro** Added new option for image swatches to display the attribute value as a caption below the swatch.
- **new**: **pro** Added options to adjust the width & height of the swatches Modal / Drawer display type.
- **update**: XT Framework update
- **fix**: Minor CSS Fixes

#### V.1.4.9 - 26.10.2020
- **new**: **pro** When Display Type is set to Modal or Drawer, added an image preview whenever a variation is selected. https://d.pr/v/phEufJ
- **new**: **pro** When Display Type is set to Modal or Drawer, automatically close after adding to cart or if XT Quick View has become active
- **update**: XT Framework update
- **fix**: Minor CSS Fixes

#### V.1.4.8 - 23.10.2020
- **new**: **pro** Added new **Featured Attribute** option to make selected attribute stand out by enlarging it's swatches. https://d.pr/i/RBBrpI
- **new**: **Woo Add To Cart** : On single product pages, make the scroll up to **Added to cart notice** optional!
- **new**: **Woo Add To Cart** : Enable Disable Ajax add to cart on shop or single product pages
- **new**: **Woo Add To Cart** : Added Redirect options (to cart, to checkout, to custom page) after add to cart.
- **support**: Support **WooCommerce Composite Products**
- **enhance**: Faster swatch loading

#### V.1.4.7 - 21.10.2020
- **new**: Added new **Woo Add To Cart** section. Enable Ajax Add To Cart on single product page. Added custom loading spinners and confirmation checkmarks for the Add to cart button. These settings will now be shared between the **XT Quick View**, **XT Floating Cart** & **XT Variation Swatches** plugins.
- **new**: **Pro** Added new option to use images from product attributes (of type image) as a variation image preview. Useful if no images are set on the variation it self.

#### V.1.4.6 - 15.10.2020
- **new**: Added an option to auto select first option of each attribute;

#### V.1.4.5 - 14.10.2020
- **enhance**: Adapt variable product add to cart button styles on shop page to make it look the same as the single product button.
- **fix**: Minor CSS Fixes
- **update**: XT Framework update

#### V.1.4.3 - 10.10.2020
- **new**: Added option to display selected value next to Attribute Label in single product pages. https://d.pr/i/iWP3CC
- **fix**: Minor CSS Fixes

#### V.1.4.2 - 09.10.2020
- **fix**: Critical Update! Fixes issue with add to cart button not working on some themes after the previous update.

#### V.1.4.1 - 07.10.2020
- **new**: Added native ajax add to cart support on both shop and single product pages for variation products. Before this update, ajax was only supported if XT Floating Cart Pro is installed.
- **update**: XT Framework update

#### V.1.4.0 - 25.09.2020
- **new**: **Pro** Added new "Swatches Display Type" options: (Inline / Modal / Drawer)
- **new**: **Pro** Added new "Swatches Visibility Type" options for "Inline Display Type": (Always Visible or Show on Click / Hover)
- **new**: **Pro** Added new "Swatches Drawer Position" options for "Drawer Display Type": (Bottom / Top / Left / Right)
- **enhance**: **Pro** Restructure customizer options
- **enhance**: Better theme support
- **fix**: Minor fixes

#### V.1.3.2 - 14.08.2020
- **Update**: Update Kirki Framework to v3.1.5
- **fix**: Fixed issue with customizer fields being hidden on WP v5.5

#### V.1.3.1 - 19.05.2020
- **fix**: Minor fixes

#### V.1.3.0 - 12.05.2020
- **fix**: Force showing add to cart button on shop archive page if swatches are enabled. Some themes do not show it by default, ex: Divi theme causing swatches not to appear.

#### V.1.2.9 - 20.04.2020
- **fix**: Fixed issue with swatches not being re-initialized on ajax page load or when ajax filters are applied.
- **fix**: Fix conflict if variation swatches plugin from getwooplugins (Emran Ahmed)

#### V.1.2.8 - 16.04.2020
- **new**: Added option to adjust the woocommerce ajax variation threshold.
- **fix**: Fixed issue with catalog mode not switching image when variations are loaded via ajax
- **fix**: Tooltip not showing

#### V.1.2.7 - 16.04.2020
- **new**: Added option to enable variation image switch on hover in catalog mode
- **new**: Added option to disable Deselect on Click
- **fix**: Minor CSS fixes

#### V.1.2.5 - 13.04.2020
- **fix**: Fix issue with Catalog Mode sometimes not applying correctly on some products.

#### V.1.2.4 - 11.04.2020
- **fix**: Fix intermittent issue on some themes where swatch events are not firing.

#### V.1.2.3 - 10.04.2020
- **fix**: Fix variation image switching on archive

#### V.1.2.2 - 09.04.2020
- **fix**: Disable the add to cart button on the archive page until a variation is selected
- **new**: **Pro** Added option to show quantity field on archive page
- **support**: Better third party Quick View plugins support
- **support**: Better theme support
- **support**: Better compatibility with XT Quick View plugin

#### V.1.2.1.2 - 27.03.2020
- **update**: XT Framework update / bug fixes
- **support**: Support WooCommerce v4

#### V.1.2.1.1 - 18.02.2020
- **update**: XT Framework update / bug fixes

#### V.1.2.1 - 15.02.2020
- **fix**: Fixed issue with add to cart button being hidden on some themes

#### V.1.2.0 - 29.01.2020
- **fix**: Fixed issue with plugin TextDomain not being loaded properly
- **update**: Updated translation files

#### V.1.1.9 - 10.01.2019
- **update**: XT Framework update.

#### V.1.1.8 - 09.01.2019
- **enhance**: Major backend changes. All XT Plugins will now appear under "XT Plugins" menu.

#### V.1.1.7 - 22.11.2019
- **fix**: Minor Fixes

#### V.1.1.6 - 13.11.2019
- **Fix**: Fixed issue with Divi theme, swatches not being loaded on the single page.
- **New**: **Pro** Allow selection of multiple quick attributes to be used when auto converting dropdowns to image swatches. Only the first one found will be used.

#### V.1.1.5 - 05.11.2019
- **Fix**: Make sure swatches re-initialize correctly after applying sorting / filters via ajax.

#### V.1.1.4 - 28.10.2019
- **New**: **Pro** Catalog Mode: Allow selection of multiple global attributes. Only the first one will be displayed.
- **Support**: Support WordPress v5.2.4

#### V.1.1.3 - 23.10.2019
- **Update**: **Pro** Update customizer library to v3.0.45
- **Fix**: **Pro** Fixed issue with some customizer fields hidden on Flatsome theme and others.
- **Enhance**: Faster swatch auto selection when multiple attribute swatches available.

#### V.1.1.2 - 23.10.2019
- **fix**: Fixed infinite loop with some themes when auto selecting multiple attribute swatches on first swatch click

#### V.1.1.1 - 14.10.2019
- **Update**: Update Freemius SDK to v2.3.1

#### V.1.1.0 - 19.08.2019
- **Update**: **Pro** Updated customizer library to V3.0.44

#### V.1.0.9 - 06.08.2019
- **Fix**: **Pro** When adding product quick attributes, the swatch type was being set as the previous attribute swatch type instead of the default "select" type. This has been fixed now which also fixes the "automated dropdown to label swatch" option for quick attributes.
- **Fix**: Minor CSS Fixes

#### V.1.0.8.3 - 08.06.2019
- **Fix**: Fixed issue with automated swatch selection causing infinite loop when attribute is not available and the swatch is disabled.
- **Fix**: Fixed issue with quick edit image uploader

#### V.1.0.8.2 - 05.06.2019
- **Fix**: Customizer: Fix swatch container spacing css
- **Fix**: Minor css fixes and code improvements.

#### V.1.0.8.1 - 25.04.2019
- **Fix**: **Pro** Fixed bug with Disabled Attribute Behavior
- **Fix**: Fixed tooltip flickering issue

#### V.1.0.8 - 24.04.2019
- **New**: **Pro** Added option to select a behavior for Disabled Variations. Select between (Hide, Blur, Blur & Cross)
- **Fix**: **Pro** Product edit page swatch settings: Fixed issue with color pickers not loading after modifying WooCommerce attributes
- **New**: Fixed conflict with the "WooCommerce Recommendation Engine" plugin
- **Support**: Better Theme Support

#### V.1.0.7 - 11.04.2019
- **Support**: Better theme support
- **Fix**: Fixed issue with duplicated "select options" buttons appearing on some themes.
- **Fix**: Fixed issue on product archives page on some themes, product images not being switched on swatch variation select

#### V.1.0.6 - 04.04.2019
- **fix**: **Pro** Fixed licensing issue
- **Fix**: Fixed issue with variation price switching on some themes

#### V.1.0.5 - 29.03.2019
- **Fix**: Fixed issue with product price disappearing on variation select.

#### V.1.0.4 - 26.03.2019
- **Fix**: **Pro** Fix css issue with tooltips
- **Fix**: **Pro** Fix issue with some product level options not saving.
- **Update**: Update translation POT

#### V.1.0.3 - 18.03.2019
- **Update**: **Pro** Updated Customizer Framework
- **Support**: Better WPML Support

#### V.1.0.2 - 13.03.2019
- **New**: Added option to enable / disable swatches on Shop or Single pages. By default, swatches will be disabled on Shop / Archives

#### V.1.0.1 - 26.02.2019
- **Fix**: Fixed bug with customizer default values

#### V.1.0.0 - 20.02.2019
- **Initial**: Initial Version

