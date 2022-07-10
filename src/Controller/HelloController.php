<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
    public function index()
    {
        $number = random_int(0, 100);

        return $this->render('index.html.twig', [
            'halaman' => 'Index',
            'number' => $number,
        ]);
    }

    public function tentang()
    {
        return $this->render('tentang.html.twig', [
            'halaman' => 'Tentang',
        ]);
    }

    public function kontak()
    {
        return $this->render('kontak.html.twig', [
            'halaman' => 'Kontak',
        ]);
    }

    public function detail(int $id)
    {
        return new Response(
            '<html><body>ini adalah blog '.$id.'</body></html>'
        );
    }
}
