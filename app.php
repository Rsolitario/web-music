<?php
$path = '\music';
$direccion = 'music/';

function listadoDirectorio($directorio){
    $listado = scandir($directorio);
    unset($listado[array_search('.', $listado, true)]);
    unset($listado[array_search('..', $listado, true)]);
    if (count($listado) < 1){
        return 1;
    }
    foreach ($listado as $elemento){
        global $direccion;
        if (!is_dir($directorio.'/'.$elemento)){
            echo '<head>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/jplayer/jquery.jplayer.min.js" integrity="sha512-g0etrk7svX8WYBp+ZDIqeenmkxQSXjRDTr08ie37rVFc99iXFGxmD0/SCt3kZ6sDNmr8sR0ISHkSAc/M8rQBqg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                </head>';
            echo '<li><a href="'.$directorio.'/'.$elemento.'">'.$elemento.'</a></li>';
            $ext = pathinfo($elemento, PATHINFO_EXTENSION);
            if ($ext=='mp4'){
                echo '<video width="400px" height="400px" controls>
                    <source src="'.$direccion.$elemento.'" type="video/'.$ext.'">
                    Your browser does not support the video tag.
                </video>';
            }
            else{
                echo '<audio controls>
                    <source src="'.$direccion.$elemento.'" type="audio/'.$ext.'">
                    Your browser does not support the video tag.
                </audio>';
            }
            
        }
        if (is_dir($directorio.'/'.$elemento)){
            echo '<li class="open-dropdown">'.$elemento.'</li>';
            echo '<ul class="dropdown d-none">';
                listadoDirectorio($directorio.'/'.$elemento);
            echo '</ul>';
        }
    }
}
listadoDirectorio(__DIR__.$path);
