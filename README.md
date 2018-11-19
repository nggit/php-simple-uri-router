<!-- <?php /* -->
# PHP Simple URI Router Quick Tour
**Tip:** Rename this `md` file to `php` to test it on your web server.
<!-- */ ?> -->

    <?php

    require 'path.class.php';

    $uri = $_SERVER['QUERY_STRING'];
    // Consider this uri: index.php?fruit.name/apple/banana/melon/orange.html
    // QUERY_STRING will be:
    $uri = 'fruit.name/apple/banana/melon/orange.html';

    $path = new Path();
    $path->parse($uri);

### Get the first uri segment
    echo $path->first(); // fruit.name
    echo '<br />';

### Get the first uri segment, before certain token
    echo $path->first('.?&'); // fruit
    echo '<br />';

### Get an uri segment after another segment
    echo $path->after('apple'); // banana
    echo '<br />';

### Get n uri segment after another segment
    echo $path->after('apple', 2); // banana/melon
    echo '<br />';

### Get all uri segment after another segment
    echo $path->after('apple', null); // banana/melon/orange.html
    echo '<br />';

### Get an uri segment after another segment, before certain token
    echo $path->after('melon', 1, '.?&'); // orange
    exit;

    ?>

Note that one or more empty uri segment will be skipped, eg. `apple//banana`, `$path->after('apple')` will return banana.
