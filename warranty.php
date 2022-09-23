/**
Warranty Code Validation
 *
 */
 
function wpf_dev_validate_warranty( $fields, $entry, $form_data ) {
       
    // Optional, you can limit to specific forms. Below, we restrict output to
    // form #6693.
    if ( absint( $form_data[ 'id' ] ) !== 6693 ) {
        return $fields;
    }
    
   
    $warranty = $fields[11][ 'value' ];
     
    // we need to start from here to fetch data from db using wpdb 
    //  Works on two things fetch and update the database
    //  
    // 
    // instead of manually adding arrays
 
     global $wpdb;
	$query   = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}warranty WHERE wa_code = '$warranty'   AND warranty_valid = '1'");
	$results = $wpdb->get_results( $query );

if ( count( $results ) == 0 )  {
		wpforms()->process->errors[ $form_data[ 'id' ] ] [ '11' ] = esc_html__( 'Warranty Code not found, please confirm the code and try again.', 'plugin-domain' );
	}
else{
		
		$wpdb->query( $wpdb->prepare("UPDATE  {$wpdb->prefix}warranty SET  warranty_valid = '0'  WHERE wa_code = '$warranty' ")  );
   

    
	
	
}
	
	
	
	
	
    // check if value entered is not in the approved warranty list

    }
add_action( 'wpforms_process', 'wpf_dev_validate_warranty', 10, 3 );
