/**
 * Main Woffice object
 *
 * @since 2.5.0
 * @type {{}}
 */
 var Woffice_Backend_Admin = {

    /**
     * Initialize the Woffice's JS
     *
     * @param {jQuery} $
    */
    init: function ($) {
        "use strict";

    	var self = this;

    	self.$ = (typeof $ === 'undefined') ? jQuery : $;

        self.Settings.Settings_Option();
    },

    Settings: {
        Settings_Option: function(){
            var $ = Woffice_Backend_Admin.$;
            $('body').on('focusout','#fw-edit-options-modal-title',function(){
                var title = $(this).val();
                if(title !== '' || title !== undefined) {
                    var slug = title.toLowerCase().split(' ').join('_');
                    $(this).parents('#fw-backend-option-fw-edit-options-modal-title').siblings('#fw-backend-option-fw-edit-options-modal-status_slug').find('#fw-edit-options-modal-status_slug').attr("value",slug);
                }
            });
        }
    }
};

/**
 * Start it!
 *
 * We give it a jQuery object to play with
 */
Woffice_Backend_Admin.init(jQuery);