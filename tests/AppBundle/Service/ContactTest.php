<?php
namespace Test\AppBundle\Service;

class ContactTest extends \PHPUnit_Framework_TestCase {
    
    var $contact;

    public function setUp(){
        $this->contact = $this->getMockBuilder('AppBundle\Service\Contact')
            ->disableOriginalConstructor()
            ->setMethods(['isValid','insertContact'])
            ->getMock();
    }
    public function testContactFormInValid()
    {
        $this->contact->method('isValid')
            ->willReturn(false);
        $result = $this->contact->submitContact();
        $this->assertEquals(false, $result);
    }
    public function testContactFormValid()
    {
        $this->contact->method('isValid')
            ->willReturn(true);
        $this->contact->expects($this->once())
            ->method('insertContact');
        $this->contact->submitContact();
    }

    public function testInsertContact(){
        $emMock = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->setMethods(array('persist', 'flush'))
            ->disableOriginalConstructor()
            ->getMock();
        $requestMock =  $this->getMockBuilder('Symfony\Component\HttpFoundation\ParameterBag')
            ->disableOriginalConstructor()
            ->getMock();
        $contact = $this->getMockBuilder('AppBundle\Service\Contact')
            ->disableOriginalConstructor()
            ->setMethods(['isValid'])
            ->getMock();
        $contact->post = $requestMock;
        $contact->em = $emMock;
        $emMock->expects($this->exactly(1))
             ->method('persist');
         $emMock->expects($this->exactly(1))
             ->method('flush');
         $contact->insertContact();

    }

}
