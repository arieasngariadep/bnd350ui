<?php
namespace App\Helpers;

class Alert {
    public static function alertDanger($msg){
        if($msg){
        $alert = '<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="mdi mdi-close-circle mr-2"></i>'.$msg.'
                </div>';
        }else{
            $alert = false;
        }
        return $alert;
    }

    public static function alertSuccess($msg){
        if($msg){
        $alert = '<div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="mdi mdi-check-circle mr-2"></i>'.$msg.'
                </div>';
        }else{
            $alert = false;
        }
        return $alert;
    }
    public static function alertFail($msg){
        if($msg){
        $alert = '<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="mdi mdi-check-circle mr-2"></i>'.$msg.'
                </div>';
        }else{
            $alert = false;
        }
        return $alert;
    }

    public static function alertInfo($msg){
        if($msg){
        $alert = '<div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="mdi mdi-alert mr-2"></i>'.$msg.'
                </div>';
        }else{
            $alert = false;
        }
        return $alert;
    }
}