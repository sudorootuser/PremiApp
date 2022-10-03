<?php
if ($ajaxRequest) {
    require_once '../config/SERVER.php';
} else {
    require_once './config/SERVER.php';
}

class mainModel
{
    protected static function connect()
    {
        $connection = new PDO(SGBD, USER, PASS);
        $connection->exec("SET CHARACTER SET utf8");

        return $connection;
    }

    /*------------ Function to execute simple queries -----------*/
    protected static function execute_simple_queries($query)
    {
        $sql = self::connect()->prepare($query);
        $sql->execute();

        return $sql;
    }

    /*------------ Function to execute simple queries -----------*/
    public function encrypt_decrypt($action, $string)
    {
        $outPut = FALSE;
        $key = hash('sha256', SECRET_IV);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);


        if ($action == 'encrypt') {
            $outPut = openssl_encrypt($string, METHOD, $key, 0, $iv);
            $outPut = base64_encode($outPut);
        } elseif ($action == 'decrypt') {
            $outPut = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        }

        return $outPut;
    }

    /*------------ Function to generate random codes -----------*/

    protected static function generate_random_code($word, $lengh, $number)
    {
        for ($i = 1; $i <= $lengh; $i++) {
            $ramdom = rand(0, 9);
            $word .= $ramdom;
        }
        return $word . "-" . $number;
    }

    /*------------ Chain clear function -----------*/
    protected static function clear_chain($chain)
    {
        $chain = trim($chain);
        $chain = stripslashes($chain);
        $chain = str_replace("<script>", "", $chain);
        $chain = str_replace("/<script>", "", $chain);
        $chain = str_replace("<script src>", "", $chain);
        $chain = str_replace("<script type=>", "", $chain);
        $chain = str_replace("SELECT * FROM", "", $chain);
        $chain = str_replace("DELETE INTO", "", $chain);
        $chain = str_replace("INSERT INTO", "", $chain);
        $chain = str_replace("DROP TABLE", "", $chain);
        $chain = str_replace("DROP DATABASE", "", $chain);
        $chain = str_replace("TRUNCATE TABLE", "", $chain);
        $chain = str_replace("SHOW TABLES", "", $chain);
        $chain = str_replace("SHOW DATABASES", "", $chain);
        $chain = str_replace("<?php", "", $chain);
        $chain = str_replace("?>", "", $chain);
        $chain = str_replace("--", "", $chain);
        $chain = str_replace(">", "", $chain);
        $chain = str_replace("<", "", $chain);
        $chain = str_replace("[", "", $chain);
        $chain = str_replace("]", "", $chain);
        $chain = str_replace("^", "", $chain);
        $chain = str_replace("==", "", $chain);
        $chain = str_replace(";", "", $chain);
        $chain = str_replace("::", "", $chain);
        $chain = stripslashes($chain);
        $chain = trim($chain);

        return $chain;
    }

    /*------------ Model function to verify data -----------*/
    public static function verify_data($filter, $chain)
    {
        if (preg_match("/^" . $filter . "$/", $chain)) {
            return false;
        } else {
            return true;
        }
    }

    /*------------ Verify date-----------*/
    protected static function verify_date($date)
    {
        $values = explode('-', $date);

        if (count($values) == 3 && checkdate($values[1], $values[2], $values[0])) {
            return true;
        } else {
            return false;
        }
    }

    /*------------ Table pager-----------*/
    protected static function table_parger($page, $Npages, $url, $buttons)
    {
        $table = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';

        //Condictional to enable pagination button

        if ($page == 1) {
            $table .= '<li class="page-item disabled><a class="page-link"><i class="fas fa angle-double-left"></i></a></li>';
        } else {
            $table .= '
            <li class="page-item"><a class="page-link" href="' . $url . '1/"><i class ="fas fa angle-double-left"></i></a></li>
            <li class="page-item"><a class="page-link" href="' . $url . ($page - 1) . '/"Angerior</a></li>';
        }

        //Numeric pagination
        $ci = 0;
        for ($i = $page; $i <= $Npages; $i++) {
            # code
            if ($ci >= $buttons) {
                break;
            }
            if ($page == $i) {
                $table .= '<li class="page-item"><a class="page-link active" href="' . $url . $i . '/">' . $i . '</a></li>';
            } else {
                $table .= '<li class="page-item"><a class="page-link" href="' . $url . $i . '/">' . $i . '</a></li>';
            }
            $ci++;
        }

        //Condictional to end of pagination
        if ($page == $Npages) {
            $table .= '<li class="page-item disabled><a class="page-link"><i class="fas fa angle-double-left"></i></a></li>';
        } else {
            $table .= '
        <li class="page-item">< class="page-link" href="' . $url . ($page + 1) . '/">Siguiente</a></li>
        <li class="page-item"><a class="page-link" href="' . $url . $Npages . '/"><i class="fas fa-angle-double-right"></i></a></li>';
        }
        $table .= '</ul></nav>';

        return $table;
    }
}
