<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <link href="result.css?<?=filemtime("result.css")?>" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title id="title">Citations</title>
    <script>
        var citlink = "<?php echo $_GET["citlink"]; ?>";
        var urlfinal = encodeURIComponent(citlink);
        fetch('http://localhost:3000/crawl.json?start_requests=true&spider_name=page2&url=' + urlfinal)
        // fetch('local2.json')
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                console.log(data);
                a=Object.keys(data.items).length;
                console.log(a);
                document.getElementById("loader").className = ".d-none";
                document.getElementById("div1").insertAdjacentHTML('beforeend', '<table class="table table-striped table-hover"><thead class="thead-dark"><tr><th scope="col">#</th><th scope="col">Title</th><th scope="col">Author</th></tr></thead><tbody id="cittable"></tbody></table>');
                for (var i = 0; i < a; i++) {
                    j=i+1;
                    const element = data.items[i];
                    document.getElementById("cittable").insertAdjacentHTML('beforeend', ' <tr> <th scope="row"> ' + j + '</th> <td>' + element.title + '</td> <td>' + element.authors + '</td></th> </tr>');
                }
            });
    </script>
</head>

<body>
    <nav class="navbar sticky-top navbar-dark bg-dark">
        <a href="main.php" class="h3">Google Scholar API</a>
    </nav>
    <div class="container-fluid">
        <div id="div1" class="row h-100 justify-content-center">
        <div class="spinner-border text-success" style="width: 5rem; height: 5rem;" role="status" id="loader">
            <span class="sr-only" id="tilal">Loading...</span>
        </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>