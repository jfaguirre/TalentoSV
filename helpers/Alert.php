<?php

class Alert {

    static public function success($title, $text){

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

    static public function info($title, $text){

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

    static public function error($title, $text){

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