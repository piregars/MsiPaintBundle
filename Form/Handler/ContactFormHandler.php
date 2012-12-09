<?php

namespace Msi\Bundle\PaintBundle\Form\Handler;

class ContactFormHandler
{
    protected $request;
    protected $templating;
    protected $mailer;

    public function __construct($request, $templating, $mailer)
    {
        $this->request = $request;
        $this->templating = $templating;
        $this->mailer = $mailer;
    }

    public function process($form)
    {
        if ($this->request->getMethod() === 'POST') {
            $form->bindRequest($this->request);

            if ($form->isValid()) {
                $this->onSuccess($form);

                return true;
            }
        }

        return false;
    }

    protected function onSuccess($form)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Formulaire de contact')
            ->setFrom('noreply@paulineveilleux.com')
            ->setTo('alexisjoubert@groupemsi.com')
            ->setBody($this->templating->render('MsiPaintBundle:Contact:email.html.twig', array('form' => $form->getData())), 'text/html')
        ;
        $this->mailer->send($message);
    }
}
