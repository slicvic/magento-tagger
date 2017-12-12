# Magento Tagger
A Magento 1.9 module that adds the ability to tag orders and customers.

## Installation via Composer
In order to pull in the module via composer you will need to create a `composer.json` file in your project root folder.

You need to add following lines to your project's composer.json to tell Composer to check out the module as well as [magento-composer-installer](https://github.com/Cotya/magento-composer-installer) to install the module.

Make sure to set `magento-root-dir` to the directory where your Magento resides (relative to your project's composer.json).
```
{
    "require": {
        "magento-hackathon/magento-composer-installer": "*",
        "slicvic/magento-tagger": "master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/magento-hackathon/magento-composer-installer"
        },
        {
            "type": "vcs",
            "url": "https://github.com/slicvic/magento-tagger.git"
        }
    ],
    "extra":{
        "magento-root-dir": ".",
        "magento-deploystrategy": "copy"
    }
}
```
## Screenshots
### Tag a customer

1. ![Alt text](https://cloud.githubusercontent.com/assets/4705073/24682316/055da3e0-1967-11e7-90e1-a56ec71c2590.png)

2. ![Alt text](https://cloud.githubusercontent.com/assets/4705073/24682317/055eed72-1967-11e7-8042-8cdf69f50885.png)

3. ![Alt text](https://cloud.githubusercontent.com/assets/4705073/24682318/055fd2d2-1967-11e7-9b4b-39c6d992f9d6.png)

4. ![Alt text](https://cloud.githubusercontent.com/assets/4705073/24682319/0560d268-1967-11e7-9687-85615116a38c.png)

5. ![Alt text](https://cloud.githubusercontent.com/assets/4705073/24682322/0569d142-1967-11e7-8041-644b4ff6d23c.png)

6. ![Alt text](https://cloud.githubusercontent.com/assets/4705073/24682320/05639bce-1967-11e7-9dc4-b03f429c3fd1.png)

### Tag an order

1. ![Alt text](https://cloud.githubusercontent.com/assets/4705073/24682325/056dd26a-1967-11e7-9bf8-cb560e12132b.png)

2. ![Alt text](https://cloud.githubusercontent.com/assets/4705073/24682321/056935fc-1967-11e7-9a28-93744edcebc1.png)

### Manage Tags

1. ![Alt text](https://user-images.githubusercontent.com/4705073/33881978-9615e22c-df04-11e7-8cd6-05d143621966.png)

2. ![Alt text](https://user-images.githubusercontent.com/4705073/33881979-9627ff66-df04-11e7-891b-1070ef30489f.png)
