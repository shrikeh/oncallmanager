<?php
namespace OnCallManager\Repository\OnCall;


use DateTime;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\RequestOptions;
use OnCallManager\Collection\OnCall as OnCallCollection;
use OnCallManager\Customer;
use OnCallManager\Credentials\PagerDuty as Credentials;

/**
 * Class PagerDuty
 * @package OnCallManager\Repository\OnCall
 */
final class PagerDuty implements OnCallRepositoryInterface
{
    const HEADER_AUTHORIZATION = 'Authorization';

    private $client;

    /**
     * PagerDuty constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function findByCustomer(
        Customer $customer,
        DateTime $start,
        DateTime $end
    ): OnCallCollection {
        $credentials = $this->credentials($customer);
        $uri = new Uri('foo');
        $options = [
            RequestOptions::HEADERS => [
                self::HEADER_AUTHORIZATION => $credentials->token()
            ],
        ];

        $this->client->requestAsync('GET', $uri, $options);
        return new OnCallCollection();
    }

    /**
     * @param Customer $customer
     * @return Credentials
     */
    private function credentials(Customer $customer): Credentials
    {
        return $customer->credentials();
    }
}
