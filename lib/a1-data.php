<?php

class PaymentA1 {
	private $payment_amount = NULL;
	private $currency = NULL;
	private $order_number = NULL;
	private $success_url = NULL;
	private $cancel_url = NULL;
	private $notify_url = NULL;
	private $locale = NULL;
	private $delivery_access = NULL;
	private $first_name = NULL;
	private $last_name = NULL;
	private $street = NULL;
	private $postal_code = NULL;
	private $postal_office = NULL;
	private $country = NULL;
	private $products = array();

    /**
     * Sets the value of payment_amount.
     *
     * @param mixed $payment_amount the payment amount
     *
     * @return self
     */
    private function setPaymentAmount()
    {
        $sum = 0;
        foreach ($this->products as $product) {
            $sum = $sum + $product['totalRowAmount'];
        }
        $this->payment_amount = $sum;

        return $this;
    }

    /**
     * Gets the value of payment_amount.
     *
     * @return mixed
     */
    public function getPaymentAmount()
    {
        return $this->payment_amount;
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
     * Sets the value of success_url.
     *
     * @param mixed $success_url the success url
     *
     * @return self
     */
    public function setSuccessUrl($success_url)
    {
        $this->success_url = $success_url;

        return $this;
    }

    /**
     * Gets the value of success_url.
     *
     * @return mixed
     */
    public function getSuccessUrl()
    {
        return $this->success_url;
    }

    /**
     * Sets the value of cancel_url.
     *
     * @param mixed $cancel_url the cancel url
     *
     * @return self
     */
    public function setCancelUrl($cancel_url)
    {
        $this->cancel_url = $cancel_url;

        return $this;
    }

    /**
     * Gets the value of cancel_url.
     *
     * @return mixed
     */
    public function getCancelUrl()
    {
        return $this->cancel_url;
    }

    /**
     * Sets the value of notify_url.
     *
     * @param mixed $notify_url the notify url
     *
     * @return self
     */
    public function setNotifyUrl($notify_url)
    {
        $this->notify_url = $notify_url;

        return $this;
    }

    /**
     * Gets the value of notify_url.
     *
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    /**
     * Sets the value of locale.
     *
     * @param mixed $locale the locale
     *
     * @return self
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Gets the value of locale.
     *
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Sets the value of first_name.
     *
     * @param mixed $first_name the first name
     *
     * @return self
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Gets the value of first_name.
     *
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Sets the value of last_name.
     *
     * @param mixed $last_name the last name
     *
     * @return self
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Gets the value of last_name.
     *
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Sets the value of street.
     *
     * @param mixed $street the street
     *
     * @return self
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Gets the value of street.
     *
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Sets the value of postal_code.
     *
     * @param mixed $postal_code the postal code
     *
     * @return self
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    /**
     * Gets the value of postal_code.
     *
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Sets the value of postal_office.
     *
     * @param mixed $postal_office the postal office
     *
     * @return self
     */
    public function setPostalOffice($postal_office)
    {
        $this->postal_office = $postal_office;

        return $this;
    }

    /**
     * Gets the value of postal_office.
     *
     * @return mixed
     */
    public function getPostalOffice()
    {
        return $this->postal_office;
    }

    /**
     * Sets the value of country.
     *
     * @param mixed $country the country
     *
     * @return self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Gets the value of country.
     *
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Adds product object into $products array
     *
     * @param $product the added product
     *
     * @return boolean true if success
     */
    public function addProduct($product)
    {
        $product_amount = count($this->products);
        if ($product_amount <= 500) {
    	   $product_array = $product->toArray();
    	   $this->products[] = $product_array;
           return true;
        }

    	return false;
    }

    /**
     * Returns product object from $products array.
     *
     * @param $number int
     *   Order number of product in array.
     *
     * @return object
     *   Object if success. Null if failure.
     */
    public function getProduct($number)
    {
    	if (isset($this->products[$number])) {
    		return $this->products[$number];
    	}
    	
    	return NULL;
    }

    /**
     * Removes product object from $products array.
     *
     * @param $number int
     *   Order number of product in array.
     *
     * @return boolean
     *   True if success.
     */
    public function removeProduct($number)
    {
    	if (isset($this->products[$number])) {
    		unset($this->products[$number]);
    		return true;
    	}

    	return false;
    }

    /**
     * Returns properties in array.
     */
    public function toArray()
    {
        $this->setPaymentAmount();

        $result = array(
            'payment' => array(
            'paymentAmount' => $this->payment_amount,
            'currency' => $this->currency,
            'orderNumber' => $this->order_number,
            'urlSet' => array(
                'successUrl' => $this->success_url,
                'cancelUrl' => $this->cancel_url,
                'notifyUrl' => $this->notify_url
            ),
            'locale' => $this->locale,
            'deliveryAddress' => array(
                'firstName' => $this->first_name,
                'lastName' => $this->last_name,
                'street' => $this->street,
                'postalCode' => $this->postal_code,
                'postalOffice' => $this->postal_office,
                'country' => $this->country
            ),
            'products' => $this->products
            )
        );

        return $result;
    }
}

/**
 * Item/product for PaymentA1 object.
 *
 * Can be added into Payment with PaymentE1::addProduct($product)
 */
class ProductA1 {

	// Properties
	private $code = NULL;
	private $name = NULL;
	private $quantity = NULL;
	private $unit_price = NULL;
	private $total_row_amount = NULL;
	private $vat_percent = NULL;

    /**
     * Sets the value of code.
     *
     * @param mixed $code the code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Gets the value of code.
     *
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets the value of name.
     *
     * @param mixed $name the name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of quantity.
     *
     * @param mixed $quantity the quantity
     *
     * @return self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Gets the value of quantity.
     *
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Sets the value of unit_price.
     *
     * @param mixed $unit_price the unit price
     *
     * @return self
     */
    public function setUnitPrice($unit_price)
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    /**
     * Gets the value of unit_price.
     *
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * Sets the value of total_row_amount automatically
     *
     * @param mixed $total_row_amount the total row amount
     *
     * @return self
     */
    private function setTotalRowAmount()
    {
        $quantity = $this->quantity;
        $price = $this->unit_price;
        $total_price = $quantity * $price;
        $this->total_row_amount = $total_price;

        return $this;
    }

    /**
     * Gets the value of total_row_amount.
     *
     * @return mixed
     */
    public function getTotalRowAmount()
    {
        return $this->total_row_amount;
    }

    /**
     * Sets the value of vat_percent.
     *
     * @param mixed $vat_percent the vat percent
     *
     * @return self
     */
    public function setVatPercent($vat_percent)
    {
        $this->vat_percent = $vat_percent;

        return $this;
    }

    /**
     * Gets the value of vat_percent.
     *
     * @return mixed
     */
    public function getVatPercent()
    {
        return $this->vat_percent;
    }

    /**
     * Creates array from properties and returns it.
     *
     * @return array
     */
    public function toArray()
	{
        $this->setTotalRowAmount();
    	$result = array(
    		'code' => $this->code,
    		'name' => $this->name,
    		'quantity' => floatval($this->quantity),
    		'unitPrice' => floatval($this->unit_price),
    		'totalRowAmount' => floatval($this->total_row_amount),
    		'vatPercent' => floatval($this->vat_percent)
    	);

    	return $result;
    }
}