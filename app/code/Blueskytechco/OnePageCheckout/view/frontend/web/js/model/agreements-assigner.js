define([
    'jquery'
], function ($) {
    'use strict';

    var agreementsConfig = window.checkoutConfig.checkoutAgreements;

    /** Override default place order action and add agreement_ids to request */
    return function (paymentData) {
        var agreementForm,
            agreementData,
            agreementIds;

        if (!agreementsConfig.isEnabled) {
            return;
        }

        agreementForm = $('.payment-method._active div[data-role=checkout-agreements] input');
        if (!_.isUndefined(window.checkoutConfig.OnePageCheckout) && $('.blueskytechco-onepagecheckout').length) {
            agreementForm = $('.blueskytechco-onepagecheckout #opc-sidebar div[data-role=checkout-agreements] input');
        }
        agreementData = agreementForm.serializeArray();
        agreementIds = [];

        agreementData.forEach(function (item) {
            agreementIds.push(item.value);
        });

        if (paymentData['extension_attributes'] === undefined) {
            paymentData['extension_attributes'] = {};
        }

        paymentData['extension_attributes']['agreement_ids'] = agreementIds;
    };
});
