<?php

namespace App\Services;

use App\DTO\ClientDTO;
use App\Interfaces\ServicesInterface;
use App\Models\Client;

class ClientService implements ServicesInterface
{

    public function CreateDTO($ClientData)
    {
        return new ClientDTO(
            $ClientData->input('id') ?? 0,
            $ClientData->input('client_name'),
            $ClientData->input('device_token'),
            $ClientData->input('email'),
            $ClientData->input('gender'),
            $ClientData->input('client_phone_number'),
            $ClientData->input('client_image'),
            $ClientData->input('is_registered'),
            $ClientData->input('status'),
        );

    }
    public function CreateOrUpdate($ClientData): Client
    {
        $newClient = Client::updateOrCreate(
            ['id' => $ClientData->client_id],
            [
                'name' => $ClientData->client_name,
                'device_token' => $ClientData->device_token,
                'email' => $ClientData->email,
                'gender' => $ClientData->gender,
                'phone_number' => $ClientData->client_phone_number,
                'image' => $ClientData->client_image,
                'is_registered' => $ClientData->is_registered,
                'status' => $ClientData->status,

            ]
        );
        return $newClient;
    }

    public function FindById($id)
    {
        $client = Client::find($id);

        return $client;
    }

}
