<?php

class Expense extends AppModel {
    
	public $validate = array(						
							
			'apartment_id' => array(
				'rule' => array('comparison', '>', 0),
				'required' => true,
			),
			
			'amount' => array(
					'rule' => 'numeric',
					'required' => true,
					//'message' => 'Por favor ingresar el monto del gasto.',
					//'allowEmpty' => false,
			),	
			'date' => array(												
					'rule' => array('date', 'ymd'),									
					'required' => true,
			),
	);
    
    public $belongsTo = array(
      'Apartment' => array(
            'className' => 'Apartment',            
            'foreignKey' => 'apartment_id', 
        )  
    );    
    
}
