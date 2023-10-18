<?php 
$user = 'root';
$password = 'root';
$db = 'poisc';
$host = 'localhost';
$port = 3306;

$link = mysqli_init();
$success = mysqli_real_connect( $link, $host, $user, $password, $db, $port );

mysqli_query('SET NAMES utf8');

function search ($query) 
{ 
    $query = trim($query); 
    $query = mysqli_real_escape_string($query);
    $query = htmlspecialchars($query);

    if (!empty($query)) 
    { 
        if (strlen($query) < 3) {
            $text = '<p>Слишком короткий поисковый запрос.</p>';
        } else if (strlen($query) > 128) {
            $text = '<p>Слишком длинный поисковый запрос.</p>';
        } else { 
            $q = "SELECT `page_id`, `title`, `desc`, `title_link`, `category`, `uniq_id`
                  FROM `table_name` WHERE `text` LIKE '%$query%'
                  OR `title` LIKE '%$query%' OR `meta_k` LIKE '%$query%'
                  OR `meta_d` LIKE '%$query%'";

            $result = mysqli_query($q);

            if (mysqli_affected_rows() > 0) { 
                $row = mysqli_fetch_assoc($result); 
                $num = mysqli_num_rows($result);

                $text = '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';

                do {
                    // Делаем запрос, получающий ссылки на статьи
                    $q1 = "SELECT `link` FROM `table_name` WHERE `uniq_id` = '$row[page_id]'";
                    $result1 = mysqli_query($q1);

                    if (mysqli_affected_rows() > 0) {
                        $row1 = mysqli_fetch_assoc($result1);
                    }

                    $text .= '<p><a> href="'.$row1['link'].'/'.$row['category'].'/'.$row['uniq_id'].'" title="'.$row['title_link'].'">'.$row['title'].'</a></p>
                    <p>'.$row['desc'].'</p>';

                } while ($row = mysqli_fetch_assoc($result)); 
            } else {
                $text = '<p>По вашему запросу ничего не найдено.</p>';
            }
        } 
    } else {
        $text = '<p>Задан пустой поисковый запрос.</p>';
    }

    return $text; 
} 
?>\
<?php 
if (!empty($_POST['query'])) { 
    $search_result = search ($_POST['query']); 
    echo $search_result; 
}
?>