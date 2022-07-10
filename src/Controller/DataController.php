<?php

namespace App\Controller;


use App\Entity\Test;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class DataController extends AbstractController
{
    public function index()
    {
        $test = $this->getDoctrine()->getRepository(Test::class)->findAll();

        $data = [
            'halaman' => 'Data',
            'data' => $test
        ];

        return $this->render('data/view.html.twig', $data);
    }

    public function add(Request $post)
    {
        $test = new Test();
        $form = $this->createFormBuilder($test)
        ->add('nama', TextType::class)
        ->add('jenkel', TextType::class)
        ->add('alamat', TextareaType::class)
        ->add('add', SubmitType::class, ['label' => 'Add'])
        ->getForm();

        $form->handleRequest($post);

        // untuk form validation
        if ($form->isSubmitted() && $form->isValid()) {
            $test = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($test);
            $entityManager->flush();

            // untuk redirect
            return $this->redirectToRoute('data');
        }

        $data = [
            'halaman' => 'Tambah Data',
            'form' => $form->createView()
        ];

        return $this->render('data/add.html.twig', $data);
    }

    // public function post_add()
    // {
    //     $entityManager = $this->getDoctrine()->getManager();

    //     $product = new Test();
    //     $product->setNama('Keyboard');
    //     $product->setJenkel(1999);
    //     $product->setAlamat('Ergonomic and stylish!');

    //     // tell Doctrine you want to (eventually) save the Product (no queries yet)
    //     $entityManager->persist($product);

    //     // untuk query insert
    //     $entityManager->flush();

    //     // untuk response
    //     return new Response('simpan data berhasil');
    // }

    public function upd(Request $post, int $id)
    {
        $test = new Test();
        $test = $this->getDoctrine()->getRepository(Test::class)->find($id);

        $form = $this->createFormBuilder($test)
        ->add('nama', TextType::class)
        ->add('jenkel', TextType::class)
        ->add('alamat', TextareaType::class)
        ->add('upd', SubmitType::class, ['label' => 'Upd'])
        ->getForm();

        $form->handleRequest($post);

        // untuk form validation
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            // untuk redirect
            return $this->redirectToRoute('data');
        }

        $data = [
            'halaman' => 'Ubah Data',
            'form' => $form->createView()
        ];

        return $this->render('data/upd.html.twig', $data);
    }

    public function del(int $id)
    {
        $test = $this->getDoctrine()->getRepository(Test::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($test);
        $entityManager->flush();

        // untuk response
        // return new Response('hapus data berhasil');
        // untuk redirect
        return $this->redirectToRoute('data');
    }
}
