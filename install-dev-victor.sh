#!/bin/bash
#
# Module install script for local dev.

magentoRootPath="/Users/$USER/Code/magento19/root"

rm $magentoRootPath/app/etc/modules/Slicvic_Tagger.xml
rm -R $magentoRootPath/app/code/local/Slicvic/Tagger/
rm -R $magentoRootPath/app/design/adminhtml/default/default/template/slicvic_tagger
rm $magentoRootPath/app/design/adminhtml/default/default/layout/slicvic_tagger.xml
rm -R $magentoRootPath/js/slicvic_tagger
rm -R $magentoRootPath/skin/adminhtml/default/default/slicvic_tagger

cp -R ./src/app/etc/modules/Slicvic_Tagger.xml $magentoRootPath/app/etc/modules/Slicvic_Tagger.xml
cp -R ./src/app/code/local/Slicvic/Tagger/ $magentoRootPath/app/code/local/Slicvic/Tagger/
cp -R ./src/app/design/adminhtml/default/default/template/slicvic_tagger/ $magentoRootPath/app/design/adminhtml/default/default/template/slicvic_tagger
cp -R ./src/app/design/adminhtml/default/default/layout/slicvic_tagger.xml $magentoRootPath/app/design/adminhtml/default/default/layout/slicvic_tagger.xml
cp -R ./src/js/slicvic_tagger/ $magentoRootPath/js/slicvic_tagger
cp -R ./src/skin/adminhtml/default/default/slicvic_tagger/ $magentoRootPath/skin/adminhtml/default/default/slicvic_tagger
