# Introduction #
First, you need to load image:
```
$transform = new Zend_Image_Transform( 'worms.jpg', new Zend_Image_Driver_Gd );
```

Or, you can use this syntax (usable sometimes):
```
$image = new Zend_Image( 'worms.jpg', new Zend_Image_Driver_Gd );
$transform = new Zend_Image_Transform( $image );
```

# Resizing #
You can resize image as you wish with following method:

`Zend_Image_Transform::resize( $newWidth, $newHeight );`

Example (`$transform` was created earlier):
```
$transform->resize( 100, 200 );
```

# Cropping #
`Zend_Image_Transform::crop( $newWidth, $newHeight );`

By default, this api crop from top left corner of source image. How to fix it, we show later.

This example shows, how to crop a 50x50 area from source image (source _must be_ greater, than 50x50):
```
$transform->crop( 50, 50 );
```

## Extended cropping ##
Naturally, you can crop from other locations of source image. This functionality can be done with following methods:
  * `Zend_Image_Transform::left( $leftOffset = 0 );`
> Sets a offset from left side of source image to top left corner of part that being cropped;
  * `Zend_Image_Transform::top( $topOffset = 0 );`
> Sets a offset from top side of source image to top left corner of part that being cropped;
  * `Zend_Image_Transform::right( $leftOffset = 0 );`
> Sets a offset from right side of source image to top left corner of part that being cropped;
  * `Zend_Image_Transform::bottom( $leftOffset = 0 );`
> Sets a offset from bottom side of source image to top left corner of part that being cropped;
  * `Zend_Image_Transform::middle();`
> Position a crop-part at middle (vertically) of image.
  * `Zend_Image_Transform::center();`
> Position a crop-part at center (horizontally) of image.

**NOTE**: you can use fluent interface to set up crop position, such as `->left( 10 )->top( 20 )`, but you can not set two opposite methods simultaneously, such as `->left( 10 )->right( 10 )`.
Also, you must call `Zend_Image_Transform::reset()` method to set up new crop point.

## Negative values for crop ##

# Fits #
## Fit into frame ##
## Fit outer of frame ##