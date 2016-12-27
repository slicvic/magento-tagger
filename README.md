# Magento Tagger 1.0
This Magento 1.9 extension adds the ability to tag orders and customers.

## Installation via Composer
In order to pull in the module via composer you will need to create a composer.json file in your project root folder.

You need to add following lines to your project's composer.json to tell Composer to check out the module as well as [magento-composer-installer](https://github.com/Cotya/magento-composer-installer) to install the module.

Make sure to set `magento-root-dir` to the directory where your magento resides.  

```
{
    "require": {
        "magento-hackathon/magento-composer-installer": "*",
        "wfn/magento-module-tagger": "dev-develop"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/magento-hackathon/magento-composer-installer"
        },
        {
            "type": "vcs",
            "url": "https://victorwfn@bitbucket.org/wfnnllp/tagger.git"
        }
    ],
    "extra":{
        "magento-root-dir": ".",
        "magento-deploystrategy": "copy"
    }
}
```