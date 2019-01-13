<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Contact
{
    /** @var \Symfony\Component\HttpFoundation\ParameterBag $post */
    var $post;
    /** @var EntityManager $em */
    var $em;
    /** @var ValidatorInterface $validation */
    var $validation;
    var $error;
    public function __construct(EntityManager $em, RequestStack $requestStack, ValidatorInterface $validation)
    {
        $this->post = $requestStack->getCurrentRequest()->request;
        $this->em = $em;
        $this->validation = $validation;
    }

    public function submitContact()
    {
        $validate = $this->isValid();
        if ($validate) {
            return $this->insertContact();
        }else{
            return $validate;
        }

    }
    public function insertContact()
    {
        $email = $this->post->get('email');
        $message = $this->post->get('message');
        $contactEntity = new \AppBundle\Entity\Contact();
        $contactEntity->setEmail($email)
            ->setMessage($message);
        $this->em->persist($contactEntity);
        $this->em->flush();
        return true;
    }


    public function isValid()
    {
        $value = array();
        $value['email'] = $this->post->get('email');
        $value['message'] =  $this->post->get('message');
        $violations = $this->validation->validate($value, $this->collection());
        if (0 !== count($violations)) {

            foreach($violations as $violation){
                $this->error [] = $violation->getMessage();
            }

            return false;
        }
        return true;
    }

    public function collection(){
        $collection = array();
        $collection['email'] = array(new NotBlank(array('message' => 'Email should not be blank')), new Email(array('message'=>'Email not valid')));
        $collection['message'] = array(new NotBlank(array('message' => 'Message should not be blank')), new Length(array('max' =>100, 'maxMessage' =>'Message cannot be greater than 100 characters')));
        return  new Collection($collection);
    }


}