<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="result.css?<?=filemtime("result.css")?>" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title id="scholartitle"></title>
    <script>
        var uid = "<?php echo $_GET["uid"]; ?>";
        url1 = "https://scholar.google.com/citations?user=" + uid;
        var urlfinal = encodeURIComponent(url1);
        fetch('http://localhost:3000/crawl.json?start_requests=true&spider_name=page1&url=' + urlfinal)
            // fetch('local.json')
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                console.log(data);
                a = Object.keys(data.items).length;
                document.getElementById("scholartitle").innerText = data.items[0].name;
                document.getElementById("loader").className = ".d-none";
                document.getElementById("div1").insertAdjacentHTML('beforeend', '<div id="userdet"><div id="imgdiv"><img src=' + data.items[0].imgsrc + ' alt="Image not found" class="uimg"></div><div id="namediv"><p class="h5"><strong>' + data.items[0].name + '</strong></p></div></div>');
                document.getElementById("div1").insertAdjacentHTML('beforeend', '<table class="table table-striped table-hover" id="papertable"> <thead class="thead-dark"> <tr> <th scope="col">#</th> <th scope="col">Title</th> <th scope="col">Year</th> <th scope="col">No. of citations</th> </tr> </thead> <tbody id="pprtable"> </tbody> </table>');
                for (var i = 1; i < a; i++) {
                    const element = data.items[i];
                    document.getElementById("pprtable").insertAdjacentHTML('beforeend', ' <tr> <th scope="row">' + i + '</th> <td> <form action="citresult.php" method="get"><button type="submit" name="citlink" id="citlinkbtn" value=' + element.citation_link + ' >' + element.title + '</button></form></td> <td>' + element.year + '</td> <td>' + element.no_of_citation + '</td> </tr>');
                }
            });

    </script>
</head>

<body>
    <nav class="navbar sticky-top navbar-dark bg-dark">
        <a href="main.php" class="h3">Google Scholar API</a>
    </nav>
    <div class="container-fluid">
        <div id="div1" class="row h-100 align-items-center justify-content-center" >
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