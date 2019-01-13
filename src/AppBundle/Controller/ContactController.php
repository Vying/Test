<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact", methods={"POST"})
     */
    public function addAction()
    {
        $contactForm = $this->get('contact.form');
        $result = $contactForm->submitContact();
        if($result == true){
           return new JsonResponse(array('result'=>'success', 'message' =>'Contact Form Submitted','200'));
        }else{
           return new JsonResponse(array('result'=>'error','message' =>$contactForm->error),'500');

        }
    }
}
