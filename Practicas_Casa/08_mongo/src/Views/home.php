    <ul>
        <?php        
        foreach($deps as $dep){
            /*echo "<li>Id: {$dep['dept_no']} Nombre: {$dep['dnombre']}, Localidad: {$dep['loc']}<br>" .
                    "<a href=\"/eliminarDept?dept_no={$dep['dept_no']}\">Eliminar</a>  " . 
                    "<a href=\"/modificarDept?dept_no={$dep['dept_no']}\">Modificar</a>" .
                "</li>";*/
                require __DIR__ . "/../Views/card_dept.php";
        }
        ?>
    </ul>

