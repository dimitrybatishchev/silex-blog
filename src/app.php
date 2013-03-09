<?php

use Symfony\Component\HttpFoundation\Request;

$app->get('/', function() use($app){
    $posts = $app['db.orm.em']->getRepository('Blog\Entity\Post')->findAll();
    return $app['twig']->render('index.twig', array('posts'  =>  $posts));
})
->bind('homepage');

$app->match('/add', function (Request $request) use ($app) {   
    $form = $app['form.factory']->createBuilder('form')
            ->add('title')
            ->add('annotation')
            ->add('content', 'textarea')
            ->getForm();
    
    if ('POST' == $request->getMethod()) {
        $form->bind($request);

        if ($form->isValid()) {
            $data = $form->getData();
            
            $post = new Blog\Entity\Post();
            
            $token = $app['security']->getToken();
            if (null !== $token) {
                $user = $token->getUser();
            }
    
            $post->setOwner($user);
            $post->setTitle($data['title']);
            $post->setAnnotation($data['annotation']);
            $post->setContent($data['content']);
            $post->setCreatedAt(new \DateTime());
            
            $app['db.orm.em']->persist($post);
            $app['db.orm.em']->flush();
            
            return $app->redirect('/');
        }
    }
    return $app['twig']->render('add.twig', array('form' => $form->createView()));
})
->bind('post_create');

$app->match('/register', function (Request $request) use ($app) {
    $data = array();
    $form = $app['form.factory']->createBuilder('form', $data)
        ->add('content')
        ->add('password')
        ->add('password-repeated')
        ->getForm();
    
    if ('POST' == $request->getMethod()) {
        $form->bind($request);

        if ($form->isValid()) {

        }
    }
    return $app['twig']->render('add.twig', array('form' => $form->createView()));
})
->bind('registration');

$app->get('/post/{id}', function ($id) use ($app) {
    $post = $app['db.orm.em']->find('Blog\Entity\Post', $id);
    
    $commentForm = $app['form.factory']->createBuilder('form')
        ->add('content')
        ->getForm();
    
    return $app['twig']->render('post-detail.twig', array(
        'commentForm' => $commentForm->createView(),
        'post' => $post,
    ));
})
->bind('post_details');

$app->post('/post/{id}/comment/add', function ($id) use ($app) {
    $post = $app['db.orm.em']->find('Blog\Entity\Post', $id);
    $comment = new Blog\Entity\Comment();
    
    return $app['twig']->render('post-detail.twig', array(
        'commentForm' => $commentForm->createView(),
        'post' => $post,
    ));
})
->bind('comment_add');

$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.twig', array(
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})
->bind('login');

return $app;