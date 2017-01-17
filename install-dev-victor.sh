#!/bin/bash
#
# Module install script for local dev.

magentoRootPath="/Users/$USER/Code/magento19/root"

rm $magentoRootPath/app/etc/modules/Wfn_Tagger.xml
rm -R $magentoRootPath/app/code/local/Wfn/Tagger/
rm -R $magentoRootPath/app/design/adminhtml/default/default/template/wfn_tagger
rm $magentoRootPath/app/design/adminhtml/default/default/layout/wfn_tagger.xml
rm -R $magentoRootPath/js/wfn_tagger
rm -R $magentoRootPath/skin/adminhtml/default/default/wfn_tagger

cp -R ./src/app/etc/modules/Wfn_Tagger.xml $magentoRootPath/app/etc/modules/Wfn_Tagger.xml
cp -R ./src/app/code/local/Wfn/Tagger/ $magentoRootPath/app/code/local/Wfn/Tagger/
cp -R ./src/app/design/adminhtml/default/default/template/wfn_tagger/ $magentoRootPath/app/design/adminhtml/default/default/template/wfn_tagger
cp -R ./src/app/design/adminhtml/default/default/layout/wfn_tagger.xml $magentoRootPath/app/design/adminhtml/default/default/layout/wfn_tagger.xml
cp -R ./src/js/wfn_tagger/ $magentoRootPath/js/wfn_tagger
cp -R ./src/skin/adminhtml/default/default/wfn_tagger/ $magentoRootPath/skin/adminhtml/default/default/wfn_tagger
