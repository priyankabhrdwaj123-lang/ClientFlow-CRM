<?php

namespace App\Controllers;

use App\Models\CalendarEventModel;

class CalendarController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')
                ->with('error', 'Please login to access the calendar.');
        }

        $eventModel = new CalendarEventModel();

        $data['events'] = $eventModel
            ->orderBy('event_date', 'ASC')
            ->orderBy('event_time', 'ASC')
            ->findAll();

        return view('workspace/calendar', $data);
    }



    public function create()
    {
        // Check login
        if (!session()->get('isLoggedIn')) {
            return $this->response->setStatusCode(401)
                ->setJSON([
                    'success' => false,
                    'message' => 'Please login first.'
                ]);
        }

        // Validation rules
        $rules = [
            'title' => 'required|max_length[255]',
            'event_date' => 'required|valid_date[Y-m-d]',
            'event_time' => 'required',
            'description' => 'permit_empty'
        ];

        // Read JSON data sent by JavaScript
        $payload = $this->request->getJSON(true);

        if (!is_array($payload)) {
            return $this->response->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Invalid request data.'
                ]);
        }

        // Validate input
        if (!$this->validateData($payload, $rules)) {
            return $this->response->setStatusCode(422)
                ->setJSON([
                    'success' => false,
                    'message' => 'Please check the event details.',
                    'errors' => $this->validator->getErrors()
                ]);
        }

        // Insert event into database
        $eventModel = new \App\Models\CalendarEventModel();

        $eventId = $eventModel->insert([
            'title' => trim($payload['title']),
            'event_date' => $payload['event_date'],
            'event_time' => $payload['event_time'],
            'description' => trim($payload['description'] ?? '')
        ]);

        // Check whether insert succeeded
        if ($eventId === false) {
            return $this->response->setStatusCode(500)
                ->setJSON([
                    'success' => false,
                    'message' => 'Unable to save event. Please try again.'
                ]);
        }

        // Success response
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Event saved successfully.',
            'event_id' => $eventId
        ]);
    }
}
