# Download #
You can download latest release of Zend\_Image from [urlhere](http://example.com).

# Installation #
Zend\_Image doesn't use any of Zend Framework classes, so you can simply copy source
files into your project and start using it.

# Using #
## Basic usage ##
Simplest operation, that you can do with your image is a loading and getting
some image info, such as size. You can do it with this code:
```
$image = Zend_Image( 'fullmoon.jpg', new Zend_Image_Driver_Imagick );
echo 'Size: ' . $image->getWidth() . '×' . $image->getHeight();
```

Also, it's easy to make transformations:
```
$transformed = Zend_Image_Transform( $image );
$transformed->fitToWidth( 400 )->center()->middle()->crop( 50, 50 );
```

Printing text:
```
$texted = Zend_Image_Text( $image );
$texted->font( 'Verdana' )->size( 8 )->left( 10 )->top( 10 )->text( 'Uiiii!' );
```

Using overlays:
```
$overlayed = Zend_Image_Overlay( $image );
$overlayed->overlay( new Zend_Image( 'border.png' ) );
```

## Extended usage ##
You also can apply more than one filter due `apply()` function:
```
$image = new Zend_Image( 'ashes_and_snow.jpg', new Zend_Image_Driver_Imagick );
$image
    ->apply( new Zend_Image_Transform )->center()->crop( 0, -50 )
    ->apply( new Zend_Image_Color )->grayscale()
    ->apply( new Zend_Image_Text )
        ->bottom( 50 )->center()
        ->font( 'Arial' )->color( '#fff' )->background( '#000' )
        ->text( 'Fly the bird path' );
```

## Want some charts? ##
```
$image = new Zend_Image_Draw;
$image
    ->left( 20 )->bottom( 50 )->color( '#ebacca' )->border( '#000' )->rect( 20, -100 )
    ->left( 60 )->bottom( 50 )->color( '#006600' )->border( '#000' )->rect( 20, -50 )
    ->left( 100 )->bottom( 50 )->color( '#660000' )->border( '#000' )->rect( 20, -75 );
    ->left( 0 )->bottom( 50 )->color( 'black' )->horizontal()
    ->apply( new Zend_Image_Text )
        ->left( 20 )->bottom( 10 )->text( '2008' )
        ->left( 60 )->bottom( 10 )->text( '2009' )
        ->left( 100 )->bottom( 10 )->text( '2010' );
```

```
$image = new Zend_Image_Draw;
$image
    ->center()->middle()
        ->color( 'brown' )->circle()
        ->color( 'linen' )->pie( -30, 30 )
    ->apply( new Zend_Image_Text )
        ->center()->bottom( 10 )->text( 'Diagrams alike pacman' );
```