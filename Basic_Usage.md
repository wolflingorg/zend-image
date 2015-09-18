`Zend_Image` provides basic functionality, that allows you loading, saving and extracting some info, such as width and height.

First of all, you have to choose image driver to work with. There are two drivers now:
  1. `Zend_Image_Driver_Imagick` and
  1. `Zend_Image_Driver_Gd2`.

New copy of `Zend_Image_Driver` passed in second argument of constructor.

## Creating new image ##
`Zend_Image::__construct( null, $driver );`

Creates a new empty image.

Example:
```
$image = new Zend_Image( null, new Zend_Image_Driver_Imagick );
```

## Loading image ##
`Zend_Image::__construct( $source, $driver );`

If you want load image from filename, you have to specify `$source` as existing filename.
Example:
```
$stars = new Zend_Image( 'stars.jpg', new Zend_Image_Driver_Imagick );
```

## Saving image ##
`Zend_Image::save( $filename );`

Saving current version of image to the `$filename`.

Example:
```
$image->save( 'heaven.jpg' );
```


## Retrieving binary image contents ##
`Zend_Image::getImage();`

Method returns binary content of image.

Example:
```
header('Content-Type: image/jpeg');
echo $image->getImage();
```

## Metrics ##
`Zend_Image::getWidth();`

Retrieving width of image.

`Zend_Image::getHeight();`

Retrieving height of image.

Example:
```
$width = $image->getWidth();
$height = $image->getHeight();
```