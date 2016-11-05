<?php
global $css_selectors;
global $defines;
global $wp_customize;
$css_selectors = array(
		"font-size",
		"color",
		//"border-top",
		//"border-bottom",
		//"border-left",
		//"border-right",
		//"float",
		//"padding",
		//"margin",
		//"text-shadow",
		//"text-align",
);
$defines = array(
		"h1",
		"h2",
		"h3",
		"h4",
		"h5",
		"h1:hover",
		"h2:hover",
		"h3:hover",
		"h4:hover",
		"h5:hover",
);


add_action('customize_register','my_customize_register');

function my_customize_register( $wp_customize ) {
	
	global $css_selectors;
	global $defines;
	
	//MAIN SECTION
	$wp_customize->add_section( 'custom_css_merk', array(
			'title' => 'merk',
			'description' => __( 'merk' ),
			'panel' => '', // Not typically needed.
			'priority' => 160,
			'capability' => 'edit_theme_options',
			'theme_supports' => '', // Rarely needed.
	) );
	
	
	
	//SETTINGS
	
	//HEADERS
	
	//

	for($z=0;$z<count($defines);$z++){
		
		for($i=0;$i<count($css_selectors);$i++){
			
		$the_setting = $defines[$z] . '_sett_' . $css_selectors[$i];
		$the_control = $defines[$z] . '_ctrl_' . $css_selectors[$i];
	
		$wp_customize->add_setting( $the_setting, array(
				'type' => 'option', // or 'option'
				'capability' => 'edit_theme_options',
				'theme_supports' => '', // Rarely needed.
				'default' => '',
				'transport' => 'refresh', // or postMessage
				'sanitize_callback' => '',
				'sanitize_js_callback' => '', // Basically to_json.
		) );
		
			if($css_selectors[$i] == 'color'){
				$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $the_setting, array(
						'label' => $defines[$z] . ' Color ' . $css_selectors[$i],
						'section' => 'custom_css_merk',
						'settings' => $the_setting,
						'priority' => 10, // Within the section.
						//'description' => __( 'This is a date control with a red border.' ),
				) ) );
				
			}elseif($css_selectors[$i] == 'text-align'){
				$wp_customize->add_control(
					$the_setting, 
					array(
						'label'    => $defines[$z] . ' => ' . $css_selectors[$i],
						'section'  => 'custom_css_merk',
						'settings' => $the_setting,
						'type'     => 'select',
						'choices'  => array(
								'left'  => 'left',
								'right' => 'right',
								'center' => 'center',
						),
						
					)
				);
			
			}elseif($css_selectors[$i] == 'font-size'){
				$wp_customize->add_control(
					$the_setting, 
					array(
						'label'    => $defines[$z] . ' => ' . $css_selectors[$i],
						'section'  => 'custom_css_merk',
						'settings' => $the_setting,
						'type'     => 'number',
						
					)
				);
			
			}else{
				$wp_customize->add_control(
					$the_setting, 
					array(
						'label'    => $defines[$z] . ' => ' . $css_selectors[$i],
						'section'  => 'custom_css_merk',
						'settings' => $the_setting,
						'type'     => 'text',
						
					)
				);
			}
			
			
		}
		
	}
}

	
function mytheme_customize_css()
{
	global $css_selectors;
	global $defines;
	?>
         <style type="text/css">
         	<?php 
         	
         	for($z=0;$z<count($defines);$z++){
				
         		echo $defines[$z] . '{';
         		
				for($i=0;$i<count($css_selectors);$i++){
					
					$the_setting = $defines[$z] . '_sett_' . $css_selectors[$i];
					$the_control = $defines[$z] . '_ctrl_' . $css_selectors[$i];
         		
						echo $css_selectors[$i] . ':' . get_option( $the_setting ). ' !important;';

         		
				}
						
				echo '}';
         	}
			
         	?>
         	
             
         </style>
    <?php
			
}
add_action( 'wp_head', 'mytheme_customize_css');


?>