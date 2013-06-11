/**
 * Pimcore
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pimcore.org/license
 *
 * @copyright  Copyright (c) 2009-2010 elements.at New Media Solutions GmbH (http://www.elements.at)
 * @license    http://www.pimcore.org/license     New BSD License
 */

pimcore.registerNS("pimcore.object.tags.Tagfield");
pimcore.object.tags.Tagfield = Class.create(pimcore.object.tags.input, {

    type: "Tagfield",

    initialize: function (data, fieldConf) {
        this.data = data;
        this.fieldConfig = fieldConf;
        
    },
    getLayoutEdit:function(){
        
        var store = new Ext.data.JsonStore({
            // store configs
            autoDestroy: true,
            baseParams:{
                key:this.fieldConfig.tagskey
            },
            autoSave:false,
            url: '/plugin/Tagfield/Admin/gettags',
            // reader configs
            root: 'datas',
            fields: ['value']
        });
        store.load();



        this.component =  new Ext.ux.form.SuperBoxSelect({                                
            allowBlank:true,
            autoSave:false,
            autoDestroy:true,
            queryDelay: 100,
            triggerAction: 'all',
            resizable: true,
            mode: 'local',
            width: this.fieldConfig.width,
            minChars: 2,
            fieldLabel: this.fieldConfig.title,
            name: this.fieldConfig.name,
            value: this.data,
            emptyText: t("superselectbox_empty_text"),
            store: store,
            fields: ['value'],
            displayField: 'value',
            valueField: 'value',
            allowAddNewData: true,
            listeners: {
                newitem: function(bs, v, f) {
                    v = v + '';
                    var newObj = {
                        value: v
                    };
                    bs.addNewItem(newObj);
                }
            }

        });
                            
        return this.component;
    }

});