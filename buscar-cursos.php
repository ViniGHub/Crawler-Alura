<?php
require_once './vendor/autoload.php';

Teste::metodo();

use Vinighub\BuscadorCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;


$cliente = new Client(['base_uri' => 'https://www.alura.com.br']);
$crawler = new Crawler();

$buscador = new Buscador($cliente, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php', 'span.card-curso__nome');

foreach($cursos as $curso) {
    echo exibeMensagem($curso);
}

?>