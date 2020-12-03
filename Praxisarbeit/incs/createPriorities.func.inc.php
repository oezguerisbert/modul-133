<?php
function createPriorities(array $options, string $selected = ""){
    $d = "";
    foreach ($options as $key => $option) {
        $name = "prio".($key+1);
        $d .= "<div class=\"custom-control custom-radio\">
            <input type=\"radio\" id=\"$name\" name=\"prio\" value=\"".strtolower($option)."\" class=\"custom-control-input\" required ".(strtolower($option) === strtolower($selected) ? "checked" : "").">
            <label class=\"custom-control-label\" for=\"$name\">".$option."</label>
        </div>";
    }
    return $d;
}
?>