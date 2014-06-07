<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// -- HOMEPAGE ----------------------------------------------------------------
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig', array('config' => $app['config'],'site' => $app['site'],'asoc' => $app['asoc'],'agenda' => $app['agenda']));
})
->bind('homepage')
;

// -- CONTACTO ----------------------------------------------------------------
$app->match('/contacto', function (Request $request) use ($app) {
    $form = $app['form.factory']->createBuilder('form')
        ->add('nombre')
        ->add('email')
        ->add('comentarios', 'textarea', array(
            'required' => false,
            'label' => 'Comentarios (opcional)'
        ))
        ->getForm();
    
    return $app['twig']->render('contacto.twig', array('form' => $form->createView(),'config' => $app['config'],'site' => $app['site'],'asoc' => $app['asoc'],'agenda' => $app['agenda']));
})
->bind('contacto');

// -- PAGE ----------------------------------------------------------------
$app->get('/{slug}', function ($slug) use ($app) {
    $page = null;
    
    foreach ($app['site']['pages'] as $site){
        if ($site['slug'] == $slug){
            $page = $site;
            continue;
        }
    }
        
    if ($page == null) {
        $app->abort(404, "No existe la pagina");
    }

    return $app['twig']->render('page.twig', array('page' => $page, 'config' => $app['config'],'site' => $app['site'],'asoc' => $app['asoc'],'agenda' => $app['agenda']));
})
->bind('page')
;

// -- PÁGINAS DE ERROR --------------------------------------------------------
$app->error(function (\Exception $e, $code) use ($app) {
    $paginaError = 404 == $code ? '404.twig' : '500.twig';

    return $app['twig']->render($paginaError, array('mensaje' => $e->getMessage(), 'page' => $page, 'config' => $app['config'],'site' => $app['site'],'asoc' => $app['asoc'],'agenda' => $app['agenda']));
});
