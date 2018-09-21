<?php
class HtmlHelper
{
    static function presentButton($elemType = "button", $type = "button", $text = "Default", $class = "btn btn-default", $link = "#"){
        $accHtml = ""; // Accumalated html
        $accHtml = "<$elemType type='$type' class='$class' href='$link'>$text</$elemType>";
        return $accHtml;
    }
    /**
     * Present bootstrap input
     *
     * @param string $name
     * @param string $labelText
     * @param string $inputType
     * @param string $placeholder
     * @param string $class
     * @param string $id
     * @return string $html
     */
    static function presentInput($name = "", $labelText = "", $inputType = "", $placeholder = "", $value = "", $id = "", $validate = ""){
        $accHtml = "";
        $accHtml .= '<div class="form-group">
        <label for="'.$name.'">'.$labelText.'</label>
        <input type="'.$inputType.'"
          '.$validate.' class="form-control" name="'.$name.'" id="'.$id.'" value="'.$value.'" placeholder="'.$placeholder.'">
      </div>';
      return $accHtml;
    }
    static function presentWysiwyg($name, $label = "",$value = "", $rows = 3, $validate = ""){
        $accHtml = "";
        $accHtml .= '<div class="form-group">';
        $accHtml .= '<label for="'.$name.'">'.$label.'</label>';
        $accHtml .= '<textarea class="form-control" name="'.$name.'" id="summernote" rows="'.$rows.'" '.$validate.'>'.$value.'</textarea>';
        $accHtml .= '</div>';
        return $accHtml;
    }
    // static function presentCheck(){
    //     $accHtml = "";
    //     $accHtml .= '<div class="form-checfk">
    //         <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
    //         Display value
    //     </div>';
    //     return $accHtml;
    // }
    /**
     * Undocumented function
     *
     * @param string $name
     * @param array $options
     * @return void
     */
    static function presentOptions($txt = "", $name ="", $options = [], $checked = ""){
        $accHtml = "";
        var_dump($options);
        $accHtml .= '<div class="form-group">
        <label for="'.$name.'">'.$txt.'</label>
        <select class="form-control" name="'.$name.'" id="'.$name.'">';
        foreach($options as $option){
            if($checked == $option){
                $accHtml .= '<option selected value="'.$option.'">'.$option.'</option>';
            } else {
                $accHtml .= '<option value="'.$option.'">'.$option.'</option>';
            }
        }
        $accHtml .= '</select></div>';
        return $accHtml;
    }

    static function presentSelect($name = "",$options,  $optionValue, $optionTxt, $selected, $label = "Vælg: "){
        $accHtml = "";
        $accHtml .= '<div class="form-group">';
        $accHtml .= '<label for="'.$name.'">'.$label.'</label>';
        $accHtml .= '<select class="form-control" name="'.$name.'" >';
        foreach ($options as $key => $value) {
            if($value[$optionValue] == $selected){
                $accHtml .= '<option selected value="'.$value[$optionValue].'" >'.$value[$optionTxt].'</option>';
            } else {
                $accHtml .= '<option value="'.$value[$optionValue].'" >'.$value[$optionTxt].'</option>';
            }
        }
        $accHtml .= '</select></div>';

        return $accHtml;
    }
    static function presentCheckBox($name = "", $data, $valueMarker = "", $nameMarker = "", $checked = []){
        $accHtml = "";
        $index = 0;
        foreach ($data as $key => $value) {
            $index = $index + 1;
            // if($index == 10) { $index = 0; $accHtml .= '<br>';}
            if(in_array($value[$valueMarker], $checked)){
                $accHtml .= '<div class="form-check form-check-inline">';
                $accHtml .= '<label class="form-check-label">';
                $accHtml .= '<input type="checkbox" checked class="form-check-input" value="'.$value[$valueMarker].'" name="'.$name.'" id="">';
                $accHtml .= $value[$nameMarker].'</label>';
                $accHtml .= "</div>";
            } else {
                $accHtml .= '<div class="form-check form-check-inline">';
                $accHtml .= '<label class="form-check-label">';
                $accHtml .= '<input type="checkbox" class="form-check-input" value="'.$value[$valueMarker].'" name="'.$name.'" id="">';
                $accHtml .= $value[$nameMarker].'</label>';
                $accHtml .= "</div>";
            }
        }
        return $accHtml;
    }
    static function presentDate($name,$label,$value){
        $accHtml = "";
        $accHtml .= '
        <div class="form-group">
          <label for="'.$name.'">'.$label.'</label>';
        $accHtml .= '<input type="datetime-local" value="'.$value.'"
        class="form-control" name="'.$name.'" id="" aria-describedby="helpId" placeholder="">
        </div>';
        return $accHtml;

    }
     /**
      * Present a bootstrap list
      *
      * @param array $tHeads
      * @param array $tRows
      * @param string $options
      * @return void
      */
    static function presentTable($tHeads = [], $tRows = [], $options = "", $marker = ""){
        $accHtml = "";
        $accHtml .= '<table class="table">'.'
        <thead>'.
        '<tr>';
        foreach ($tHeads as $tHead) {
            $accHtml .= '<th scope="col">'.$tHead.'</th>';
        }
        $accHtml .= '<tr></thead>';
        $accHtml .= '<tbody>';
        foreach ($tRows as $tRow){
            $accHtml .= '<tr>';
            foreach($tRow as $t){
                $accHtml .= '<td>'.$t.'</td>';
            }
            if(strlen($options) > 0){
                // Options, could be ID, so we replace @id with id
                $newOpt = str_replace("@id", $tRow["$marker"], $options);
                $accHtml .= '<td>'.$newOpt.'</td>';
            }
            $accHtml .= '<tr>';
        }
        $accHtml .= '</tbody>';
        $accHtml .= '</table>';
        return $accHtml;
        
    }
    static function presentPicture($label, $prefix, $src, $alt, $options = ""){
        $accHtml = "";
        $accHtml .= '<p>'.$label;
        $accHtml .= '</p>';
        $accHtml .= '<img src="'.$prefix.''.$src.'" alt="'.$alt.'" '.$options.'>';
        return $accHtml;
    }
    /**
     * Present list with prefix
     * Example presentList(["Brugernavn", "Fornavn"], $items)
     *
     * @param array $prefix
     * @param array $items
     * @return void
     */
    static function presentList($prefix = [], $items = []){
        $accHtml = "";
        $index = 0;
        $accHtml .= "<ul>";
        foreach ($items as $item) {
            foreach ($item as $key => $value) {
                $accHtml .= '<li><b>'.$prefix[$index].'</b>'.$value.'</li>';
                $index = $index + 1;
            }
        }
        $accHtml .= "</ul>";
        return $accHtml;
    }
    static function presentHidden($name, $value){
        $accHtml = "";
        $accHtml .= '<input type="hidden" name="'.$name.'" value="'.$value.'">';
        return $accHtml;
    }
}
?>