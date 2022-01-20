<?php
    class CustomForm{
        public function textField($textFieldParameter = null, $textFieldLabel = null){
            $html   =   '';

            if(!is_null($textFieldParameter)){
                if(is_array($textFieldParameter)){
                    extract($textFieldParameter);
    
                    $placeholder    =   (!isset($placeholder))? 'Input Here' : $placeholder;
                    $type           =   (!isset($type))? 'text' : $type;
                    $maxLength      =   (!isset($maxLength))? null : $maxLength;
                    $disabled       =   (!isset($disabled))? false : $disabled;
                    $leadingIcon    =   (!isset($leadingIcon))? null : $leadingIcon;
                    $name           =   (!isset($name))? 'unnamed[]' : $name;
                    $id             =   (!isset($id))? null : $id;
    
                    $inputGroupClass    =   '';
                    $inputFieldClass    =   '';
                    if(isset($className)){
                        if(is_array($className)){
                            extract($className);
                            //akan menimpa value dari $inputGroupClass dan $inputFieldClass
                        }                    
                    }
    
                    $trailingIconHTML   =   '';
                    if(isset($trailingIcon)){
                        if(is_array($trailingIcon)){
                            extract($trailingIcon);
    
                            $trailingIconHTML   =   '
                                <div class="trailing-icon-parent input-group-append cp" '.((isset($trailingIconIcon)? 'onClick="'.$trailingIconOnClick.'"' : '')).'>
                                    <div class="input-group-text">
                                        <span class="'.$trailingIconIcon.' trailing-icon"></span>
                                    </div>
                                </div>
                            ';
                        }
                    }

                    $labelHTML  =   '';
                    if(!is_null($textFieldLabel)){
                        $labelHTML  =   '<label>'.$textFieldLabel.'</label>';
                    }
    
                    $dataAttribute  =   '';
                    if(isset($data)){
                        if(is_array($data)){
                            if(count($data) >= 1){
                                foreach($data as $dataItem){
                                    if(is_array($dataItem)){
                                        if(array_key_exists('name', $dataItem) && array_key_exists('value', $dataItem)){
                                            $dataAttribute  .=  ' data-'.$dataItem['name'].'="'.$dataItem['value'].'"';
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $html   =   $labelHTML.'
                        <div class="input-group input-parent '.$inputGroupClass.'">
                            '.((!is_null($leadingIcon))? '<div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="'.$leadingIcon.'"></span>
                                    </div>
                            </div>' : '').'
                            <input type="'.$type.'" placeholder="'.$placeholder.'" '.(($disabled)? "disabled=".$disabled : '').'
                                '.((!is_null($maxLength))? 'maxLength="'.$maxLength.'"' : '').' 
                                class="form-control input-field '.$inputFieldClass.'" '.$dataAttribute.' name="'.$name.'"
                                '.((!is_null($id))? 'id="'.$id.'"' : '').' '.(isset($value)? ' value="'.$value.'"' : '').' />
                            '.$trailingIconHTML.'
                        </div>
                    ';
                }
            }

            return $html;
        }
        public function selectBox($selectBoxParams = null, $selectBoxLabel = null){
            $html   =   '';

            if(!is_null($selectBoxParams)){
                if(is_array($selectBoxParams)){
                    extract($selectBoxParams);

                    $items          =   (!isset($items))? [] : $items;
                    $disabled       =   (!isset($disabled))? false : $disabled;
                    $leadingIcon    =   (!isset($leadingIcon))? null : $leadingIcon;
                    $name           =   (!isset($name))? 'unnamed[]' : $name;
                    $id             =   (!isset($id))? null : $id;
                    $defaultOptionValue =   (!isset($defaultOptionValue))? '' : $defaultOptionValue;
                    $defaultOptionText  =   (!isset($defaultOptionText))? 'Silahkan Pilih' : $defaultOptionText;

                    $inputGroupClass    =   '';
                    $selectBoxClass     =   '';
                    if(isset($className)){
                        if(is_array($className)){
                            extract($className);
                            //akan menimpa value dari $inputGroupClass dan $selectBoxClass
                        }                    
                    }
    
                    $trailingIconHTML   =   '';
                    if(isset($trailingIcon)){
                        if(is_array($trailingIcon)){
                            extract($trailingIcon);
    
                            $trailingIconHTML   =   '
                                <div class="input-group-append cp" '.((isset($trailingIconOnClick)? 'onClick="'.$trailingIconOnClick.'"' : '')).'>
                                    <div class="input-group-text">
                                        <span class="fas fa-'.$trailingIconIcon.' trailing-icon"></span>
                                    </div>
                                </div>
                            ';
                        }
                    }

                    $labelHTML  =   '';
                    if(!is_null($selectBoxLabel)){
                        $labelHTML  =   '<label class="text-left">'.$selectBoxLabel.'</label>';
                    }

                    $selected       =   '';
                    $itemsHTML      =   '';
                    if(count($items) >= 1){
                        foreach($items as $item){
                            //bentuk $item     =   ['text' => 'Samsul', 'value' => 'Samsul Bahri'];
                            if(is_array($item)){
                                $selected   =   '';
                                if(isset($selectedValue)){
                                    $selected   =   ($item['value'] == $selectedValue)? 'selected=true' : '';
                                }
                                $itemsHTML  .=  '<option value="'.$item['value'].'" '.$selected.'>'.$item['text'].'</option>';
                            }
                        }
                    }

                    $onChangeEvent  =   (isset($onChange))? 'onChange="'.$onChange.'"' : '';
    
                    $html   =   $labelHTML.'
                        <div class="input-group input-parent '.$inputGroupClass.'">
                            '.((!is_null($leadingIcon))? '<div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fas fa-'.$leadingIcon.'"></span>
                                    </div>
                            </div>' : '').'
                            <select name="'.$name.'" class="form-control '.$selectBoxClass.'" id="'.$id.'"
                                '.(($disabled)? 'disabled' : '').' '.$onChangeEvent.'>
                                <option value="'.$defaultOptionValue.'">'.$defaultOptionText.'</option>
                                '.$itemsHTML.'
                            </select>
                            '.$trailingIconHTML.'
                        </div>
                    ';
                }
            }

            return $html;
        }
    }
?>