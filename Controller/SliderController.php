<?php

namespace Msi\Bundle\PaintBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SliderController extends ContainerAware
{
    public function showAction(Request $request)
    {
        $slider = $this->container->get('msi_paint.slider_manager')->getFindByQueryBuilder(
            array('a.name' => $request->attributes->get('name'), 'a.enabled' => true, 'st.published' => true),
            array('a.slides' => 's', 's.translations' => 'st'),
            array('s.position' => 'ASC')
        )->getQuery()->getOneOrNullResult();

        if (!$slider) {
            throw new NotFoundHttpException();
        }

        return $this->container->get('templating')->renderResponse('MsiPaintBundle:Slider:model_a.html.twig', array('slider' => $slider));
    }
}
