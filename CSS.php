<?
	/**
	 *	A PHP class for generating cross-browser CSS rules.
	 *
	 *	@copyright 2013 Jarrod D Nix
	 *	@license GPL <http://opensource.org/licenses/GPL-2.0>
	 *	@author Jarrod D Nix <https://github.com/jrrdnx>
	 *	@version 0.9
	 *
	 *	@todo Finish descriptions for some parameters
	 *	@todo Support for border-image
	 *	@todo Support for repeating-linear-gradient and repeating-radial-gradient
	 *	@todo Suppoer for transition
	 *
	 *	6/6/2013
	 *
	 */
	//==========================================================================
	class CSS {
		/**
		 *	A static method for displaying the CSS
		 *	border-radius property for multiple browsers
		 *
		 *	Chrome 5.0+ (4.0+ with -webkit prefix)
		 *	Firefox 4.0+ (2.0+ with -moz prefix)
		 *	Internet Explorer 9.0+
		 *	Safari 5.0+ (3.1+ with -webkit prefix)
		 *	Opera 10.5+
		 *
		 *	Source: http://caniuse.com/border-radius
		 *	Source: http://www.css3files.com/border/
		 *
		 *	@param string $Radius
		 *	@param string $VerticalRadius [Optional] Designates the vertical radius
		 *	@return string
		 */
		static function BorderRadius($Radius, $VerticalRadius = "") {
			if($VerticalRadius) $VerticalRadius = " / ".$VerticalRadius;

			return "
			-webkit-border-radius: $Radius$VerticalRadius;
			-moz-border-radius: $Radius$VerticalRadius;
			border-radius: $Radius$VerticalRadius;
			";
		}

		/**
		 *	A static method for displaying the CSS
		 *	box-shadow property for multiple browsers
		 *
		 *	Chrome 10.0+ (4.0+ with -webkit prefix)
		 *	Firefox 4.0+ (3.5+ with -moz prefix)
		 *	Internet Explorer 9.0+
		 *	Safari 5.1+ (5.0+ with -webkit prefix)
		 *	Opera 10.5+
		 *
		 *	Source: http://caniuse.com/box-shadow
		 *	Source: http://www.css3files.com/shadow/
		 *
		 *	@param string $HorizontalOffset
		 *	@param string $VerticalOffset
		 *	@param string $Color
		 *	@param boolean $Inset [Optional]
		 *	@param string $Blur [Optional]
		 *	@param string $Spread [Optional]
		 *	@return string
		 */
		static function BoxShadow($HorizontalOffset, $VerticalOffset, $Color, $Inset = false, $Blur = "", $Spread = "") {
			return "
			-webkit-box-shadow: ".($Inset ? "inset " : "")."$HorizontalOffset $VerticalOffset ".($Blur ? $Blur." " : "").($Spread ? $Spread." " : "")."$Color;
			-moz-box-shadow: ".($Inset ? "inset " : "")."$HorizontalOffset $VerticalOffset ".($Blur ? $Blur." " : "").($Spread ? $Spread." " : "")."$Color;
			box-shadow: ".($Inset ? "inset " : "")."$HorizontalOffset $VerticalOffset ".($Blur ? $Blur." " : "").($Spread ? $Spread." " : "")."$Color;
			";
		}

		/**
		 *	A static method to change the box-sizing
		 *	attribute for multiple browsers
		 *
		 *	Chrome 10+ (4.0+ with -webkit prefix)
		 *	Firefox 2+ with -moz prefix
		 *	Internet Explorer 8+
		 *	Safari 5.1+ (3.1+ with -webkit prefix)
		 *	Opera 9.5+
		 *
		 *	Source: http://caniuse.com/box-sizing
		 *
		 *	@param array $Value Box-sizing value to implement (padding-box, border-box, inherit, or content-box [default])
		 *	@return string
		 */
		static function BoxSizing($Value = "content-box") {
			if($Value != "padding-box" && $Value != "border-box" && $Value != "inherit") {
				$Value = "content-box";
			}

			return "
			-webkit-box-sizing: $Value;
			-moz-box-sizing: $Value;
			box-sizing: $Value;
			";
		}

		/**
		 *	A static method for displaying a CSS
		 *	linear background gradient for multiple browsers
		 *
		 *	Chrome 10+ with -webkit prefix
		 *	Firefox 3.6+ with -moz prefix
		 *	Internet Explorer 10.0+
		 *	Safari 5.1+ with -webkit prefix
		 *	Opera 11.6+ with -o prefix
		 *
		 *	Source: http://caniuse.com/gradient
		 *	Source: http://www.css3files.com/gradient/
		 *
		 *	@param array $ColorStopsArray
		 *	@param string $Direction [Optional]
		 *	@return string
		 */
		static function LinearGradient($ColorStopsArray, $Direction = "top") {
			$ColorStops		= "";
			$Separator		= "";
			foreach($ColorStopsArray as $StopPosition => $StopColor) {
				$ColorStops .= $Separator . $StopColor . " " . $StopPosition;
				$Separator	= ", ";
			}

			return "
			background: ".reset($ColorStopsArray).";
			background: -moz-linear-gradient($Direction, $ColorStops);
			background: -webkit-linear-gradient($Direction, $ColorStops);
			background: -o-linear-gradient($Direction, $ColorStops);
			background: -ms-linear-gradient($Direction, $ColorStops);
			background: linear-gradient($Direction, $ColorStops);
			";

			// Safari OLD syntax (prior to 5.1)
			// background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, $StartingColor), color-stop(100%, $EndingColor));
		}

		/**
		 *	A static method for modifying the style of the
		 *	placeholder attribute for multiple browsers
		 *
		 *	Chrome 4+
		 *	Firefox 4+
		 *	Internet Explorer 10+ (6+ with jQuery placeholder plugin)
		 *	Safari 5+ (4+ with jQuery placeholder plugin)
		 *	Opera 11.6+ (11+ with jQuery placeholder plugin)
		 *
		 *	Source: http://caniuse.com/input-placeholder
		 *	Source: https://github.com/mathiasbynens/jquery-placeholder
		 *
		 *	@param array $PropertyMap Array of properties to apply to placeholder
		 *	@param string $Element [Optional] Specify an element to apply properties, defaults to all elements with placeholders
		 *	@return string
		 */
		static function Placeholder($PropertyMap, $Element = "") {
			if(!is_array($PropertyMap)) return "/* CSS::Placeholder() Error: Invalid argument type */";

			$PropertyList = "";
			foreach($PropertyMap as $Property => $Value) {
				$PropertyList .= "\n\t$Property: $Value;";
			}

			return "
			{$Element}::-webkit-input-placeholder {
				{$PropertyList}
			}
			{$Element}:-moz-placeholder {
				{$PropertyList}
			}
			{$Element}:-ms-input-placeholder {
				{$PropertyList}
			}
			{$Element}.placeholder {
				{$PropertyList}
			}
			";
		}

		/**
		 *	A static method for displaying a CSS
		 *	radial background gradient for multiple browsers
		 *
		 *	Chrome 9+ with -webkit prefix
		 *	Firefox 3.6+ with -moz prefix
		 *	Internet Explorer 10+
		 *	Safari 4+ with -webkit prefix
		 *	Opera with -o prefix
		 *
		 *	Source: http://westciv.com/tools/radialgradients/index.html
		 *	Source: http://www.css3files.com/gradient/
		 *
		 *	@param string $StartingColor
		 *	@param string $EndingColor
		 *	@param string $Position [Optional]
		 *	@param string $Shape [Optional]
		 *	@param string $Size [Optional]
		 *	@param array $ColorStopsArray [Optional]
		 *	@return string
		 */
		static function RadialGradient($StartingColor, $EndingColor, $Position = "center center", $Shape = "circle", $Size = "farthest-side", $ColorStopsArray = Array()) {
			if($ColorStopsArray) {
				$ColorStops = "";
				foreach($ColorStopsArray as $StopPosition => $StopColor) {
					$ColorStops .= "$StopColor $StopPosition, ";
				}
			}

			return "
			background: $StartingColor;
			background: -moz-radial-gradient($Position, $Shape $Size, $StartingColor 0%, ".($ColorStops ? $ColorStops : "")."$EndingColor 100%);
			background: -webkit-radial-gradient($Position, $Shape $Size, $StartingColor 0%, ".($ColorStops ? $ColorStops : "")."$EndingColor 100%);
			background: -o-radial-gradient($Position, $Shape $Size, $StartingColor 0%, ".($ColorStops ? $ColorStops : "")."$EndingColor 100%);
			background: -ms-radial-gradient($Position, $Shape $Size, $StartingColor 0%, ".($ColorStops ? $ColorStops : "")."$EndingColor 100%);
			background: radial-gradient($Position, $Shape $Size, $StartingColor 0%, ".($ColorStops ? $ColorStops : "")."$EndingColor 100%);
			";
		}

		/**
		 *	A static method for displaying the CSS
		 *	text-shadow property for multiple browsers
		 *
		 *	Chrome 4.0+
		 *	Firefox 3.5+
		 *	Internet Explorer 10.0+
		 *	Safari 4.0+
		 *	Opera 9.5+
		 *
		 *	Source: http://caniuse.com/text-shadow
		 *	Source: http://www.css3files.com/shadow/
		 *
		 *	@param string $HorizontalOffset
		 *	@param string $VerticalOffset
		 *	@param string $Color
		 *	@param string $Blur [Optional]
		 *	@return string
		 */
		static function TextShadow($HorizontalOffset, $VerticalOffset, $Color, $Blur = "") {
			return "
			text-shadow:$HorizontalOffset $VerticalOffset ".($Blur ? $Blur." " : "")."$Color;
			";
		}
		
		/**
		 *	A static method to use the transform
		 *	property for multiple browsers
		 *
		 *	Chrome 4+ with -webkit prefix
		 *	Firefox 16+ (3.5+ with -moz prefix)
		 *	Internet Explorer 10+ (9+ with -ms prefix)
		 *	Safari 3.1+ with -webkit prefix
		 *	Opera 12.1+ (10.5+ with -o prefix, 15+ with -webkit prefix)
		 *
		 *	Source: http://caniuse.com/transforms2d
		 *	Source: http://www.css3files.com/transform/
		 *
		 *	@param string $Type Type of transform (rotate, scale, skew, translate, translateX, translateY, etc.)
		 *	@param string $Value Value of transformation (usually degrees, pixels, etc.)
		 *	@return
		 */
		static function Transform($Type, $Value) {
			$Return = "
			-moz-transform: {$Type}({$Value});
			-webkit-transform: {$Type}({$Value});
			-ms-transform: {$Type}({$Value});
			-o-transform: {$Type}({$Value});
			transform: {$Type}({$Value});
			";

			if($Type == "transform-origin") {
				$Return = str_replace("(", "", $Return);
				$Return = str_replace(")", "", $Return);
			}

			return $Return;
		}
	};

	//==========================================================================
?>
