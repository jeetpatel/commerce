Commerce Open Payment Platform
===============
This module integrates PAY.ON [Open Payment Platform](https://docs.payon.com) with Drupal Commerce, integrating their COPYandPAY widget in Drupal Commerce checkout flow.

## Requirements

Commerce Open Payment Platform depends on Drupal Commerce of course, given a strict dependency on commerce_payment sub module.

**This module is only available for the Drupal 8 version of Drupal Commerce!**

### Maturity

As Drupal Commerce 2.x is not feature complete and in alpha state at the time of writing, possible pre-beta schema changes can always affect this module. **Currently (2016-08-19), the initial Payment API of Commerce is already committed to the commerce_payment sub module. For a full integration, we still have to wait for the offline payments API**.

#### Further important notes on how to getting this to run

There is some additional coding needed at the moment to actually integrate this in your checkout flow. **You'll currently have to implement your own checkout pane for pre-selecting the brand to use in your COPYandPAY widget, for two reasons**:

1. We need the offsite payment API to be implemented (see [#2786797]).
2. Currently, this module relies on using the order entity's data property to save information about which brand was chosen (see the PaymentManager class for more information). On the long run, an appropriate payment method should be used instead. But for now, it's not clear, if there should be a generic one for offsite payment gateways, or if this module should provide its own.

**Please note, that you'll also have to deactivate the default payment information checkout pane and fully replace that with your custom checkout pane!**

#### further status information

* The COPYandPAY implementation is rather basic at the moment. There are lots of customizing options, additional request parameters, etc that could be offered and implemented. For now, it's all about showing the widget with pre-selected brand in the correct language and process the response.
* like mentioned above, the brand selection to be stored in the order's data property, is only a workaround. We should use payment methods instead
* the custom checkout pane will very likely be substituted in the long run by a generic offsite payment pane from Commerce.
* missing code comments
* no unit tests at all
* nice to have: parts like the available brands or the interpretation of response codes should live in its own Drupal independent PHP library

### Credits
Commerce Open Payment Platform module was originally developed and is currently
maintained by [Mag. Andreas Mayr](https://www.drupal.org/u/agoradesign).

All initial development was sponsored by [agoraDesign KG](http://www.agoradesign.at).
