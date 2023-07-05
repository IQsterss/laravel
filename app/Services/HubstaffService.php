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
//519724 my //54758
    public function getEmployeesTrackingTime($startDate, $endDate)
    {
        $response = $this->httpClient->get('organizations/54758/activities/daily', [
            'query' => [
                'date[start]' => $startDate,
                'date[stop]' => $endDate,
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        // \Log::info($data);
        $dailyActivities = $data['daily_activities'];
        $totalTrackedId = [];
        //$totalTrackedId = [111=>30033];

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

        return $totalTracked;
    }


    public function getNameID($userId)
    {
        $response = $this->httpClient->get("users/{$userId}");
        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);
        //\Log::info("project title", ["response" => $response]);
        //\Log::info($data);
        $userNameId=$data['user']['name'];
        return $userNameId;
    }
    

    public function getProjectName($projectId)
    {
        $response = $this->httpClient->get("organizations/54758/projects");
        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);
        $projects = $data['projects'];
        //\Log::info($projects);
        $projects_arr = [];
        $pro=0;

        foreach ($projects as $project) {
            $pro = $project['id'];
            $projectName = $project['name'];
            $projects_arr[$pro] = $projectName;
        }

        //\Log::info("Mapped Project IDs to Names: ", [$projects_arr]);
        //\Log::info($projects_arr['$projectId']);
        //\Log::info($projectId);
        return $projects_arr[$projectId];
        
    }

    public function getEmployeesTrackingTimeProject($startDate, $endDate)
    {
        $response = $this->httpClient->get('organizations/54758/activities/daily', [
            'query' => [
                'date[start]' => $startDate,
                'date[stop]' => $endDate,
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        //\Log::info($data);
        $dailyActivities = $data['daily_activities'];
        $totalTrackedId = [];
        

        foreach ($dailyActivities as $activity) {
            $projectId = $activity['project_id'];
            $tracked = $activity['tracked'];
            if (isset($totalTrackedId[$projectId])) {
                $totalTrackedId[$projectId] += $tracked;
            } else {
                $totalTrackedId[$projectId] = $tracked;
            }
        }
        \Log::info($totalTrackedId);
        return $totalTrackedId; 
    }

    
    public function getWeeklyTrackingTimeProject()
    {
        $startDate = now()->startOfWeek()->format('Y-m-d');
        $endDate = now()->format('Y-m-d');

        $totalTracked = $this->getEmployeesTrackingTimeProject($startDate, $endDate);

        return $totalTracked;
    }

}


