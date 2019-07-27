<?php
namespace App\Fakturownia\Client;

use Illuminate\Support\Str;

class InvoiceOceanClient extends InvoiceOcean
{
    /**
     * @param $username
     * @param $api_token
     */
    public function __construct()
    {
        parent::__construct(
            Str::finish(config('services.fakturownia.url'), '/'),
            config('services.fakturownia.token')
        );

//        $this->_debug = app()->environment('local');
    }

    /**
     * Return clients
     *
     * @return array
     */
    public function getClients()
    {
        $result = $this->request(__FUNCTION__);

        return $result;
    }

    /**
     * Return specific client info
     *
     * @param int $client_id
     *
     * @return array
     */
    public function getClient($client_id = 0)
    {
        $result = $this->request(__FUNCTION__, [], $client_id);

        return $result;
    }

    /**
     * Create a client
     *
     * @param array $client
     * @return array
     */
    public function addClient($client = [])
    {
        // construct parameters
        $parameters = [
            'client' => $client,
        ];

        // send to api
        $result = $this->request(__FUNCTION__, $parameters);

        return $result;
    }

    /**
     * Update a client
     *
     * @param int   $client_id
     * @param array $client
     * @return array
     */
    public function updateClient($client_id = 0, $client = [])
    {
        // construct parameters
        $parameters = [
            'client' => $client,
        ];

        // send to api
        $result = $this->request(__FUNCTION__, $parameters, $client_id);

        return $result;
    }

    /**
     * Get specific invoice information
     *
     * @param int $invoice_id
     *
     * @return array
     */
    public function getInvoice($invoice_id = 0)
    {
        // send to api
        $result = $this->request(__FUNCTION__, [], $invoice_id);

        return $result;
    }

    /**
     * Create an invoice
     *
     * @param array $invoice
     * @return array
     */
    public function addInvoice($invoice = [])
    {
        // construct parameters
        $parameters = [
            'invoice' => $invoice,
        ];

        // send to api
        $result = $this->request(__FUNCTION__, $parameters);

        return $result;
    }

    /**
     * Update an invoice
     *
     * @param int   $invoice_id
     * @param array $invoice
     * @return array
     */
    public function updateInvoice($invoice_id = 0, $invoice = [])
    {
        // construct parameters
        $parameters = [
            'invoice' => $invoice,
        ];

        // send to api
        $result = $this->request(__FUNCTION__, $parameters, $invoice_id);

        return $result;
    }

    /**
     * Delete an invoice
     *
     * @param int $invoice_id
     * @return array
     */
    public function deleteInvoice($invoice_id = 0)
    {
        // send to api
        $result = $this->request(__FUNCTION__, [], $invoice_id);

        return $result;
    }

    /**
     * Email an invoice
     *
     * @param int $invoice_id
     * @return array
     */
    public function sendInvoice($invoice_id = 0)
    {
        // send to api
        $result = $this->request(__FUNCTION__, [], $invoice_id);

        return $result;
    }

    public function getInvoiceUrl(int $invoiceId = null) : ?string
    {
        if ($invoiceId === null) {
            return null;
        }

        return $this->getApiUrl() . '/invoices/' . $invoiceId . '.json?api_token=' . $this->getApiToken();
    }
}
