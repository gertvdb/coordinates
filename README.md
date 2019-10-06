# coordinates #

[![Build Status](https://travis-ci.org/gertvdb/coordinates.svg?branch=8.x-1.x)](https://travis-ci.org/gertvdb/coordinates)
[![Coverage Status](https://coveralls.io/repos/github/gertvdb/coordinates/badge.svg?branch=8.x-1.x)](https://coveralls.io/github/gertvdb/coordinates?branch=8.x-1.x)

Provide a standard way to store coordinates and coordinate collections.

# Usage #

Initialising the classes.
 
```

use Drupal\coordinates\Coordinate;
use Drupal\coordinates\CoordinateCollection;

$coordinate_1 = new Coordinate(51.363176, 4.473185));
$coordinate_2 = new Coordinate(52.392404, 4.467884));

$coordinate_collection = new CoordinateCollection([$coordinate_1, $coordinate_2]);

```
