[![Latest Stable Version](https://poser.pugx.org/mageprince/module-faq/v)](//packagist.org/packages/mageprince/module-faq)
[![Total Downloads](https://poser.pugx.org/mageprince/module-faq/downloads)](//packagist.org/packages/mageprince/module-faq)
[![Monthly Downloads](https://poser.pugx.org/mageprince/module-faq/d/monthly)](//packagist.org/packages/mageprince/module-faq)
[![License](https://poser.pugx.org/mageprince/module-faq/license)](//packagist.org/packages/mageprince/module-faq)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mageprince/magento2-FAQ/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mageprince/magento2-FAQ/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/mageprince/magento2-FAQ/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)



# Magento 2 FAQ

This module adds an easy way to use FAQ section to your Magento store with jQuery Accordion. In this module, admin can add and update FAQ. Admin can also create FAQ group with group icon. Admin can add widgets, blocks, images etc. in FAQ answer with wyswing editor.

# Magento Marketplace

https://marketplace.magento.com/prince-module-faq.html


# New Features

- Show all FAQ on CMS page and static block
- Show FAQ by group on CMS page and static block
- Load FAQ by ajax on group selection on the frontend
- Custom FAQ URL
- Add FAQ anywhere by widget

<b>Check full description and user guid on <a href="https://marketplace.magento.com/mageprince-module-faq.html">Magento Marketplace</a></b>

# Demo

<b><a href="https://demo2.mageprince.com/faq/">Frontend</a>   |   <a href="http://demo2.mageprince.com/admin">Backend</a></b>

# Use below code for CMS page and Static Block

<b>1. To show all FAQ</b>

<code>{{block class="Mageprince\Faq\Block\Index\Index" template="Mageprince_Faq::faq_main.phtml" show_group_title=1 show_group=1 page_type="scroll"}}</code>

<b>2. To show FAQ by group</b>

<code>{{block class="Mageprince\Faq\Block\Index\Index" template="Mageprince_Faq::faq_main.phtml" group_id=1 show_group_title=1}}</code>

# Installation Instruction

* Copy the content of the repo to the Magento 2 app/code/Mageprince/Faq
* Run command:
<b>php bin/magento setup:upgrade</b>
* Run Command:
<b>php bin/magento setup:static-content:deploy</b>
* Now Flush Cache: <b>php bin/magento cache:flush</b>


# Contribution

Want to contribute to this extension? The quickest way is to <a href="https://help.github.com/articles/about-pull-requests/">open a pull request</a> on GitHub.

# Support

If you encounter any problems or bugs, please <a href="https://github.com/mageprince/magento2-FAQ/issues">open an issue</a> on GitHub.


# Frontend

<img src="https://marketplace.magento.com/media/catalog/product/2/4/243f_1_faq_page.jpg" height="600"/>
<img src="https://marketplace.magento.com/media/catalog/product/5/b/5bd6_3_widget.jpg" height="600"/>

# Widget

<img src="https://marketplace.magento.com/media/catalog/product/e/e/eebd_13_widget.jpg" height="600"/>

# FAQ Admin

<img src="https://marketplace.magento.com/media/catalog/product/6/8/681c_9_faq_edit_1.jpg" height="600"/>
<img src="https://marketplace.magento.com/media/catalog/product/5/4/544e_10_faq_edit_2.jpg" height="600"/>

# FAQ Group Admin

<img src="https://marketplace.magento.com/media/catalog/product/c/a/ca69_5_group_grid.jpg" height="600"/>
<img src="https://marketplace.magento.com/media/catalog/product/a/b/ab94_6_group_edit.jpg" height="600"/>

# FAQ Configuration

<img src="https://marketplace.magento.com/media/catalog/product/f/a/fabe_11_configuration_1.jpg" height="600"/>
<img src="https://marketplace.magento.com/media/catalog/product/2/f/2f3d_12_configuration_2.jpg" height="600"/>
