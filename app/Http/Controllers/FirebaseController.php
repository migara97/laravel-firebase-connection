<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class FirebaseController extends Controller
{
    public $database;
    public $tableName;

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tableName = 'app-config';
        

    }
    public function update()
    {
        $appConfig = $this->database->getReference($this->tableName)->getValue();
        // dd($appConfig);
        // dd($appConfig['maintenance']['is-maintenance']);
        $currentStatus = $appConfig['maintenance']['is-maintenance'];
        $status =! $appConfig['maintenance']['is-maintenance'];
        $message = "";
        if ($status) {
            $message = "Sorry, We're Under Maintenance";
        } else {
            $message = "";
        }
        
        $updateData = [
            "maintenance" => [
                "is-maintenance" => $status,
                "maintenance-message" => $message,
            ]
        ];

        $update = $this->database->getReference($this->tableName)->update($updateData);
        return redirect()->back(); 
    }
}
