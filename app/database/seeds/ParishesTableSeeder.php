<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

use SedpMis\Bingo\Models\Parish;

class ParishesTableSeeder extends Seeder
{
	public function run()
	{
		foreach($this->parishes() as $parish)
		{
            $parish['no_of_members'] = explode(' + ', $parish['no_of_members']);
            $parish['no_of_members'] = array_sum($parish['no_of_members']);
			Parish::create($parish);
		}
	}

    public function parishes()
    {
        return [
            [
                'name' => "1- Sacred Heart the Mission Parish Cabasan",                                                                 
                'branch' => "BACACAY",                                                                                                                                                                                                                                      
                'date' => "2016-11-26",                                                                                                                                                                                                                                 
                'no_of_members' => "188 + 105 + 106 + 371 + 340",                                                                                               
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "1. St. Rose of Lima, Bacacay",                                                                                                                                       
                'branch' => "BACACAY",                                                                                                                                                                                                                                      
                'date' => "2016-11-27",                                                                                                                                                                                                                                 
                'no_of_members' => "337 + 241 + 449 + 330",                                                                                                                             
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "2- St. Nicolas De Tolentino Parish-Estancia",                                                            
                'branch' => "MALINAO",                                                                                                                                                                                                                                      
                'date' => "2016-11-26",                                                                                                                                                                                                                                 
                'no_of_members' => "343 + 191 + 113",                                                                                                                                                           
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "2. Sts. Joachim & Anne Parish, Malinao",                                                                                     
                'branch' => "MALINAO",                                                                                                                                                                                                                                      
                'date' => "2016-11-27",                                                                                                                                                                                                                                 
                'no_of_members' => "373 + 204 + 296 + 337 + 337",                                                                                               
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "3. St. Michael the Archangel-SMI",                                                                                                                   
                'branch' => "TABACO",                                                                                                                                                                                                                                           
                'date' => "2016-11-26",                                                                                                                                                                                                                                 
                'no_of_members' => "230 + 205 + 228",                                                                                                                                                           
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "3. St. John the Baptist-Tabaco",                                                                                                                             
                'branch' => "TABACO",                                                                                                                                                                                                                                           
                'date' => "2016-11-27",                                                                                                                                                                                                                                 
                'no_of_members' => "277 + 375 + 276 + 230",                                                                                                                             
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "4. St. Anthony of Padua-San Antonio",                                                                                                    
                'branch' => "MALILIPOT",                                                                                                                                                                                                                            
                'date' => "2016-11-26",                                                                                                                                                                                                                                 
                'no_of_members' => "257 + 221 + 234",                                                                                                                                                           
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "5. St Vincent Ferrer Parish-San Vicente",                                                                                
                'branch' => "MALILIPOT",                                                                                                                                                                                                                            
                'date' => "2016-11-26",                                                                                                                                                                                                                                 
                'no_of_members' => "79 + 134",                                                                                                                                                                                              
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "6. Holy Family Parish Panal",                                                                                                                                            
                'branch' => "MALILIPOT",                                                                                                                                                                                                                            
                'date' => "2016-11-26",                                                                                                                                                                                                                                 
                'no_of_members' => "76 + 179 + 68",                                                                                                                                                                     
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "4. Mt. Carmel Parish",                                                                                                                                                                               
                'branch' => "MALILIPOT",                                                                                                                                                                                                                            
                'date' => "2016-11-27",                                                                                                                                                                                                                                 
                'no_of_members' => "170 + 221 + 170",                                                                                                                                                           
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "7. Our Lady of Salvacion-Joroan",                                                                                                                        
                'branch' => "TIWI",                                                                                                                                                                                                                                                     
                'date' => "2016-11-26",                                                                                                                                                                                                                                 
                'no_of_members' => "186 + 82 + 78",                                                                                                                                                                     
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "5. St. Lawrence the Martyr",                                                                                                                                                 
                'branch' => "TIWI",                                                                                                                                                                                                                                                     
                'date' => "2016-11-27",                                                                                                                                                                                                                                 
                'no_of_members' => "243 + 165 + 512 + 215",                                                                                                                             
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "8. St John Nepomucene-Bonga",                                                                                                                                            
                'branch' => "BACACAY -Legaspi Port Branch as Host",                                                                                     
                'date' => "2016-11-26",                                                                                                                                                                                                                                 
                'no_of_members' => "217 + 134",                                                                                                                                                                                         
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "6. Sto. Domingo de Guzman-Sto. Domingo, Albay",                                                  
                'branch' => "LEGASPI PORT",                                                                                                                                                                                                             
                'date' => "2016-11-27",                                                                                                                                                                                                                                 
                'no_of_members' => "179 + 164 + 142",                                                                                                                                                           
                'additional_members' => ""                                                                                                                                                                                                                  
            ],[
                'name' => "9. St. Joseph the Worker -Villahermosa",                                                                                     
                'branch' => "RAPU-RAPU",                                                                                                                                                                                                                            
                'date' => "2016-11-26",                                                                                                                                                                                                                                 
                'no_of_members' => "200 + 184 + 150",                                                                                                                                                           
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "7. Sta. Florentina",                                                                                                                                                                                         
                'branch' => "RAPU-RAPU",                                                                                                                                                                                                                            
                'date' => "2016-11-27",                                                                                                                                                                                                                                 
                'no_of_members' => "300 + 199 + 300 + 200 + 200",                                                                                               
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "8. Our Lady of the Gate Parish",                                                                                                                             
                'branch' => "DARAGA",                                                                                                                                                                                                                                           
                'date' => "2016-11-20",                                                                                                                                                                                                                                 
                'no_of_members' => "200 + 500 + 197 + 200",                                                                                                                             
                'additional_members' => "10"                                                                                                                                                                                                        
            ],[
                'name' => "9. St. John the Baptist -Camalig",                                                                                                                   
                'branch' => "DARAGA",                                                                                                                                                                                                                                           
                'date' => "2016-11-20",                                                                                                                                                                                                                                 
                'no_of_members' => "140 + 300 + 126",                                                                                                                                                           
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "10. St. Lawrence the Martyr-Cotmon",                                                                                                         
                'branch' => "DARAGA",                                                                                                                                                                                                                                           
                'date' => "2016-11-19",                                                                                                                                                                                                                                 
                'no_of_members' => "74 + 74",                                                                                                                                                                                                   
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "11.San Ramon Nonato-Tagas",                                                                                                                                                      
                'branch' => "DARAGA",                                                                                                                                                                                                                                           
                'date' => "2016-11-19",                                                                                                                                                                                                                                 
                'no_of_members' => "87 + 87",                                                                                                                                                                                                   
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "12. Our Lady ofAssumption-Malabog",                                                                                                              
                'branch' => "DARAGA",                                                                                                                                                                                                                                           
                'date' => "2016-11-19",                                                                                                                                                                                                                                 
                'no_of_members' => "116 + 116",                                                                                                                                                                                         
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "13. Our Lady of Salvacion-Anislag",                                                                                                              
                'branch' => "DARAGA",                                                                                                                                                                                                                                           
                'date' => "2016-11-19",                                                                                                                                                                                                                                 
                'no_of_members' => "150 + 200 + 100",                                                                                                                                                           
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "10. St. Raphael the Archangel with Fatima",                                                                      
                'branch' => "LEGASPI PORT",                                                                                                                                                                                                             
                'date' => "2016-11-20",                                                                                                                                                                                                                                 
                'no_of_members' => "179 + 164 + 142",                                                                                                                                                           
                'additional_members' => "20"                                                                                                                                                                                                        
            ],[
                'name' => "14. St. Joseph the Husband of Mary-Rawis",                                                                           
                'branch' => "LEGASPI PORT",                                                                                                                                                                                                             
                'date' => "2016-11-19",                                                                                                                                                                                                                                 
                'no_of_members' => "95 + 103",                                                                                                                                                                                              
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "15 St. Vincent Ferrer-Bigaa",                                                                                                                                            
                'branch' => "LEGASPI PORT",                                                                                                                                                                                                             
                'date' => "2016-11-19",                                                                                                                                                                                                                                 
                'no_of_members' => "206 + 218",                                                                                                                                                                                         
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "11. St. Gregory the Great Cathedral",                                                                                                    
                'branch' => "ALBAY DISTRICT",                                                                                                                                                                                                   
                'date' => "2016-11-20",                                                                                                                                                                                                                                 
                'no_of_members' => "200 + 116 + 60",                                                                                                                                                                
                'additional_members' => "10"                                                                                                                                                                                                        
            ],[
                'name' => "12. St. Raphael the Archangel-Manito",                                                                                               
                'branch' => "ALBAY DISTRICT",                                                                                                                                                                                                   
                'date' => "2016-11-20",                                                                                                                                                                                                                                 
                'no_of_members' => "200 + 269 + 200",                                                                                                                                                           
                'additional_members' => "10"                                                                                                                                                                                                        
            ],[
                'name' => "16. St. Roche Parish-Taysan",                                                                                                                                            
                'branch' => "ALBAY DISTRICT",                                                                                                                                                                                                   
                'date' => "2016-11-19",                                                                                                                                                                                                                                 
                'no_of_members' => "100 + 199",                                                                                                                                                                                         
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "17. St. Joseph the Worker-Banquerohan",                                                                                          
                'branch' => "ALBAY DISTRICT",                                                                                                                                                                                                   
                'date' => "2016-11-19",                                                                                                                                                                                                                                 
                'no_of_members' => "50 + 160",                                                                                                                                                                                              
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "18. Our Lady of Guadalupe Parish-Lidong",                                                                                
                'branch' => "POLANGUI",                                                                                                                                                                                                                                 
                'date' => "2016-12-10",                                                                                                                                                                                                                                 
                'no_of_members' => "94 + 101",                                                                                                                                                                                              
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "19. St. Dominisc of Guzman-Matacon",                                                                                                         
                'branch' => "POLANGUI",                                                                                                                                                                                                                                 
                'date' => "2016-12-10",                                                                                                                                                                                                                                 
                'no_of_members' => "100 + 193 + 113",                                                                                                                                                           
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "13. Sts. Peter and Paul with Ponso and Balogo Parishes",     
                'branch' => "POLANGUI",                                                                                                                                                                                                                                 
                'date' => "2016-12-11",                                                                                                                                                                                                                                 
                'no_of_members' => "185 + 193 + 217",                                                                                                                                                           
                'additional_members' => "10"                                                                                                                                                                                                        
            ],[
                'name' => "14. St. Michael the Archangel -Oas",                                                                                                         
                'branch' => "POLANGUI",                                                                                                                                                                                                                                 
                'date' => "2016-12-11",                                                                                                                                                                                                                                 
                'no_of_members' => "114 + 99",                                                                                                                                                                                              
                'additional_members' => "10"                                                                                                                                                                                                        
            ],[
                'name' => "20. Our Lady of the Most Holy Rosary-Paulba",                                                            
                'branch' => "LIGAO",                                                                                                                                                                                                                                                
                'date' => "2016-12-10",                                                                                                                                                                                                                                 
                'no_of_members' => "207 + 126",                                                                                                                                                                                         
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "15. St. Stephen Proto Martyr",                                                                                                                                       
                'branch' => "LIGAO",                                                                                                                                                                                                                                                
                'date' => "2016-12-11",                                                                                                                                                                                                                                 
                'no_of_members' => "194 + 293 + 227 + 147 + 145",                                                                                               
                'additional_members' => "10"                                                                                                                                                                                                        
            ],[
                'name' => "16.Our Lady of Assumption-Guinobatan",                                                                                               
                'branch' => "LIGAO",                                                                                                                                                                                                                                                
                'date' => "2016-12-11",                                                                                                                                                                                                                                 
                'no_of_members' => "91 + 68 + 132",                                                                                                                                                                     
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "21. St. Vincent Ferrer- Mauraro",                                                                                                                        
                'branch' => "LIGAO",                                                                                                                                                                                                                                                
                'date' => "2016-12-10",                                                                                                                                                                                                                                 
                'no_of_members' => "82 + 94 + 111",                                                                                                                                                                     
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "17. St. John the Baptist-Jovellar",                                                                                                              
                'branch' => "LIGAO",                                                                                                                                                                                                                                                
                'date' => "2016-12-11",                                                                                                                                                                                                                                 
                'no_of_members' => "110",                                                                                                                                                                                                                       
                'additional_members' => "5"                                                                                                                                                                                                             
            ],[
                'name' => "22. Our Lady of the Most Holy Rosary - Badian",                                                  
                'branch' => "PIODURAN",                                                                                                                                                                                                                                 
                'date' => "2016-12-10",                                                                                                                                                                                                                                 
                'no_of_members' => "101 + 153",                                                                                                                                                                                         
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "18.Our Lady of Salvation with St. Joseph Parish -Donsol",
                'branch' => "PIODURAN",                                                                                                                                                                                                                                 
                'date' => "2016-12-11",                                                                                                                                                                                                                                 
                'no_of_members' => "262 + 332 + 382",                                                                                                                                                           
                'additional_members' => "15"                                                                                                                                                                                                        
            ],[
                'name' => "19. St. James the Greater Parish",                                                                                                                   
                'branch' => "LIBON",                                                                                                                                                                                                                                                
                'date' => "2016-12-11",                                                                                                                                                                                                                                 
                'no_of_members' => "440 + 633 + 975 + 160 + 141",                                                                                               
                'additional_members' => "15"                                                                                                                                                                                                        
            ]
        ];
    }
}