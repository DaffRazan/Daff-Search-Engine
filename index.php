<?php
$command = escapeshellcmd('python3 code/Query.py ' . $_POST['t'] . ' ' . $_POST['s']);
$output = shell_exec($command);
//$datas = json_decode($output, true);
$contentPart = json_decode($output, true);
for ($i = 0; $i < count($contentPart); $i++) :
    $syntax = shell_exec("cat data/crawling/" . $contentPart[$i]['doc']);
    $datas = explode("\n", $syntax);
    $contentPart[$i]['title'] = $datas[0];
    $contentPart[$i]['content'] = '';
    for ($j = 1; $j < count($datas); $j++) {
        $contentPart[$i]['content'] .= $datas[$j];
    }
endfor;
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">

    <title>DAFF SEARCH ENGINE</title>
</head>

<body>
    <div class="search-engine">
        <h1 style="color: white">DAFF Search Engine</h1>
        <form action="" method="POST">
            <input type="text" name="s" value="<?php echo htmlspecialchars($_POST['s']); ?>" placeholder="Search something... ">
            <input type="number" name="t" value="<?php echo htmlspecialchars($_POST['t']); ?>" placeholder="Number displayed...">
            <button class="btn btn-sm btn-outline-light ml-2" type=" submit">Search</button>
        </form>

        <?= $contentPart ?>
        <?php foreach ($contentPart as $data) : ?>

            <a class="link" href="<?= $data['url'] ?>"><?= $data['title'] ?></a>
            <br>
            <div class="url-link">
                <?= $data['url'] ?>
            </div>
            <div class="content">
                <?= $data['content'] ?>
            </div>
            <br>
        <?php endforeach; ?>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>