<?php

namespace App\helpers;

class Alert {


    static public function success(string $title, string $text){

        echo "
            <script>
                Swal.fire({
                title: '$title',
                text: '$text',
                icon: 'success'
                });
            </script>        
        ";        
    }

    static public function info(string $title, string $text){

        echo "
            <script>
                Swal.fire({
                title: '$title',
                text: '$text',
                icon: 'info'
                });
            </script>        
        ";        
    }

    static public function error(string $title, string $text){

        echo "
            <script>
                Swal.fire({
                title: '$title',
                text: '$text',
                icon: 'error'
                });
            </script>        
        ";        
    }


}