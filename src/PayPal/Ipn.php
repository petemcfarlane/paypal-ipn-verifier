<?php

namespace PayPal\Ipn;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

function verifyIpn($ipn, $url = 'https://ipnpb.paypal.com/cgi-bin/webscr', HttpClient $client = null)
{
    $ipn['cmd'] = '_notify-validate';

    $response = ($client ?: new Client())->post($url, ['form_params' => $ipn]);

    return $response->getBody() == 'VERIFIED';
}

function verifyIpnSandbox($ipn)
{
    return verifyIpn($ipn, 'https://www.sandbox.paypal.com/cgi-bin/webscr');
}

interface HttpClient
{
    public function post($url, $params): ResponseInterface;
}
