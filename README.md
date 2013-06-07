# php-css

A simple PHP class for easily generating cross-browser CSS rules.

## Example

	<?
		echo CSS::Transform("rotate", "45deg");
	?>

will output

	-moz-transform: rotate(45deg);
	-webkit-transform: rotate(45deg);
	-ms-transform: rotate(45deg);
	-o-transform: rotate(45deg);
	transform: rotate(45deg);
	
saving you from having to remember or look up every browser prefix for all supported properties.

## Todo

* [ ] Finish descriptions for some parameters
* [ ] Support for border-image
* [ ] Support for repeating-linear-gradient and repeating-radial-gradient
* [ ] Support for transition
* [ ] Expand browser support with support for behavior files (such as CSS3PIE)


## History

### Version 0.9

Initial version, with support for the following properties:
- border-radius
- box-shadow
- box-sizing
- linear-gradient
- placeholder
- radial-gradient
- text-shadow
- transform
