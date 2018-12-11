<?php
/**
 * User: Hamilton
 * Date: 12/11/2018
 * Time: 12:40 PM
 */
namespace webbeds\hotel_api_sdk\messages;

use webbeds\hotel_api_sdk\helpers\ApiHelper;
use webbeds\hotel_api_sdk\types\ApiUri;
use Zend\Http\Request;
use Zend\Uri\Http;
use Zend\Stdlib\Parameters;
/**
 * Class ApiRequest This is abstract request class define how prepare final HTTP Request
 * @package webbeds\hotel_api_sdk\messages
 */
abstract class ApiRequest implements ApiCallTypes
{
    /**
     * @var Request Contains a http request
     */
    protected $request;
    /**
     * @var Http Contains final URL with endpoint and extra parameters if is needed
     */
    protected $baseUri;
    /**
     * @var ApiUri Contains well formatted URI of call
     */
    private $dataRQ;
    /**
     * ApiRequest constructor.
     * @param ApiUri $baseUri Base URI of service
     * @param string $operation Endpoint name of operation
     */
    public function __construct(ApiUri $baseUri, $operation)
    {
        $this->request = new Request();
        $this->baseUri = new Http($baseUri);
        $this->baseUri->setPath($baseUri->getPath()."/".$operation);
    }
    /**
     * @param ApiHelper $dataRQ Set data request to request
     */
    protected function setDataRequest(ApiHelper $dataRQ)
    {
        $this->dataRQ = $dataRQ;
    }
    /**
     * @param string $apiKey API Key of client
     * @param string $signature Computed signature for made this call
     * @return Request Return well constructed HTTP Request
     */
    public function prepare($apiKey, $signature)
    {
        if (empty($apiKey) || empty($signature))
            throw new \InvalidArgumentException("HotelApiClient cannot be created without specifying an API key and signature");
        $this->request->setUri($this->baseUri);
        $this->request->getHeaders()->addHeaders([
            //'Api-Key' => $apiKey,
            //'X-Signature' => $signature,
            'Accept' => 'application/xml',
            'Accept-Charset' => 'utf-8',
            'Accept-Encoding' => 'gzip, deflate',
            'User-Agent' => 'hotel-api-sdk-php'
        ]);
        if (!empty($this->dataRQ)) {
            switch($this->request->getMethod()) {
                case Request::METHOD_GET:
                        $this->request->setQuery(new Parameters($this->dataRQ->toArray()));
                        break;
                case Request::METHOD_POST:
                        $this->request->getHeaders()->addHeaders(['Content-Type' => 'application/x-www-form-urlencoded']);
                        $this->request->setContent("".$this->dataRQ);
            }
        }
        return $this->request;
    }
}