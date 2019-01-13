<?php
namespace Test\AppBundle\Service;


class ContactControllerTest extends \PHPUnit_Framework_TestCase
{

    var $client;

    public function setUp()
    {

        $this->client = new \GuzzleHttp\Client();
    }

    /**
     *
     * @dataProvider inputValuesResponse
     */
    public function testNullEmailContact($email, $message, $statusCode, $resultMessage)
    {

        $response = $this->client->request('POST', 'http://localhost:8000/contact', [
            'form_params' => [
                'email' => $email,
                'message' => $message
            ],
            'http_errors' => false
        ]);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertContains($resultMessage, (string)$response->getBody());

    }

    public function inputValuesResponse()
    {
        return array(
            array(null, 'testing', 500, 'Email should not be blank'),
            array('a@example.com', null, 500, 'Message should not be blank'),
            array('a@examplecom', 'testing message', 500, 'Email not valid'),
            array('a@example.com', 'testing', 200, 'Contact Form Submitted')
        );
    }
}
