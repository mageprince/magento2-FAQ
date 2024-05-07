[![Latest Stable Version](https://poser.pugx.org/mageprince/module-faq/v)](//packagist.org/packages/mageprince/module-faq)
[![Total Downloads](https://poser.pugx.org/mageprince/module-faq/downloads)](//packagist.org/packages/mageprince/module-faq)
[![Monthly Downloads](https://poser.pugx.org/mageprince/module-faq/d/monthly)](//packagist.org/packages/mageprince/module-faq)
[![License](https://poser.pugx.org/mageprince/module-faq/license)](//packagist.org/packages/mageprince/module-faq)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mageprince/magento2-FAQ/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mageprince/magento2-FAQ/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/mageprince/magento2-FAQ/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)


# Magento 2 FAQ

This module adds an easy way to use FAQ section to your Magento store with jQuery Accordion. In this module, admin can add and update FAQ. Admin can also create FAQ group with group icon. Admin can add widgets, blocks, images etc. in FAQ answer with wyswing editor.


# New Features

- Show all FAQ on CMS page and static block
- Show FAQ by group on CMS page and static block
- Load FAQ by ajax on group selection on the frontend
- Custom FAQ URL
- Add FAQ anywhere by widget
- GraphQL support

<b>Check full description and user guid on <a href="https://commercemarketplace.adobe.com/mageprince-module-faq.html">Magento Marketplace</a></b>

# Demo

<b><a href="https://demo.mageprince.com/faq/">Frontend</a>   |   <a href="https://demo.mageprince.com/admin">Backend</a></b>

# How to install Magento 2 FAQ

### 1. Install from Magento Marketplace

[Magento Marketplace Link](https://commercemarketplace.adobe.com/mageprince-module-faq.html)

### 2. Install via composer (packagist.org)

Run the following command in the Magento 2 root folder:

    composer require mageprince/module-faq
    php bin/magento setup:upgrade
    php bin/magento setup:di:compile
    php bin/magento setup:static-content:deploy

# GraphQL

### Get all FAQs

    query faqs {
      faqs {
        faq_id
        title
        content
        group
        storeview
        customer_group
        sortorder
        status
        created_at
        updated_at
      }
    }
    
### Get FAQs by Group ID:

    query faqs {
      faqs(groupId: 1) {
        faq_id
        title
        content
        group
        storeview
        customer_group
        sortorder
        status
        created_at
        updated_at
      }
    }

### Get all FAQ Groups

    query faqs {
      faqGroups {
        faqgroup_id
        groupname
        icon
        storeview
        customer_group
        sortorder
        status
        created_at
        updated_at
      }
    }

# Use the below code for the CMS page and Static Block

<b>1. To show all FAQ</b>

<code>{{block class="Mageprince\Faq\Block\Index\Index" template="Mageprince_Faq::faq_main.phtml" show_group_title=1 show_group=1 page_type="scroll"}}</code>

<b>2. To show FAQ by group</b>

<code>{{block class="Mageprince\Faq\Block\Index\Index" template="Mageprince_Faq::faq_main.phtml" group_id=1 show_group_title=1}}</code>


# Contribution

Want to contribute to this extension? The quickest way is to <a href="https://help.github.com/articles/about-pull-requests/">open a pull request</a> on GitHub.

# Support

If you encounter any problems or bugs, please <a href="https://github.com/mageprince/magento2-FAQ/issues">open an issue</a> on GitHub.


# Extension Screenshots

<img src="https://commercemarketplace.adobe.com/media/catalog/product/f/b/fb74_1_faq_page_2.jpg"/>
<img src="https://commercemarketplace.adobe.com/media/catalog/product/e/7/e777_3_widget_2.jpg"/>
<img src="https://commercemarketplace.adobe.com/media/catalog/product/8/5/85d4_5_group_grid_2.jpg"/>
<img src="https://commercemarketplace.adobe.com/media/catalog/product/1/6/16de_6_group_edit_2.jpg"/>
<img src="https://commercemarketplace.adobe.com/media/catalog/product/1/5/1579_7_faq_grid_2.jpg"/>
<img src="https://commercemarketplace.adobe.com/media/catalog/product/0/e/0e7b_9_faq_edit_1_2.jpg"/>
<img src="https://commercemarketplace.adobe.com/media/catalog/product/9/b/9b28_10_faq_edit_2_2.jpg"/>
<img src="https://commercemarketplace.adobe.com/media/catalog/product/d/3/d33b_11_configuration_1_2.jpg"/>
<img src="https://commercemarketplace.adobe.com/media/catalog/product/d/6/d672_12_configuration_2_2.jpg"/>
<img src="https://commercemarketplace.adobe.com/media/catalog/product/6/1/6112_13_widget_2.jpg"/>
