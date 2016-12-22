#!/bin/bash
destBaseDir=/Users/victor/Code/slicvic/magento19

#rm $destBaseDir/app/etc/modules/Wfn_Tagger.xml
#rm -R $destBaseDir/app/code/local/Wfn/Tagger/
#rm -R $destBaseDir/app/design/adminhtml/default/default/template/wfn_tagger
#rm $destBaseDir/app/design/adminhtml/default/default/layout/wfn_tagger.xml
#rm -R $destBaseDir/js/wfn_tagger
#rm -R $destBaseDir/skin/adminhtml/default/default/wfn_tagger

cp -R ./src/app/etc/modules/Wfn_Tagger.xml $destBaseDir/app/etc/modules/Wfn_Tagger.xml
cp -R ./src/app/code/local/Wfn/Tagger/ $destBaseDir/app/code/local/Wfn/Tagger/
cp -R ./src/app/design/adminhtml/default/default/template/wfn_tagger/ $destBaseDir/app/design/adminhtml/default/default/template/wfn_tagger
cp -R ./src/app/design/adminhtml/default/default/layout/wfn_tagger.xml $destBaseDir/app/design/adminhtml/default/default/layout/wfn_tagger.xml
cp -R ./src/js/wfn_tagger/ $destBaseDir/js/wfn_tagger
cp -R ./src/skin/adminhtml/default/default/wfn_tagger/ $destBaseDir/skin/adminhtml/default/default/wfn_tagger
