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
    $warranty_code_list = array( 
					'SP0122',
					'SP0222',
					'SP0322',
					'SP0422',
					'SP0522',
					'SP0622',
					'SP0722',
					'SP0822',
					'SP0922',
					'SP1022',
		            'SP1122',
		            'SP1222',
                    'SP1322',
                    'SP1422',
                    'SP1522',
                    'SP1622',
                    'SP1722',
                    'SP1822',
                    'SP1922',
                    'SP2022',
                    'SP2122',
                    'SP2222',
                    'SP2322',
                    'SP2422',
                    'SP2522',
                    'SP2622',
                    'SP2722',
                    'SP2822',
                    'SP2922',
                    'SP3022',
                    'SP3122',
                    'SP3222',
                    'SP3322',
                    'SP3422',
                    'SP3522',
                    'SP3622',
                    'SP3722',
                    'SP3822',
                    'SP3922',
                    'SP4022',
                    'SP4122',
                    'SP4222',
                    'SP4322',
                    'SP4422',
                    'SP4522',
                    'SP4622',
                    'SP4722',
                    'SP4822',
                    'SP4922',
                    'SP5022'
		
    );
     global $wpdb;
	$query   = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}warranty WHERE warranty_code = '$warranty'   AND warranty_valid = '1'");
	$results = $wpdb->get_results( $query );

if ( count( $results ) == 0 )  {
		wpforms()->process->errors[ $form_data[ 'id' ] ] [ '11' ] = esc_html__( 'Warranty Code not found, please confirm the code and try again.', 'plugin-domain' );
	}
else{
		
		$wpdb->query( $wpdb->prepare("UPDATE  {$wpdb->prefix}warranty SET  warranty_valid = '0'  WHERE warranty_code = '$warranty' ")  );
   

    
	
	
}
	
	
	
	
	
    // check if value entered is not in the approved warranty list

    }
add_action( 'wpforms_process', 'wpf_dev_validate_warranty', 10, 3 );