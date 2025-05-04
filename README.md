[![Latest Stable Version](https://poser.pugx.org/mageprince/module-faq/v)](//packagist.org/packages/mageprince/module-faq)
[![Total Downloads](https://poser.pugx.org/mageprince/module-faq/downloads)](//packagist.org/packages/mageprince/module-faq)
[![Monthly Downloads](https://poser.pugx.org/mageprince/module-faq/d/monthly)](//packagist.org/packages/mageprince/module-faq)
[![License](https://poser.pugx.org/mageprince/module-faq/license)](//packagist.org/packages/mageprince/module-faq)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mageprince/magento2-FAQ/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mageprince/magento2-FAQ/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/mageprince/magento2-FAQ/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)


# Magento 2 FAQ

This module adds an easy and efficient way to integrate a comprehensive FAQ section into your Magento store using a jQuery Accordion layout. It allows the admin to create and manage FAQs and organize them into groups, each with its own icon for better visual distinction. With a rich WYSIWYG editor, admins can enhance FAQ answers by adding widgets, static blocks, images, and more. The module streamlines customer support by making key information easily accessible in a user-friendly and interactive format.

# ✨ Features

- Display all FAQs or FAQs by group on CMS pages and static blocks
- Enable AJAX-based FAQ loading on group selection for a seamless frontend experience
- Define a custom URL for the FAQ page
- Full GraphQL support to retrieve all FAQs, FAQs by group ID, and FAQ groups
- Create and manage FAQ groups (categories) with editing capabilities
- Provide detailed FAQ answers using a rich WYSIWYG editor
- Assign store view visibility to individual FAQs and FAQ groups
- Restrict FAQ and group visibility by customer group
- Organize FAQs into groups for better navigation and user experience
- Lightweight and easy-to-install extension with no impact on site performance
- Supports multistore environments
- Add custom icons to FAQ groups
- Support for inserting images, static blocks, and widgets in FAQ answers
- Support for collapse/expand view toggle on the FAQ page

<b>Check full description and user guid on <a href="https://commercemarketplace.adobe.com/mageprince-module-faq.html">Magento Marketplace</a></b>

# 📺 Demo

<b><a href="https://demo.mageprince.com/faq/">Frontend</a>   |   <a href="https://demo.mageprince.com/admin">Backend</a></b>

# 🚀 Installation Instructions

### 1. Install from Magento Marketplace

[Magento Marketplace Link](https://commercemarketplace.adobe.com/mageprince-module-faq.html)

### 2. Install via composer (packagist.org)

Run the following Magento CLI commands:

```
composer require mageprince/module-faq
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
```

### 3. Manual Installation

Copy the content of the repo to the Magento 2 `app/code/Mageprince/Paymentfee`

Run the following Magento CLI commands:
```
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
```

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

# How to Display FAQs in CMS Pages or Static Blocks

<b>1. To show all FAQ</b>
```
{{block class="Mageprince\Faq\Block\Index\Index" template="Mageprince_Faq::faq_main.phtml" show_group_title=1 show_group=1 page_type="scroll"}}
```
<b>2. To show FAQ by group</b>
```
{{block class="Mageprince\Faq\Block\Index\Index" template="Mageprince_Faq::faq_main.phtml" group_id=1 show_group_title=1}}
```

# 🤝 Contribution

Want to contribute to this extension? The quickest way is to <a href="https://help.github.com/articles/about-pull-requests/">open a pull request</a> on GitHub.

# 🛠 Support

If you encounter any problems or bugs, please <a href="https://github.com/mageprince/magento2-FAQ/issues">open an issue</a> on GitHub.


# 📸 Screenshots

![1_faq_page](https://github.com/user-attachments/assets/c041d098-fea4-4cd4-aeb8-8907f6612554)
![3_widget](https://github.com/user-attachments/assets/909d8260-2f77-42e5-ad11-8c4a2d355e34)
![5_group_grid](https://github.com/user-attachments/assets/c2ba51ef-3542-4749-b502-26699a730bc7)
![6_group_edit](https://github.com/user-attachments/assets/59cb03e0-e0e3-430e-9bd5-de99f8c45255)
![7_faq_grid](https://github.com/user-attachments/assets/5b163a90-9994-4c77-a743-b43e8c6141c1)
![9_faq_edit_1](https://github.com/user-attachments/assets/a19091c6-11ca-43e1-84f8-85ed4722c9ed)
![10_faq_edit_2](https://github.com/user-attachments/assets/22e6308d-834d-4a8d-b868-83e765d0ba91)
![11_configuration_1](https://github.com/user-attachments/assets/4ead115b-8d76-4028-800e-7eebccc8df06)
![12_configuration_2](https://github.com/user-attachments/assets/43fe266b-a9cc-4bea-a42a-fac985d7741b)
![13_widget](https://github.com/user-attachments/assets/bffc21d2-629e-4de9-a28c-d73637071ac9)
