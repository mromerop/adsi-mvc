<?php
    $dir = scandir("documents/".$id);
    $result = null;

    foreach ($dir as $key => $value) {
        if (!in_array($value, array(".",".."))) {
            $result[] = $value;
        }
    }

    if ($result  != null) {
        foreach ($result as $value) {
            if (substr($value, -3) == 'pdf') {
                echo "<embed src='documents/$id/$value' type='application/pdf' width='100%' height='500px'>";
            } else {
                //echo "<img src='documents/$id/$value'>";
                echo "<embed type='image/jpg' src='documents/$id/$value'>";
                echo "<a href='documents/$id/$value' class='btn btn-warning'  download=''>Descargar</a>";
            }
        }
    } else {
        $this->index();
    }

