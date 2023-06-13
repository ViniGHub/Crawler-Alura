<?php

namespace Vinighub\BuscadorCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private ClientInterface $HttpCliente;

    private Crawler $crawler;

    public function __construct(ClientInterface $HttpCliente, Crawler $crawler)
    {
        $this->HttpCliente = $HttpCliente;
        $this->crawler = $crawler;
    }

    public function buscar(string $url, string $filtro): array
    {
        $resposta = $this->HttpCliente->request('GET', $url);
        $html = $resposta->getBody();

        $this->crawler->addHtmlContent($html);

        $cursos = [];
        $elementosCursos = $this->crawler->filter($filtro);
        foreach ($elementosCursos as $elemento) {
            $cursos[] = $elemento->textContent . PHP_EOL;
        }


        return $cursos;
    }
}
