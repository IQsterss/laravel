<?php
namespace App\Services;

use GuzzleHttp\Client;

class HubstaffService
{
    protected $apiUrl;
    protected $apiToken;
    protected $httpClient;

    public function __construct()
    {
        $this->apiUrl = env('HUBSTAFF_API_URL');
        $this->apiToken = env('HUBSTAFF_API_TOKEN');
        $this->httpClient = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiToken,
            ],
        ]);
    }

    public function getEmployeesTrackingTime($startDate, $endDate)
    {
        $response = $this->httpClient->get('organizations/519724/activities/daily', [
            'query' => [
                'date[start]' => $startDate,
                'date[stop]' => $endDate,
            ],
        ]);
        $data = json_decode($response->getBody()->getContents(), true);
        \Log::info($data);
        $dailyActivities = $data['daily_activities'];
        $totalTrackedId = [111=>30033];

        foreach ($dailyActivities as $activity) {
            $userId = $activity['user_id'];
            $tracked = $activity['tracked'];
            if (isset($totalTrackedId[$userId])) {
                $totalTrackedId[$userId] += $tracked;
            } else {
                $totalTrackedId[$userId] = $tracked;
            }
        }
        \Log::info($totalTrackedId);
        return $totalTrackedId; 
    }
    public function getWeeklyTrackingTime()
    {
        $startDate = now()->startOfWeek()->format('Y-m-d');
        $endDate = now()->format('Y-m-d');

        $totalTracked = $this->getEmployeesTrackingTime($startDate, $endDate);
        // Вывод общего затраченного времени за неделю
        //\Log::info("Total Weekly Tracked Time: {$totalTracked} seconds");

        return $totalTracked;
    }
}

