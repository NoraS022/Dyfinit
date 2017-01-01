<?php 
	// A template for a Dyfinit element
	class Example1{
		public $data = [];

		function __construct(){
			// Assign the data
			$data = json_decode(file_get_contents("../data/example1.json")); // Fetch the data
			foreach($data as $instance => $value){
				array_push($this->data, $data[$instance]); // Assign it to an array
			}
		}

		function print_instance($num){
			// Create the markup
			$output = '';
			$output .= '<div class="sample">';
			$output .= 		'<img src="'. $this->data[$num]->img .'">';
			$output .= 		'<div>';
			$output .= 			'<h2>'. $this->data[$num]->header .'</h2>';
			$output .=			'<p>'. $this->data[$num]->text .'</p>';
			$output .= 		'</div>';
			$output .= '</div>';

			return $output; // Send it back
		}
	}
?>
