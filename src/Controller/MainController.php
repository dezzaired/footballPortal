<?php

// src/Controller/MainController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/match-analysis', name: 'match_analysis')]
    public function matchAnalysis(): Response
    {
        return $this->render('main/match_analysis.html.twig');
    }

    #[Route('/player-training', name: 'player_analysis')]
    public function playerTraining(): Response
    {
        return $this->render('main/player_analysis.html.twig');
    }

    #[Route('/news', name: 'news')]
    public function news(): Response
    {
        return $this->render('main/news.html.twig');
    }
    #[Route('/data-charts', name: 'data_charts')]
    public function dataCharts(): Response
    {
        return $this->render('main/data_charts.html.twig');
    }
}

