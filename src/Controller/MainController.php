<?php

// eb461407e359e0517cce14867f55f346
// src/Controller/MainController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/match-analysis', name: 'match_analysis')]
    public function matchAnalysis(Request $request): Response
    {
        $teamId = $request->query->get('team', '33');  // Default to team ID 33
        $season = $request->query->get('season', '2019');  // Default to season 2019
        $leagueId = $request->query->get('league', '39');  // Default to league ID 39

        $client = HttpClient::create();
        $response = $client->request('GET', 'https://v3.football.api-sports.io/teams/statistics', [
            'headers' => [
                'x-rapidapi-host' => 'v3.football.api-sports.io',
                'x-rapidapi-key' => 'eb461407e359e0517cce14867f55f346'
            ],
            'query' => [
                'season' => $season,
                'team' => $teamId,
                'league' => $leagueId
            ]
        ]);

        $data = $response->toArray();

        // Pobranie nazwy drużyny
        $teamResponse = $client->request('GET', 'https://v3.football.api-sports.io/teams', [
            'headers' => [
                'x-rapidapi-host' => 'v3.football.api-sports.io',
                'x-rapidapi-key' => 'eb461407e359e0517cce14867f55f346'
            ],
            'query' => [
                'id' => $teamId
            ]
        ]);

        $teamData = $teamResponse->toArray();
        $teamName = $teamData['response'][0]['team']['name'];

        return $this->render('main/match_analysis.html.twig', [
            'statistics' => $data,
            'teamId' => $teamId,
            'teamName' => $teamName,
            'season' => $season,
            'leagueId' => $leagueId
        ]);
    }

    #[Route('/player-analysis', name: 'player_analysis')]
    public function playerAnalysis(): Response
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

    #[Route('/teams', name: 'teams')]
    public function teams(Request $request): Response
    {
        $leagueId = $request->query->get('league', '39');  // Default to league ID 39
        $season = $request->query->get('season', '2019');  // Default to season 2019

        $client = HttpClient::create();
        $response = $client->request('GET', 'https://v3.football.api-sports.io/teams', [
            'headers' => [
                'x-rapidapi-host' => 'v3.football.api-sports.io',
                'x-rapidapi-key' => 'eb461407e359e0517cce14867f55f346'
            ],
            'query' => [
                'league' => $leagueId,
                'season' => $season
            ]
        ]);

        $teams = $response->toArray();

        return $this->render('main/teams.html.twig', [
            'teams' => $teams,
            'leagueId' => $leagueId,
            'season' => $season
        ]);
    }
}









