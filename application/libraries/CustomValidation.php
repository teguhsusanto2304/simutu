<?php
    class CustomValidation{
        public function validation($rules = null){
            $ci     =   get_instance();

            $ci->load->library('form_validation');

            $validationStatus   =   false;
            $validationMessage  =   null;

            if(!is_null($rules)){
                if(is_array($rules)){
                    foreach($rules as $rule){
                        if(array_key_exists('name', $rule) && array_key_exists('label', $rule) && array_key_exists('rule', $rule)){
                            $ci->form_validation->set_rules($rule['name'], $rule['label'], $rule['rule']);
                        }
                    }

                    $validationStatus   =   $ci->form_validation->run();
                    $validationMessage  =   $ci->form_validation->error_string();
                }
            }

            return ['status' => $validationStatus, 'message' => $validationMessage];
        }
    }
?>