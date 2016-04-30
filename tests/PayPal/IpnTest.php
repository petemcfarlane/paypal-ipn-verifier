<?php

class ClassName extends PHPUnit_Framework_TestCase
{
    public function testIpnVerifierIfSuccessfull()
    {
        $response = $this->getMockBuilder(Psr\Http\Message\ResponseInterface::class)->getMock();
        $response->method('getBody')->willReturn('VERIFIED');

        $client = $this->getMockBuilder(PayPal\Ipn\HttpClient::class)->getMock();
        $client->method('post', ['paypal.com', []])->willReturn($response);

        $this->assertTrue(PayPal\Ipn\verifyIpn([], 'paypal.com', $client));
    }

    public function testIpnVerifierIfUnsuccessful()
    {
        $response = $this->getMockBuilder(Psr\Http\Message\ResponseInterface::class)->getMock();
        $response->method('getBody')->willReturn('Something other than verified');

        $client = $this->getMockBuilder(PayPal\Ipn\HttpClient::class)->getMock();
        $client->method('post', ['paypal.com', []])->willReturn($response);

        $this->assertFalse(PayPal\Ipn\verifyIpn([], 'paypal.com', $client));
    }
}
