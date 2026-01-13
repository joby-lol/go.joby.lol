<!DOCTYPE html>
<html>

    <head>
        <title>Joby's shortlink directory</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 2em;
                background-color: #f9f9f9;
            }
            h1 {
                color: #333;
            }
            ul {
                list-style-type: none;
                padding: 0;
            }
            li {
                margin: 0.5em 0;
            }
            a {
                text-decoration: none;
                color: #1a0dab;
            }
            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>

    <body>
        <h1>Joby's shortlink directory</h1>
        <p>
            This is my URL shortener directory. Below is a list of my shortlinks. To see my main site visit <a href="https://joby.lol">joby.lol</a>.
        </p>
        <ul>
            <?php

            while (($line = fgets($file)) !== false) {
                $line = explode(',', $line);
                $line = array_map(trim(...), $line);
                echo '<li><a href="/' . htmlspecialchars($line[0]) . '"><strong>' . htmlspecialchars($line[0]) . '</strong>: ' . htmlspecialchars($line[1]) . '</a></li>';
            }
            fclose($file);
            ?>
        </ul>
    </body>

</html>