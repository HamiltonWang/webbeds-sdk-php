<?php
/**
 * User: Hamilton
 * Date: 12/11/2018
 * Time: 12:40 PM
 */
namespace webbeds\hotel_api_sdk\messages\baseClass;

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
     * @var string sdkMethod method
     */
    private $sdkMethod;
    /**
     * ApiRequest constructor.
     * @param ApiUri $baseUri Base URI of service
     * @param string $sdkMethod Endpoint name of SDK Method
     */
    public function __construct(ApiUri $baseUri, string $sdkMethod)
    {
        $this->request = new Request();
        $this->baseUri = new Http($baseUri);
        $this->sdkMethod =  $sdkMethod;
        $this->baseUri->setPath($baseUri->getPath().$sdkMethod);
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
    public function prepare($userName, $password, $lib)
    {
        if (empty($userName) || empty($password))
            throw new \InvalidArgumentException("HotelApiClient cannot be created without specifying an API key and signature");
        
        $this->request->setUri($this->baseUri);
        $this->request->getHeaders()->addHeaders([
            //'Api-Key' => $userName,
            //'X-Signature' => $password,
            //'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept-Charset' => 'utf-8',
            'Accept-Encoding' => 'gzip, deflate',
            'User-Agent' => 'hotel-api-sdk-php'
        ]);

        //$this->dataRQ->userName = $userName;
        //$this->dataRQ->password = $password;

        if (!empty($this->dataRQ)) {
            switch($this->request->getMethod()) {
                case Request::METHOD_GET:
                        $this->request->setQuery(new Parameters($this->dataRQ->toArray()));
                        break;
                case Request::METHOD_POST:
                        $this->request->getHeaders()->addHeaders(['Content-Type' => 'application/x-www-form-urlencoded']);
                        // $this->request->setContent("".$this->dataRQ);  // setContent is originally for Json
                        $this->request->setpost(new Parameters($this->dataRQ->toArray()));

            }
        }

        //print_r($this->request->getContent());
        return $this->request;
    }
}