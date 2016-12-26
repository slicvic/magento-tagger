(function($) {
    $(function() {
        var isLoading = false;
        var elements = {
            loadingMask: $('#loading-mask'),
            tagInput: $('#tag-input')
        };

        elements.tagInput.selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            create: function(input, callback) {
                if (isLoading) {
                    return;
                }

                isLoading = true;
                elements.loadingMask.show();

                $.ajax({
                    url: '<?php echo $this->getUrl('wfn_tagger/ajax_tags/tag') ?>',
                    method: 'post',
                    dataType: 'json',
                    data: {
                    form_key: '<?php echo Mage::getSingleton('core/session')->getFormKey() ?>',
                        tag: {
                        name: input,
                            assigned_entity_id: '<?php echo $this->entityId ?>',
                            assigned_entity_type: '<?php echo $this->entityType ?>'
                    }
                }
            }).done(function(response) {
                    if (response.success) {
                        callback({
                            id: input,
                            name: input
                        });
                    } else {
                        alert(response.error_message);
                    }
                }).fail(function() {
                    alert('Whoops! Something went wrong. Please try again!');
                }).always(function() {
                    isLoading = false;
                    elements.loadingMask.hide();
                });
            },
            onDelete: function(values) {
                if (!values || values.length !== 1) {
                    return false;
                }

                if (isLoading) {
                    return false;
                }

                var value = values[0];
                isLoading = true;
                elements.loadingMask.show();

                $.ajax({
                        url: '<?php echo $this->getUrl('wfn_tagger/ajax_tags/untag') ?>',
                    method: 'post',
                    dataType: 'json',
                    data: {
                    form_key: '<?php echo Mage::getSingleton('core/session')->getFormKey() ?>',
                        tag: {
                        name: value,
                            assigned_entity_id: '<?php echo $this->entityId ?>',
                            assigned_entity_type: '<?php echo $this->entityType ?>'
                    }
                }
            }).done(function(response) {
                    if (response.success) {
                        selectizeTagInput.removeItem(value);
                    } else {
                        alert(response.error_message);
                    }
                }).fail(function() {
                    alert('Whoops! Something went wrong. Please try again!');
                }).always(function() {
                    isLoading = false;
                    elements.loadingMask.hide();
                });

                return false;
            }
        });

        selectizeTagInput = tagInput[0].selectize;

        $('#tag-buttons').on('click', 'button', function() {
            var tagName = $(this).data('name');
            selectizeTagInput.createItem(tagName);
        });
    });
}(jQuery));