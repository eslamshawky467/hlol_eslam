<?php

namespace App\Traits;

trait WebResponce
{

    public function success($message, $route)
    {
        return redirect()->route($route)
            ->with('success', $message);
    }

    public function error($message, $route)
    {
        return redirect()->route($route)
            ->with('danger', $message);
    }
}