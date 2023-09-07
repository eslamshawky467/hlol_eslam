<?php

namespace App\Repositories;

use Exception;
use App\Services\FileService;
use App\Services\ClientService;
use App\Interfaces\CRUDInterface;
use App\Interfaces\ClientInterface;

class ClientRepository implements CRUDInterface, ClientInterface
{
    private $clientService;
    private $fileService;

    public function __construct(ClientService $clientService, FileService $fileService)
    {
        $this->clientService = $clientService;
        $this->fileService = $fileService;
    }
    public function GetById($id)
    {
        $client = $this->clientService->FindById($id);
        if ($client != null) {
            return $client;
        }
        throw new Exception("Item NOt FOund");

    }
    public function GetAlls()
    {

    }

    public function StoreNew($ClientData)
    {
        $clientDTOData = $this->clientService->CreateDTO($ClientData);


        $client = $this->clientService->CreateOrUpdate($clientDTOData);

        if ($ClientData->hasFile('client_image')) {

            $this->fileService->CreateFile($ClientData->file('client_image'), $client, 'clients', $client->name);

        }
        return $client;

    }

    public function Update($ClientData)
    {

        $ClientDTOData = $this->clientService->CreateDTO($ClientData);

        $Client = $this->clientService->FindById($ClientDTOData->client_id);

        if ($Client != null) {
            $updatedClient = $this->clientService->CreateOrUpdate($ClientDTOData);

            if ($ClientData->hasFile('client_image')) {
                $this->fileService->DeleteFile($updatedClient, 'uploads/clients/' . $Client->name);
                $this->fileService->CreateFile($ClientData->file('client_image'), $updatedClient, 'clients', $updatedClient->name);
            }
            return $updatedClient;
        }


        throw new Exception("Item NOt FOund");
    }
    public function Delete($id)
    {

    }

    public function ChangeStatus(int $id)
    {
        $client = $this->clientService->FindById($id);
        if ($client != null) {
            if ($client->status == 'inactive')
                $client->status = 'active';
            else {
                $client->status = 'inactive';

            }
            $client->save();
            return $client;
        }
        throw new Exception("Item NOt FOund");

    }
    public function ChangeStatusAll($Data)
    {
        foreach ($Data as $value) {
            $this->ChangeStatus($value);
        }
        return true;
    }
    public function ShowClient($id)
    {
        $client = $this->clientService->FindById($id);
        if ($client != null) {
            $client->load('file');
            return $client;
        }
        throw new Exception("Item NOt FOund");

    }

}
