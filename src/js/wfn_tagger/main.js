var Wfn = Wfn || {};
Wfn.Modules = Wfn.Modules || {};
Wfn.Modules.Tagger = (function($) {
    var settings = {
        formKey: null,
        tagUrl: null,
        untagUrl: null,
        entityId: null,
        entityType: null
    };
    var elements = {
        loadingMask: null,
        tagInput: null,
        tagButtons: null
    };
    var isProcessing = false;
    var selectize;

    function init(_settings) {
        settings = _settings || {};
        bindElements();
        bindSelectize();
        bindTagButtons();
    }

    function bindElements() {
        elements.loadingMask = $('#loading-mask');
        elements.tagInput = $('#tag-input');
        elements.tagButtons = $('#tag-buttons');
    }

    function bindTagButtons() {
        elements.tagButtons.on('click', 'button', function() {
            var tagName = $(this).data('name');
            selectize.createItem(tagName);
        });
    }

    function bindSelectize() {
        elements.tagInput.selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            create: function(input, callback) {
                if (selectize.getItem(input).length) {
                    alert('Tag already added!');
                    return callback(false);
                }

                if (isProcessing) {
                    return callback(false);
                }

                isProcessing = true;
                elements.loadingMask.show();

                $.ajax({
                    url: settings.tagUrl,
                    method: 'post',
                    dataType: 'json',
                    data: {
                        tag_name: input,
                        form_key: settings.formKey,
                        entity_id: settings.entityId,
                        entity_type: settings.entityType
                    }
                }).done(function(response) {
                    if (response.success) {
                        callback({
                            id: input,
                            name: input
                        });
                    } else {
                        callback(false);
                        alert(response.error_message);
                    }
                }).fail(function() {
                    callback(false);
                    alert('Oops! Something went wrong. Please try again!');
                }).always(function() {
                    isProcessing = false;
                    elements.loadingMask.hide();
                });
            },
            onDelete: function(values) {
                if (!values || values.length !== 1) {
                    return false;
                }

                if (isProcessing) {
                    return false;
                }

                var value = values[0];
                isProcessing = true;
                elements.loadingMask.show();

                $.ajax({
                    url: settings.untagUrl,
                    method: 'post',
                    dataType: 'json',
                    data: {
                        tag_name: value,
                        form_key: settings.formKey,
                        entity_id: settings.entityId,
                        entity_type: settings.entityType
                    }
                }).done(function(response) {
                    if (response.success) {
                        selectize.removeItem(value);
                        selectize.removeOption(value);
                    } else {
                        alert(response.error_message);
                    }
                }).fail(function() {
                    alert('Oops! Something went wrong. Please try again!');
                }).always(function() {
                    isProcessing = false;
                    elements.loadingMask.hide();
                });

                return false;
            }
        });

        selectize = elements.tagInput[0].selectize;
    }

    return {
        init: init
    };
}(jQuery));