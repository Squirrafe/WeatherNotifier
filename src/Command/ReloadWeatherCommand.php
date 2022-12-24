<?php

namespace App\Command;

use App\Factory\WeatherModelFactory;
use App\Util\Config;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * @phpstan-import-type OpenWeatherJsonFull from WeatherModelFactory
 */
#[AsCommand(name: 'app:reload-weather', description: 'Loads weather data from OpenWeather API')]
class ReloadWeatherCommand extends Command
{
    public function __construct(
        private readonly Config $config,
        private readonly HttpClientInterface $httpClient,
        private readonly WeatherModelFactory $weatherModelFactory,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = $this->httpClient->request(
            'GET',
            $this->config->openWeatherApiUrl,
            [
                'query' => [
                    'appid' => $this->config->openWeatherApiToken,
                    'lat' => 50.809015,
                    'lon' => 19.116160,
                    'exclude' => 'minutely',
                ],
            ],
        );

        if ($response->getStatusCode() === Response::HTTP_OK) {
            /** @var OpenWeatherJsonFull $json */
            $json = json_decode($response->getContent(), associative: true);
            $current = $this->weatherModelFactory->buildFromOpenWeatherJson($json['current']);
            $hourly = array_map(
                fn (array $hour) => $this->weatherModelFactory->buildFromOpenWeatherJson($hour),
                $json['hourly'],
            );
            $daily = array_map(
                fn (array $day) => $this->weatherModelFactory->buildFromOpenWeatherJson($day),
                $json['daily'],
            );

            $output->writeln('Current time: ' . $current->timestamp->format('Y-m-d H:i:s'));
            $output->writeln('Hourly count: ' . count($hourly));
            $output->writeln('Daily count: ' . count($daily));
        }

        return self::SUCCESS;
    }
}
