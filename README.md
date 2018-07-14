# coordinates #

Provide a standard way to store coordinates and coordinate collections.
The module also provide a utility class for calculations with coordinates.

# Usage #

Initialising the classes.
 
```

use Drupal\coordinates\Coordinate;
use Drupal\coordinates\CoordinateCollection;

$coordinate_1 = new Coordinate(51.363176, 4.473185));
$coordinate_2 = new Coordinate(52.392404, 4.467884));

$coordinate_collection = new CoordinateCollection([$coordinate_1, $coordinate_2]);

```

Using the utility class.

```

use Drupal\coordinates\Utility\CoordinateCalculator;

$distance = CoordinateCalculator::calculateDistance($coordinate_1, $coordinate_2);
$distances = CoordinateCalculator::calculateCollectionDistance($coordinate_collection);

```

# Release notes #

`1.0.0`
* Basic setup of the module.
* Provide coordinates and coordinates collection class.
* Provide utility class for calculations.
