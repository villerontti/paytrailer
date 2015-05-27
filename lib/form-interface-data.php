<?php

/**
 * Abstract for payments.
 */
abstract class Payment {

  protected $merchant_secret = NULL;

  public function setMerchantSecret($merchant_secret)
  {
    $this->merchant_secret = $merchant_secret;

    return $this;
  }

  public function getMerchantSecret()
  {
    return $this->merchant_secret;
  }

  public function calculateAuthcode($payment_array)
  {
    $joined_string = $this->merchant_secret;
    foreach ($payment_array as $value) {
      if (is_null($value)) {
        $joined_string = $joined_string . '|';
      }
      else {
        $joined_string = $joined_string . '|' . $value;
      }
    }
    $hash = md5($joined_string);
    $hash = strtoupper($hash);
    return $hash;
  }
}

/**
 * Payment data object for Paytrail REST Interface E1 version.
 */
class PaymentE1 extends Payment {

  private $merchant_id = NULL;
  private $order_number = NULL;
  private $reference_number = NULL;
  private $order_description = NULL;
  private $currency = NULL;
  private $return_address = NULL;
  private $cancel_address = NULL;
  private $pending_address = NULL;
  private $notify_address = NULL;
  private $culture = NULL;
  private $preselected_method = NULL;
  private $mode = NULL;
  private $visible_methods = NULL;
  private $group = NULL;
  private $contact_telno = NULL;
  private $contact_cellno = NULL;
  private $contact_email = NULL;
  private $contact_firstname = NULL;
  private $contact_lastname = NULL;
  private $contact_company = NULL;
  private $contact_addr_street = NULL;
  private $contact_addr_zip = NULL;
  private $contact_addr_city = NULL;
  private $contact_addr_country = NULL;
  private $include_vat = NULL;
  private $items = NULL;
  private $items_array = array();

  /**
   * Sets the value of merchant_id.
   *
   * @param mixed $merchant_id the merchant id
   *
   * @return self
   */
  public function setMerchantId($merchant_id)
  {
    $this->merchant_id = $merchant_id;

    return $this;
  }

  /**
   * Gets the value of merchant_id.
   *
   * @return mixed
   */
  public function getMerchantId()
  {
    return $this->merchant_id;
  }

  /**
   * Sets the value of order_number.
   *
   * @param mixed $order_number the order number
   *
   * @return self
   */
  public function setOrderNumber($order_number)
  {
    $this->order_number = $order_number;

    return $this;
  }

  /**
   * Gets the value of order_number.
   *
   * @return mixed
   */
  public function getOrderNumber()
  {
    return $this->order_number;
  }

  /**
   * Sets the value of reference_number.
   *
   * @param mixed $reference_number the reference number
   *
   * @return self
   */
  public function setReferenceNumber($reference_number)
  {
    $this->reference_number = $reference_number;

    return $this;
  }

  /**
   * Gets the value of reference_number.
   *
   * @return mixed
   */
  public function getReferenceNumber()
  {
    return $this->reference_number;
  }

  /**
   * Sets the value of order_description.
   *
   * @param mixed $order_description the order description
   *
   * @return self
   */
  public function setOrderDescription($order_description)
  {
    $this->order_description = $order_description;

    return $this;
  }

  /**
   * Gets the value of order_description.
   *
   * @return mixed
   */
  public function getOrderDescription()
  {
    return $this->order_description;
  }

  /**
   * Sets the value of currency.
   *
   * @param mixed $currency the currency
   *
   * @return self
   */
  public function setCurrency($currency)
  {
    $this->currency = $currency;

    return $this;
  }

  /**
   * Gets the value of currency.
   *
   * @return mixed
   */
  public function getCurrency()
  {
    return $this->currency;
  }

  /**
   * Sets the value of return_address.
   *
   * @param mixed $return_address the return address
   *
   * @return self
   */
  public function setReturnAddress($return_address)
  {
    $this->return_address = $return_address;

    return $this;
  }

  /**
   * Gets the value of return_address.
   *
   * @return mixed
   */
  public function getReturnAddress()
  {
    return $this->return_address;
  }

  /**
   * Sets the value of cancel_address.
   *
   * @param mixed $cancel_address the cancel address
   *
   * @return self
   */
  public function setCancelAddress($cancel_address)
  {
    $this->cancel_address = $cancel_address;

    return $this;
  }

  /**
   * Gets the value of cancel_address.
   *
   * @return mixed
   */
  public function getCancelAddress()
  {
    return $this->cancel_address;
  }

  /**
   * Sets the value of pending_address.
   *
   * @param mixed $pending_address the pending address
   *
   * @return self
   */
  public function setPendingAddress($pending_address)
  {
    $this->pending_address = $pending_address;

    return $this;
  }

  /**
   * Gets the value of pending_address.
   *
   * @return mixed
   */
  public function getPendingAddress()
  {
    return $this->pending_address;
  }

  /**
   * Sets the value of notify_address.
   *
   * @param mixed $notify_address the notify address
   *
   * @return self
   */
  public function setNotifyAddress($notify_address)
  {
    $this->notify_address = $notify_address;

    return $this;
  }

  /**
   * Gets the value of notify_address.
   *
   * @return mixed
   */
  public function getNotifyAddress()
  {
    return $this->notify_address;
  }

  /**
   * Sets the value of culture.
   *
   * @param mixed $culture the culture
   *
   * @return self
   */
  public function setCulture($culture)
  {
    $this->culture = $culture;

    return $this;
  }

  /**
   * Gets the value of culture.
   *
   * @return mixed
   */
  public function getCulture()
  {
    return $this->culture;
  }

  /**
   * Sets the value of preselected_method.
   *
   * @param mixed $preselected_method the preselected method
   *
   * @return self
   */
  public function setPreselectedMethod($preselected_method)
  {
    $this->preselected_method = $preselected_method;

    return $this;
  }

  /**
   * Gets the value of preselected_method.
   *
   * @return mixed
   */
  public function getPreselectedMethod()
  {
    return $this->preselected_method;
  }

  /**
   * Sets the value of mode.
   *
   * @param mixed $mode the mode
   *
   * @return self
   */
  public function setMode($mode)
  {
    $this->mode = $mode;

    return $this;
  }

  /**
   * Gets the value of mode.
   *
   * @return mixed
   */
  public function getMode()
  {
    return $this->mode;
  }

  /**
   * Sets the value of visible_methods.
   *
   * @param mixed $visible_methods the visible methods
   *
   * @return self
   */
  public function setVisibleMethods($visible_methods)
  {
    $this->visible_methods = $visible_methods;

    return $this;
  }

  /**
   * Gets the value of visible_methods.
   *
   * @return mixed
   */
  public function getVisibleMethods()
  {
    return $this->visible_methods;
  }

  /**
   * Sets the value of group.
   *
   * @param mixed $group the group
   *
   * @return self
   */
  public function setGroup($group)
  {
    $this->group = $group;

    return $this;
  }

  /**
   * Gets the value of group.
   *
   * @return mixed
   */
  public function getGroup()
  {
    return $this->group;
  }

  /**
   * Sets the value of contact_telno.
   *
   * @param mixed $contact_telno the contact telno
   *
   * @return self
   */
  public function setContactTelno($contact_telno)
  {
    $this->contact_telno = $contact_telno;

    return $this;
  }

  /**
   * Gets the value of contact_telno.
   *
   * @return mixed
   */
  public function getContactTelno()
  {
    return $this->contact_telno;
  }

  /**
   * Sets the value of contact_cellno.
   *
   * @param mixed $contact_cellno the contact cellno
   *
   * @return self
   */
  public function setContactCellno($contact_cellno)
  {
    $this->contact_cellno = $contact_cellno;

    return $this;
  }

  /**
   * Gets the value of contact_cellno.
   *
   * @return mixed
   */
  public function getContactCellno()
  {
    return $this->contact_cellno;
  }

  /**
   * Sets the value of contact_email.
   *
   * @param mixed $contact_email the contact email
   *
   * @return self
   */
  public function setContactEmail($contact_email)
  {
    $this->contact_email = $contact_email;

    return $this;
  }

  /**
   * Gets the value of contact_email.
   *
   * @return mixed
   */
  public function getContactEmail()
  {
    return $this->contact_email;
  }

  /**
   * Sets the value of contact_firstname.
   *
   * @param mixed $contact_firstname the contact firstname
   *
   * @return self
   */
  public function setContactFirstname($contact_firstname)
  {
    $this->contact_firstname = $contact_firstname;

    return $this;
  }

  /**
   * Gets the value of contact_firstname.
   *
   * @return mixed
   */
  public function getContactFirstname()
  {
    return $this->contact_firstname;
  }

  /**
   * Sets the value of contact_lastname.
   *
   * @param mixed $contact_lastname the contact lastname
   *
   * @return self
   */
  public function setContactLastname($contact_lastname)
  {
    $this->contact_lastname = $contact_lastname;

    return $this;
  }

  /**
   * Gets the value of contact_lastname.
   *
   * @return mixed
   */
  public function getContactLastname()
  {
    return $this->contact_lastname;
  }

  /**
   * Sets the value of contact_company.
   *
   * @param mixed $contact_company the contact company
   *
   * @return self
   */
  public function setContactCompany($contact_company)
  {
    $this->contact_company = $contact_company;

    return $this;
  }

  /**
   * Gets the value of contact_company.
   *
   * @return mixed
   */
  public function getContactCompany()
  {
    return $this->contact_company;
  }

  /**
   * Sets the value of contact_addr_street.
   *
   * @param mixed $contact_addr_street the contact addr street
   *
   * @return self
   */
  public function setContactAddrStreet($contact_addr_street)
  {
    $this->contact_addr_street = $contact_addr_street;

    return $this;
  }

  /**
   * Gets the value of contact_addr_street.
   *
   * @return mixed
   */
  public function getContactAddrStreet()
  {
    return $this->contact_addr_street;
  }

  /**
   * Sets the value of contact_addr_zip.
   *
   * @param mixed $contact_addr_zip the contact addr zip
   *
   * @return self
   */
  public function setContactAddrZip($contact_addr_zip)
  {
    $this->contact_addr_zip = $contact_addr_zip;

    return $this;
  }

  /**
   * Gets the value of contact_addr_zip.
   *
   * @return mixed
   */
  public function getContactAddrZip()
  {
    return $this->contact_addr_zip;
  }

  /**
   * Sets the value of contact_addr_city.
   *
   * @param mixed $contact_addr_city the contact addr city
   *
   * @return self
   */
  public function setContactAddrCity($contact_addr_city)
  {
    $this->contact_addr_city = $contact_addr_city;

    return $this;
  }

  /**
   * Gets the value of contact_addr_city.
   *
   * @return mixed
   */
  public function getContactAddrCity()
  {
    return $this->contact_addr_city;
  }

  /**
   * Sets the value of contact_addr_country.
   *
   * @param mixed $contact_addr_country the contact addr country
   *
   * @return self
   */
  public function setContactAddrCountry($contact_addr_country)
  {
    $this->contact_addr_country = $contact_addr_country;

    return $this;
  }

  /**
   * Gets the value of contact_addr_country.
   *
   * @return mixed
   */
  public function getContactAddrCountry()
  {
    return $this->contact_addr_country;
  }

  /**
   * Sets the value of include_vat.
   *
   * @param mixed $include_vat the include vat
   *
   * @return self
   */
  public function setIncludeVat($include_vat)
  {
    $this->include_vat = $include_vat;

    return $this;
  }

  /**
   * Gets the value of include_vat.
   *
   * @return mixed
   */
  public function getIncludeVat()
  {
    return $this->include_vat;
  }

  /**
   * Sets the value of items.
   *
   * @param mixed $items the items
   *
   * @return self
   */
  private function setItems()
  {
    $this->items = count($this->items_array);

    return $this;
  }

  /**
   * Gets the value of items.
   *
   * @return mixed
   */
  public function getItems()
  {
    return $this->items;
  }

  /**
   * Adds the item into payment.
   *
   * @param mixed $item the item object
   */
  public function addItemToPayment($item)
  {
    $item_result = $item->toArray();
    $this->items_array[] = $item_result;
    $this->setItems();
  }

  /**
   * Gets item from payment of order number.
   *
   * @param mixed $order the item order number
   */
  public function getItemFromPayment($order)
  {
    if (isset($this->items_array[$order])) {
      return $this->items_array[$order];
    }
    return NULL;
  }

  /**
   * Removes item from payment of order number.
   *
   * @param mixed $order the item order number
   */
  public function removeItemFromPayment($order)
  {
    if (isset($this->items_array[$order])) {
      unset($this->items_array[$order]);
      $this->setItems();
      return true;
    }
    return false;
  }

  /**
   * Returns properties with key and value pairs.
   */
  public function toArray()
  {

    $this->setItems();

    $result = array(
      'MERCHANT_ID' => $this->merchant_id,
      'ORDER_NUMBER' => $this->order_number,
      'REFERENCE_NUMBER' => $this->reference_number,
      'ORDER_DESCRIPTION' => $this->order_description,
      'CURRENCY' => $this->currency,
      'RETURN_ADDRESS' => $this->return_address,
      'CANCEL_ADDRESS' => $this->cancel_address,
      'PENDING_ADDRESS' => $this->pending_address,
      'NOTIFY_ADDRESS' => $this->notify_address,
      'TYPE' => 'E1',
      'CULTURE' => $this->culture,
      'PRESELECTED_METHOD' => $this->preselected_method,
      'MODE' => $this->mode,
      'VISIBLE_METHODS' => $this->visible_methods,
      'GROUP' => $this->group,
      'CONTACT_TELNO' => $this->contact_telno,
      'CONTACT_CELLNO' => $this->contact_cellno,
      'CONTACT_EMAIL' => $this->contact_email,
      'CONTACT_FIRSTNAME' => $this->contact_firstname,
      'CONTACT_LASTNAME' => $this->contact_lastname,
      'CONTACT_COMPANY' => $this->contact_company,
      'CONTACT_ADDR_STREET' => $this->contact_addr_street,
      'CONTACT_ADDR_ZIP' => $this->contact_addr_zip,
      'CONTACT_ADDR_CITY' => $this->contact_addr_city,
      'CONTACT_ADDR_COUNTRY' => $this->contact_addr_country,
      'INCLUDE_VAT' => $this->include_vat,
      'ITEMS' => $this->items
    );

    $items_array_length = count($this->items_array);

    for ($i = 0; $i < $items_array_length; $i++) {
      foreach ($this->items_array[$i] as $key => $value) {
        $new_key = $key . '[' . $i . ']';
        $result[$new_key] = $value;
      }
    }

    $auth_code = $this->calculateAuthcode($result);

    $result['AUTHCODE'] = $auth_code;

    return $result;
  }

}

/**
 * Item/product for PaymentE1 object.
 *
 * Can be added into Payment with PaymentE1::addItemToPayment($item)
 */
class ItemE1 {

  private $item_title = NULL;
  private $item_no = NULL;
  private $item_amount = NULL;
  private $item_price = NULL;
  private $item_tax = NULL;
  private $item_discount = NULL;
  private $item_type = NULL;

  /**
   * Sets the value of item_title.
   *
   * @param mixed $item_title the item title
   *
   * @return self
   */
  public function setItemTitle($item_title)
  {
    $this->item_title = $item_title;

    return $this;
  }

  /**
   * Gets the value of item_title.
   *
   * @return mixed
   */
  public function getItemTitle()
  {
    return $this->item_title;
  }

  /**
   * Sets the value of item_no.
   *
   * @param mixed $item_no the item no
   *
   * @return self
   */
  public function setItemNo($item_no)
  {
    $this->item_no = $item_no;

    return $this;
  }

  /**
   * Gets the value of item_no.
   *
   * @return mixed
   */
  public function getItemNo()
  {
    return $this->item_no;
  }

  /**
   * Sets the value of item_amount.
   *
   * @param mixed $item_amount the item amount
   *
   * @return self
   */
  public function setItemAmount($item_amount)
  {
    $this->item_amount = $item_amount;

    return $this;
  }

  /**
   * Gets the value of item_amount.
   *
   * @return mixed
   */
  public function getItemAmount()
  {
    return $this->item_amount;
  }

  /**
   * Sets the value of item_price.
   *
   * @param mixed $item_price the item price
   *
   * @return self
   */
  public function setItemPrice($item_price)
  {
    $this->item_price = $item_price;

    return $this;
  }

  /**
   * Gets the value of item_price.
   *
   * @return mixed
   */
  public function getItemPrice()
  {
    return $this->item_price;
  }

  /**
   * Sets the value of item_tax.
   *
   * @param mixed $item_tax the item tax
   *
   * @return self
   */
  public function setItemTax($item_tax)
  {
    $this->item_tax = $item_tax;

    return $this;
  }

  /**
   * Gets the value of item_tax.
   *
   * @return mixed
   */
  public function getItemTax()
  {
    return $this->item_tax;
  }

  /**
   * Sets the value of item_discount.
   *
   * @param mixed $item_discount the item discount
   *
   * @return self
   */
  public function setItemDiscount($item_discount)
  {
    $this->item_discount = $item_discount;

    return $this;
  }

  /**
   * Gets the value of item_discount.
   *
   * @return mixed
   */
  public function getItemDiscount()
  {
    return $this->item_discount;
  }

  /**
   * Sets the value of item_type.
   *
   * @param mixed $item_type the item type
   *
   * @return self
   */
  public function setItemType($item_type)
  {
    $this->item_type = $item_type;

    return $this;
  }

  /**
   * Gets the value of item_type.
   *
   * @return mixed
   */
  public function getItemType()
  {
    return $this->item_type;
  }

  /**
   * Returns properties with key and value pairs.
   */
  public function toArray()
  {
    $result = array(
      'ITEM_TITLE' => $this->item_title,
      'ITEM_NO' => $this->item_no,
      'ITEM_AMOUNT' => $this->item_amount,
      'ITEM_PRICE' => $this->item_price,
      'ITEM_TAX' => $this->item_tax,
      'ITEM_DISCOUNT' => $this->item_discount,
      'ITEM_TYPE' => $this->item_type
    );

    return $result;
  }
}

/**
 * Payment data object for Paytrail REST Interface S1 version.
 */
class PaymentS1 extends Payment {

  private $merchant_id = NULL;
  private $amount = NULL;
  private $order_number = NULL;
  private $reference_number = NULL;
  private $order_description = NULL;
  private $currency = NULL;
  private $return_address = NULL;
  private $cancel_address = NULL;
  private $pending_address = NULL;
  private $notify_address = NULL;
  private $culture = NULL;
  private $preselected_method = NULL;
  private $mode = NULL;
  private $visible_methods = NULL;
  private $group = NULL;

  /**
   * Sets the value of merchant_id.
   *
   * @param mixed $merchant_id the merchant id
   *
   * @return self
   */
  public function setMerchantId($merchant_id)
  {
    $this->merchant_id = $merchant_id;

    return $this;
  }

  /**
   * Gets the value of merchant_id.
   *
   * @return mixed
   */
  public function getMerchantId()
  {
    return $this->merchant_id;
  }

  /**
   * Sets the value of amount.
   *
   * @param mixed $amount the amount
   *
   * @return self
   */
  public function setAmount($amount)
  {
    $this->amount = $amount;

    return $this;
  }

  /**
   * Gets the value of amount.
   *
   * @return mixed
   */
  public function getAmount()
  {
    return $this->amount;
  }

  /**
   * Sets the value of order_number.
   *
   * @param mixed $order_number the order number
   *
   * @return self
   */
  public function setOrderNumber($order_number)
  {
    $this->order_number = $order_number;

    return $this;
  }

  /**
   * Gets the value of order_number.
   *
   * @return mixed
   */
  public function getOrderNumber()
  {
    return $this->order_number;
  }

  /**
   * Sets the value of reference_number.
   *
   * @param mixed $reference_number the reference number
   *
   * @return self
   */
  public function setReferenceNumber($reference_number)
  {
    $this->reference_number = $reference_number;

    return $this;
  }

  /**
   * Gets the value of reference_number.
   *
   * @return mixed
   */
  public function getReferenceNumber()
  {
    return $this->reference_number;
  }

  /**
   * Sets the value of order_description.
   *
   * @param mixed $order_description the order description
   *
   * @return self
   */
  public function setOrderDescription($order_description)
  {
    $this->order_description = $order_description;

    return $this;
  }

  /**
   * Gets the value of order_description.
   *
   * @return mixed
   */
  public function getOrderDescription()
  {
    return $this->order_description;
  }

  /**
   * Sets the value of currency.
   *
   * @param mixed $currency the currency
   *
   * @return self
   */
  public function setCurrency($currency)
  {
    $this->currency = $currency;

    return $this;
  }

  /**
   * Gets the value of currency.
   *
   * @return mixed
   */
  public function getCurrency()
  {
    return $this->currency;
  }

  /**
   * Sets the value of return_address.
   *
   * @param mixed $return_address the return address
   *
   * @return self
   */
  public function setReturnAddress($return_address)
  {
    $this->return_address = $return_address;

    return $this;
  }

  /**
   * Gets the value of return_address.
   *
   * @return mixed
   */
  public function getReturnAddress()
  {
    return $this->return_address;
  }

  /**
   * Sets the value of cancel_address.
   *
   * @param mixed $cancel_address the cancel address
   *
   * @return self
   */
  public function setCancelAddress($cancel_address)
  {
    $this->cancel_address = $cancel_address;

    return $this;
  }

  /**
   * Gets the value of cancel_address.
   *
   * @return mixed
   */
  public function getCancelAddress()
  {
    return $this->cancel_address;
  }

  /**
   * Sets the value of pending_address.
   *
   * @param mixed $pending_address the pending address
   *
   * @return self
   */
  public function setPendingAddress($pending_address)
  {
    $this->pending_address = $pending_address;

    return $this;
  }

  /**
   * Gets the value of pending_address.
   *
   * @return mixed
   */
  public function getPendingAddress()
  {
    return $this->pending_address;
  }

  /**
   * Sets the value of notify_address.
   *
   * @param mixed $notify_address the notify address
   *
   * @return self
   */
  public function setNotifyAddress($notify_address)
  {
    $this->notify_address = $notify_address;

    return $this;
  }

  /**
   * Gets the value of notify_address.
   *
   * @return mixed
   */
  public function getNotifyAddress()
  {
    return $this->notify_address;
  }

  /**
   * Sets the value of culture.
   *
   * @param mixed $culture the culture
   *
   * @return self
   */
  public function setCulture($culture)
  {
    $this->culture = $culture;

    return $this;
  }

  /**
   * Gets the value of culture.
   *
   * @return mixed
   */
  public function getCulture()
  {
    return $this->culture;
  }

  /**
   * Sets the value of preselected_method.
   *
   * @param mixed $preselected_method the preselected method
   *
   * @return self
   */
  public function setPreselectedMethod($preselected_method)
  {
    $this->preselected_method = $preselected_method;

    return $this;
  }

  /**
   * Gets the value of preselected_method.
   *
   * @return mixed
   */
  public function getPreselectedMethod()
  {
    return $this->preselected_method;
  }

  /**
   * Sets the value of mode.
   *
   * @param mixed $mode the mode
   *
   * @return self
   */
  public function setMode($mode)
  {
    $this->mode = $mode;

    return $this;
  }

  /**
   * Gets the value of mode.
   *
   * @return mixed
   */
  public function getMode()
  {
    return $this->mode;
  }

  /**
   * Sets the value of visible_methods.
   *
   * @param mixed $visible_methods the visible methods
   *
   * @return self
   */
  public function setVisibleMethods($visible_methods)
  {
    $this->visible_methods = $visible_methods;

    return $this;
  }

  /**
   * Gets the value of visible_methods.
   *
   * @return mixed
   */
  public function getVisibleMethods()
  {
    return $this->visible_methods;
  }

  /**
   * Sets the value of group.
   *
   * @param mixed $group the group
   *
   * @return self
   */
  public function setGroup($group)
  {
    $this->group = $group;

    return $this;
  }

  /**
   * Gets the value of group.
   *
   * @return mixed
   */
  public function getGroup()
  {
    return $this->group;
  }

  /**
   * Returns properties with key and value pairs.
   */
  public function toArray() {
    $result = array(
      'MERCHANT_ID' => $this->merchant_id,
      'AMOUNT' => $this->amount,
      'ORDER_NUMBER' => $this->order_number,
      'REFERENCE_NUMBER' => $this->reference_number,
      'ORDER_DESCRIPTION' => $this->order_description,
      'CURRENCY' => $this->currency,
      'RETURN_ADDRESS' => $this->return_address,
      'CANCEL_ADDRESS' => $this->cancel_address,
      'PENDING_ADDRESS' => $this->pending_address,
      'NOTIFY_ADDRESS' => $this->notify_address,
      'TYPE' => 'S1',
      'CULTURE' => $this->culture,
      'PRESELECTED_METHOD' => $this->preselected_method,
      'MODE' => $this->mode,
      'VISIBLE_METHODS' => $this->visible_methods,
      'GROUP' => $this->group
    );

    $auth_code = $this->calculateAuthcode($result);

    $result['AUTHCODE'] = $auth_code;

    return $result;
  }
}











