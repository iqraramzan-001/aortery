<?php
use App\Models\User;






if (!function_exists('getModelRef')) {
    function getModelRef()
    {
        $user = auth()->user();
        if ($user->type == User::TYPE_SUPPLIER) {
            return config('constant.model_ref.SUPPLIER');
        }

        if ($user->type ==User::TYPE_BUYER) {
            return config('constant.model_ref.BUYER');
        }


    }
}

if (!function_exists('getLoggedUserId')) {
    function getLoggedUserId()
    {
        $user = auth()->user();

        if (!$user) {
            throw new \Exception('User is not authenticated.');
        }

        if ($user->type == User::TYPE_SUPPLIER && $user->supplier) {
            return $user->supplier->id;
        }

        if ($user->type == User::TYPE_BUYER && $user->buyer) {
            return $user->buyer->id;
        }

    }

    if (!function_exists('getCategoryHierarchy')) {
        function getCategoryHierarchy($category)
        {
            $names = [];

            while ($category) {
                $names[] = $category->name;
                $category = $category->parent;
            }

            return implode(' → ', array_reverse($names));
        }
    }

}














