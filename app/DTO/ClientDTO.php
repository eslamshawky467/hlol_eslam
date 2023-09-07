<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;

class ClientDTO
{

    public $client_id;
    public $client_name;
    public $device_token;
    public $email;
    public $gender;

    /*********************** */
    public $client_phone_number;
    public $client_image;
    public $is_registered;
    public $status;

    public function __construct(
        $client_id,
        $client_name,
        $device_token,
        $email,
        $gender,
        $client_phone_number,
        $client_image,
        $is_registered,
        $status
    ) {
        $this->client_id = $client_id;
        $this->email = $email;
        $this->client_name = $client_name;
        $this->device_token = $device_token;
        $this->gender = $gender;
        $this->client_phone_number = $client_phone_number;
        $this->client_image = $client_image;
        $this->is_registered = $is_registered;
        $this->status = $status;
    }
}
